<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 */
class EavAttributeMeta extends MetaFields
{
    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('common', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
        ];
    }
}