<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav_entity_model}}".
 *
 * @property integer $id
 * @property string $entity_name
 * @property string $entity_model
 *
 * @property EavAttribute[] $eavAttributes
 */
class EavEntityModel extends \lo\core\db\ActiveRecord
{
    public $tplDir = '@lo/modules/eav/modules/admin/views/entity-model/tpl/';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav__entity_model}}';
    }
    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EavEntityModelMeta::class;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributes()
    {
        return $this->hasMany(EavAttribute::class, ['id' => 'entity_id'])
            ->viaTable('{{%eav__entity_attribute}}', ['attribute_id' => 'id'])
            ->orderBy(['order' => SORT_DESC]);
    }
}