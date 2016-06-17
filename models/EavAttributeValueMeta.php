<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 */
class EavAttributeValueMeta extends MetaFields
{
    /**
     * Возвращает массив для привязки к городам
     * @return array
     */
    public function getAttributes()
    {
        $models = EavAttribute::find()->published()->orderBy(["label"=>SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "name");
    }
    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "value" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextAreaField::class,
                    "title" => Yii::t('backend', 'Value'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "value"]
            ],

            "entityId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'EntityId'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "entityId"]
            ],

            "attributeId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::class,
                    "title" => Yii::t('backend', 'Attribute'),
                    "showInFilter" => false,
                    "eagerLoading" => true,
                    "showInExtendedFilter" => false,
                    "data" => [$this, "getAttributes"], // массив всех типов (см. выше)
                    "gridAttr" => 'label'
                ],
                "params" => [$this->owner, "attributeId", "eavAttribute"] // id и relation getEntity
            ],

            "optionId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'Option'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "optionId"]
            ],

        ];
    }
}