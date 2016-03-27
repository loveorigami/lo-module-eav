<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;
use lo\core\helpers\FA;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 */
class EavAttributeMeta extends MetaFields
{

    /**
     * Возвращает массив для привязки
     * @return array
     */
    public function getTypes()
    {
        $models = EavAttributeType::find()->published()->orderBy(["name" => SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "name");
    }

    public static function getIconsList()
    {
        return FA::getIconsList();
    }

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Field'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "name"]
            ],

            "label" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Label'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "label"]
            ],

            "icon" => [
                "definition" => [
                    "class" => \lo\core\db\fields\ListField::className(),
                    "inputClassOptions" => [
                        "options"=>[
                            'class' => 'clearfix non-styler form-control fa-font-family',
                            'encode' => false,
                        ],
                    ],
                    "title" => Yii::t('backend', 'Icon'),
                    "data" => [$this, "getIconsList"],
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "icon"]
            ],

            "type_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::className(),
                    "title" => Yii::t('backend', 'Type'),
                    "data" => [$this, "getTypes"], // массив всех типов (см. выше)
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "type_id", "eavType"] // id и relation getEavType
            ],

            "required" => [
                "definition" => [
                    "class" => \lo\core\db\fields\CheckBoxField::className(),
                    "title" => Yii::t('common', 'Required'),
                    "showInGrid" => true,
                    "editInGrid" => true,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "required"]
            ],

            "default_value" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'defaultValue'),
                    "showInGrid" => true,
                    "showInFilter" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "default_value"]
            ],
        ];
    }
}