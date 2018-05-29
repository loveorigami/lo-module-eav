<?php
namespace lo\modules\eav\models\meta;

use lo\modules\eav\models\EavAttribute;
use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;


/**
 * Class EavAttributeMeta
 * Мета описание модели
 *
 * @property array $attributes
 */
class EavValueMeta extends MetaFields
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

            "entity_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'EntityId'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "entity_id"]
            ],

            "item_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'ItemId'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "item_id"]
            ],

            "attribute_id" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::class,
                    "title" => Yii::t('backend', 'Attribute'),
                    'relationName' => 'eavAttribute',
                    "showInFilter" => false,
                    "eagerLoading" => true,
                    "showInExtendedFilter" => false,
                    "data" => [$this, "getAttributes"], // массив всех типов (см. выше)
                    "gridAttr" => 'label'
                ],
                "params" => [$this->owner, "attribute_id", "eavAttribute"] // id и relation getEntity
            ],
        ];
    }
}