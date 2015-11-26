<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Attribute',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Attribute'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="attribute-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
