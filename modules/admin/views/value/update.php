<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Entity',
]) . ' ' . $model->entityId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Value'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->entityId, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="value-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
