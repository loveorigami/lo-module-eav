<?php

namespace lo\modules\eav\models\meta;

use lo\modules\eav\models\EavAttributeType;
use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;
use lo\core\helpers\FA;
use lo\core\db\fields;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 *
 * @property array $types
 */
class EavAttributeMeta extends MetaFields
{

    /**
     * Возвращает массив для привязки
     * @return array
     */
    public function getTypes()
    {
        $models = EavAttributeType::find()->orderBy(["name" => SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "name");
    }

    /**
     * @return array
     */
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
                    "class" => fields\TextField::class,
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
                    "class" => fields\TextField::class,
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
                    "class" => fields\ListField::class,
                    "inputClassOptions" => [
                        "options" => [
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
                    "class" => fields\HasOneField::class,
                    'relationName' => 'eavType',
                    "title" => Yii::t('backend', 'Type'),
                    "data" => [$this, "getTypes"],
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "type_id"]
            ],

            "required" => [
                "definition" => [
                    "class" => fields\CheckBoxField::class,
                    "title" => Yii::t('backend', 'Required'),
                    "showInGrid" => true,
                    "editInGrid" => true,
                    "showInFilter" => true,
                ],
                "params" => [$this->owner, "required"]
            ],

            "default_value" => [
                "definition" => [
                    "class" => fields\TextField::class,
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