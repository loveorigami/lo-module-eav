<?php

namespace lo\modules\eav\models;

use lo\modules\eav\models\meta\EavAttributeOptionMeta;
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
        return EavAttributeOptionMeta::class;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getEavAttributes()
//    {
//        return $this->hasMany(EavAttribute::class, ['default_option_id' => 'id'])
//          ->orderBy(['order' => SORT_DESC]);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::class, ['id' => 'attribute_id']);
    }

}