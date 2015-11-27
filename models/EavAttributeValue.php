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
class EavAttributeValue extends \lo\core\db\ActiveRecord
{
    public $tplDir = '@lo/modules/eav/modules/admin/views/value/tpl/';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__attribute_value}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavAttributeValueMeta::className();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::className(), ['id' => 'attributeId']);
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
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'optionId']);
    }
    
    public function getValue(){
      return 'XXX';
    }
}