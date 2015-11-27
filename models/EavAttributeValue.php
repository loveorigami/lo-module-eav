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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['entityId', 'attributeId'], 'required'],
            [['entityId', 'attributeId', 'optionId'], 'integer'],
            [['value'], 'string', 'max' => 255],
            //[['attributeId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttribute::className(), 'targetAttribute' => ['attributeId' => 'id']],
            //[['entityId'], 'exist', 'skipOnError' => true, 'targetClass' => Eav::className(), 'targetAttribute' => ['entityId' => 'id']],
            //[['optionId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeOption::className(), 'targetAttribute' => ['optionId' => 'id']],
        ];
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
        return $this->hasOne(Eav::className(), ['id' => 'entityId']);
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