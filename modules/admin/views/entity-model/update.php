<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Entity model',
]) . ' ' . $model->entity_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Entity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->entity_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="entity-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
