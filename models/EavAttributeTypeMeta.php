<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;

/**
 * Class EavAttributeTypeMeta
 * Мета описание модели
 */
class EavAttributeTypeMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "handlerClass" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'handlerClass'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "handlerClass"]
            ],
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "name"]
            ],
            "storeType" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'storeType'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => false,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "storeType"]
            ],
        ];
    }
}