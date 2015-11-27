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
     * Возвращает массив для привязки к городам
     * @return array
     */
    public function getEntities()
    {
        $models = EavEntity::find()->published()->orderBy(["entityName"=>SORT_ASC])->all();
        return ArrayHelper::map($models, "id", "entityName");
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
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
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
        ];
    }
}