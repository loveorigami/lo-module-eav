<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_attribute_option}}".
 *
 * @property integer $id
 * @property integer $attributeId
 * @property string $value
 * @property string $defaultOptionId
 *
 * @property EavAttribute[] $eavAttributes
 * @property EavAttribute $attribute
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttributeOption extends \lo\core\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__attribute_option}}';
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
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['defaultOptionId' => 'id'])
          ->orderBy(['order' => SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute($name = '')
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attributeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['optionId' => 'id']);
    }
}