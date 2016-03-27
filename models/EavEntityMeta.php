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
            "model_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'entityModel'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "model_id"]
            ],
            "category_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Category'),
                    "showInGrid" => false,
                    "showInFilter" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "category_id"]
            ],
        ];
    }
}