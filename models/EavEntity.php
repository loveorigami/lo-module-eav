<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_entity}}".
 *
 * @property integer $id
 * @property string $entityName
 * @property string $entityModel 
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavEntity extends \lo\core\db\ActiveRecord
{
    public $tplDir = '@lo/modules/eav/modules/admin/views/entity/tpl/';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__entity}}';
    }
    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavEntityMeta::className();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityModel()
    {
        return $this->hasOne(EavEntityModel::className(), ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::className(), ['id' => 'attribute_id'])
            ->viaTable(EavEntityAttribute::tableName(), ['entity_id' => 'id']);
        //->orderBy(['eav_entity_attribute.order' => SORT_DESC]);
    }
}