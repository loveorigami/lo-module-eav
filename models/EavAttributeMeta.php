<?php
namespace lo\modules\eav\models;

use Yii;
use lo\core\db\MetaFields;
use yii\helpers\ArrayHelper;


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
    public function getEntities()
    {
        $models = EavEntity::find()->published()->orderBy(["entityName" => SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "entityName");
    }

    /**
     * Возвращает массив для привязки
     * @return array
     */
    public function getOptions()
    {
        $upd = constant($this->owner->className() . "::SCENARIO_UPDATE");

        if ($this->owner->scenario == $upd) {
            $models = EavAttributeOption::find()
                ->published()
                ->orderBy(["value" => SORT_ASC])
                ->where('attributeId=' . $this->owner->id)
                ->all();
        } else {
            $models = EavAttributeOption::find()
                ->published()
                ->orderBy(["value" => SORT_ASC])
                ->all();
        };

        return ArrayHelper::map($models, "id", "value");
    }

    /**
     * Возвращает массив для привязки
     * @return array
     */
    public function getTypes()
    {
        $models = EavAttributeType::find()->published()->orderBy(["name" => SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "name");
    }

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "entityId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::className(),
                    "title" => Yii::t('backend', 'Entity'),
                    "data" => [$this, "getEntities"], // массив всех типов (см. выше)
                    "eagerLoading" => true,
                    "gridAttr" => 'entityName'
                ],
                "params" => [$this->owner, "entityId", "entity"] // id и relation getEntity
            ],
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
            "typeId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::className(),
                    "title" => Yii::t('backend', 'Type'),
                    "data" => [$this, "getTypes"], // массив всех типов (см. выше)
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "typeId", "eavType"] // id и relation getEavType
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
            "order" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'Order'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "order"]
            ],
            "defaultValue" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::className(),
                    "title" => Yii::t('backend', 'defaultValue'),
                    "showInGrid" => true,
                    "showInFilter" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "defaultValue"]
            ],
            "defaultOptionId" => [
                "definition" => [
                    "class" => \lo\core\db\fields\HasOneField::className(),
                    "title" => Yii::t('backend', 'defaultOptionId'),
                    "data" => [$this, "getOptions"], // массив всех типов (см. выше)
                    "gridAttr" => 'value',
                    "editInGrid" => false,
                    "eagerLoading" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "defaultOptionId", "defaultOption"] // id и relation getDefaultOption
            ],
        ];
    }
}