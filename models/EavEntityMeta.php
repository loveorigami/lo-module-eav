<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 */
class EavEntityMeta extends MetaFields
{
    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "entityName" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "entityName"]
            ],
            "entityModel" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'entityModel'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "entityModel"]
            ],
            "categoryId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Category'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "categoryId"]
            ],
        ];
    }
}