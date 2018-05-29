<?php

namespace lo\modules\eav\models;

use lo\modules\eav\models\meta\EavValueMeta;

/**
 * @property integer $id
 * @property integer $entityId
 * @property integer $attributeId
 * @property string $value
 * @property integer $optionId
 *
 * @property EavAttribute $attribute
 * @property EavEntity $entity
 * @property \yii\db\ActiveQuery $eavEntity
 * @property \yii\db\ActiveQuery $eavAttribute
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
        return EavValueMeta::class;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttribute()
    {
        return $this->hasOne(EavAttribute::class, ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavEntity()
    {
        return $this->hasOne(EavEntity::class, ['id' => 'entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(EavAttributeOption::class, ['id' => 'value']);
    }
}