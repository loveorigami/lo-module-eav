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
        return EavAttributeValueMeta::class;
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
            //[['attributeId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttribute::class, 'targetAttribute' => ['attributeId' => 'id']],
            //[['entityId'], 'exist', 'skipOnError' => true, 'targetClass' => Eav::class, 'targetAttribute' => ['entityId' => 'id']],
            //[['optionId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeOption::class, 'targetAttribute' => ['optionId' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::class, ['id' => 'attributeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Eav::class, ['id' => 'entityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::class, ['id' => 'optionId']);
    }
    
    public function getValue(){
      return 'XXX';
    }
}