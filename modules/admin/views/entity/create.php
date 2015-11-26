<?php
/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Entity',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Entity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entity-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
