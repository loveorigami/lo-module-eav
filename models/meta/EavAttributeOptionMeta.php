<?php

namespace lo\modules\eav\models\meta;

use lo\modules\eav\models\EavAttribute;
use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;
use lo\core\db\fields;

/**
 * Class EavAttributeMeta
 * Мета описание модели
 *
 * @property array $attributes
 */
class EavAttributeOptionMeta extends MetaFields
{
    /**
     * Возвращает массив для привязки
     * @return array
     */
    public function getAttributes()
    {
        $models = EavAttribute::find()->published()->orderBy(["name" => SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "name");
    }

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "attribute_id" => [
                "definition" => [
                    "class" => fields\HasOneField::class,
                    'relationName' => 'eavAttribute',
                    "title" => Yii::t('backend', 'Attribute'),
                    "data" => [$this, "getAttributes"], // массив всех типов (см. выше)
                    "editInGrid" => false,
                    "isRequired" => true,
                ],
                "params" => [$this->owner, "attribute_id", "attribute"] // id и relation getAttribute
            ],
            "value" => [
                "definition" => [
                    "class" => fields\TextField::class,
                    "title" => Yii::t('backend', 'Value'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "value"]
            ],
        ];
    }
}