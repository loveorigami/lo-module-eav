<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_attribute}}".
 *
 * @property integer $id
 * @property integer $entityId 
 * @property integer $typeId
 * @property string $type 
 * @property string $name
 * @property string $label
 * @property string $defaultValue
 * @property integer $defaultOptionId
 * @property integer $required
 * @property integer $order 
 * @property string $description 
 *
 * @property EavAttributeOption $defaultOption
 * @property EavAttributeType $type
 * @property EavAttributeOption[] $eavAttributeOptions
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttribute extends \lo\core\db\ActiveRecord
{
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'defaultOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavType()
    {
        return $this->hasOne(EavAttributeType::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(EavEntity::className(), ['id' => 'entityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavOptions()
    {
        return $this->hasMany(EavAttributeOption::className(), ['attributeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributeValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['attributeId' => 'id']);
    }

    public function getbootstrapData()
    {
        return [
            'cid' => '',
            'label' => '',
            'field_type' => '',
            'required' => '',
            'field_options' => [],
        ];
    }

}