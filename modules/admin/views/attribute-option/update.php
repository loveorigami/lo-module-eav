<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Option',
]) . ' ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Option'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="option-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
