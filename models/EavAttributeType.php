<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_attribute_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $handlerClass
 * @property integer $storeType
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavAttributeType extends \lo\core\db\ActiveRecord
{
    const STORE_TYPE_RAW = 'raw';
    const STORE_TYPE_OPTION = 'option';

    public $tplDir = '@lo/modules/eav/modules/admin/views/attribute-type/tpl/';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__attribute_type}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavAttributeTypeMeta::class;
    }

    public static function getStoreTypes()
    {
        return [
            self::STORE_TYPE_RAW => Yii::t('eav', 'Raw'),
            self::STORE_TYPE_OPTION => Yii::t('eav', 'Option'),
        ];
    }

}