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
     * Возвращает массив для привязки
     * @return array
     */
    public function getAtributes()
    {
        $models = EavAttribute::find()->published()->orderBy(["name"=>SORT_ASC])->all();
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
                    "class" => \lo\core\db\fields\HasOneField::className(),
                    "title" => Yii::t('backend', 'Attribute'),
                    "data" => [$this, "getAtributes"], // массив всех типов (см. выше)
                    "editInGrid" => false,
                    "isRequired" => true,
                ],
                "params" => [$this->owner, "attribute_id", "attribute"] // id и relation getAttribute
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
        ];
    }
}