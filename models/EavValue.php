<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_attribute_value}}".
 *
 * @property integer $id
 * @property integer $entityId
 * @property integer $attributeId
 * @property string $value
 * @property integer $optionId
 *
 * @property EavAttribute $attribute
 * @property Eav $entity
 * @property EavAttributeOption $option
 */
class EavValue extends \lo\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__value}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavValueMeta::className();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Eav::className(), ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'value']);
    }
}