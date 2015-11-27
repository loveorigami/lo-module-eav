<?php

namespace lo\modules\eav\helpers;

use lo\modules\eav\models\EavAttribute;
  
class Html extends \yii\helpers\Html
{
    public static function activeEavInput($model, $attribute, $options = [])
    {
        $handlerClass = EavAttribute::find()
          ->select(['{{%eav__attribute_type}}.handlerClass'])
          ->innerJoin('{{%eav__attribute_type}}', '{{%eav__attribute_type}}.id = {{%eav__attribute}}.typeId')
          ->innerJoin('{{%eav__entity}}', '{{%eav__entity}}.id = {{%eav__attribute}}.entityId')
          ->where([
            '{{%eav__attribute}}.name' => $attribute,
            '{{%eav__entity}}.entityModel' => $model::className()
          ])
          ->scalar();
          
        $name = isset($options['name']) ? $options['name'] : static::getInputName($model, $attribute);
        $eavModel = static::getAttributeValue($model, $attribute);          

        $handler = $eavModel->handlers[$attribute];
        
        $handler->owner->activeForm = $options['form']; 
        
        return $handler->run();
    }
  
}