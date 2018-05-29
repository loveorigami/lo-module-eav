<?php
namespace lo\modules\eav\models\meta;

use lo\modules\eav\models\EavAttributeType;
use Yii;
use lo\core\db\MetaFields;

/**
 * Class EavAttributeTypeMeta
 * Мета описание модели
 */
class EavAttributeTypeMeta extends MetaFields
{

    public static function getStoreTypes()
    {
        return EavAttributeType::getStoreTypes();
    }

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "name"]
            ],

            "store_type" => [
                "definition" => [
                    "class" => \lo\core\db\fields\ListField::class,
                    "title" => Yii::t('backend', 'Store type'),
                    "data" => [$this, "getStoreTypes"], // массив всех типов (см. выше)
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "store_type"]
            ],
        ];
    }
}