<?php
/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Entity model',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Entity model'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-model-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
