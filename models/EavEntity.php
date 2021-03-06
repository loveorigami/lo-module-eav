<?php

namespace lo\modules\eav\models;

use lo\modules\eav\models\meta\EavEntityMeta;
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
        return EavEntityMeta::class;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityModel()
    {
        return $this->hasOne(EavEntityModel::class, ['id' => 'model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::class, ['id' => 'attribute_id'])
            ->viaTable(EavEntityAttribute::tableName(), ['entity_id' => 'id']);
        //->orderBy(['eav_entity_attribute.order' => SORT_DESC]);
    }
}