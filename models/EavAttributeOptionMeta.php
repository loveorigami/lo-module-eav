<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 */
class EavAttributeOptionMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "attributeId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Attribute'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "attributeId"]
            ],
            "value" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Value'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "value"]
            ],
            "defaultOptionId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'DefaultOption'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "defaultOptionId"]
            ],
        ];
    }
}