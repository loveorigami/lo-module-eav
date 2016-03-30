<?php

namespace lo\modules\eav\models;

use Yii;
use lo\core\helpers\FA;
use yii\base\InvalidParamException;

/**
 * This is the model class for table "{{%eav_attribute}}".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $name
 * @property string $label
 * @property string $default_value
 * @property string $icon
 * @property integer $required
 * @property string $description
 *
 * @property EavAttributeOption $default_option
 * @property EavAttributeType $type
 * @property EavAttributeOption[] $eavAttributeOptions
 * @property EavValue[] $eavValues
 */
class EavAttribute extends \lo\core\db\ActiveRecord
{
    public $tplDir = '@lo/modules/eav/modules/admin/views/attribute/tpl/';
    /**
     * @var lo\modules\eav\models\EavValue
     */
    private $_value;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavAttributeMeta::className();
    }


    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'default_value']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavType()
    {
        return $this->hasOne(EavAttributeType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasMany(EavEntity::className(), ['id' => 'entity_id'])
            ->viaTable(EavEntityAttribute::tableName(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavOptions()
    {
        return $this->hasMany(EavAttributeOption::className(), ['attribute_id' => 'id']);
    }

    public function getEavOptionsList()
    {
        $result = [];
        $options = $this->eavOptions;
        foreach ($options as $option) {
            $result[$option->id] = $option->value;
        }
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavValues()
    {
        return $this->hasMany(EavValue::className(), ['attribute_id' => 'id']);
    }

    public static function getEavAttributes()
    {
        $result = static::find()->all();
        return ArrayHelper::map($result, 'id', function ($item) {
            return "{$item->id} - {$item->name} - {$item->label}";
        });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcon()
    {
        return empty($this->icon) ? '' : FA::icon($this->icon);
    }

    protected function loadValue($entityModel, $catgoryId, $itemId)
    {
        $modelTable = EavEntityModel::tableName();
        $valueTable = EavValue::tableName();
        $entityTable = EavEntity::tableName();

        $value = EavValue::find()
            ->innerJoin($entityTable, "$valueTable.entity_id = $entityTable.id")
            ->innerJoin($modelTable, "$entityTable.model_id = $modelTable.id")
            ->andWhere(["entity_model" => $entityModel])
            ->andWhere(["category_id" => $catgoryId])
            ->andWhere(["item_id" => $itemId])
            ->andWhere(["attribute_id" => $this->getPrimaryKey()])
            ->one();
        return ($value) ? $value : null;
    }

    public function getValue($entityModel, $catgoryId, $itemId)
    {
        if (!isset($this->_value) || !$this->_value) {
            $this->_value = $this->loadValue($entityModel, $catgoryId, $itemId);
        }
        return $this->_value;
    }

    public function setValue($entityModel, $catgoryId, $itemId, $value)
    {
        if (!isset($this->_value) || !$this->_value) {
            $this->_value = $this->loadValue($entityModel, $catgoryId, $itemId);
        }

        if (!$this->_value) {

            if (!$eavModel = EavEntityModel::findOne(['entity_model' => $entityModel])) {
                throw new InvalidParamException(Yii::t('eav', 'Model was not found.'));
            }
            if (!$eavEntity = EavEntity::findOne(['model_id' => $eavModel->id, 'category_id' => $catgoryId])) {
                throw new InvalidParamException(Yii::t('eav', 'Entity was not found.'));
            }

            $eavValue = new EavValue([
                'entity_id' => $eavEntity->id,
                'attribute_id' => $this->getPrimaryKey(),
                'item_id' => $itemId,
                'value' => $value,
            ]);

            if (!$eavValue->save()) {
                throw new \yii\db\Exception(Yii::t('eav', 'An error occurred during creation of EavValue record.'));
            }

            $this->_value = $eavValue;
        }

        $this->_value->value = $value;
    }

    public function afterSave()
    {
        if (isset($this->_value) && $this->_value) {
            $this->_value->save();
        }
    }

}