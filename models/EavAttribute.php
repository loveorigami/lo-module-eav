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
        return '{{%pg__form}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavAttribute::className();
    }
}