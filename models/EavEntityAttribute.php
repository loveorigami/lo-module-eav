<?php

namespace lo\modules\eav\models;

use Yii;

/**
 * This is the model class for table "{{%eav__entity_attribute}}".
 *
 */
class EavEntityAttribute extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%eav__entity_attribute}}';
    }

}