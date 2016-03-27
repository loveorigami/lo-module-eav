<?php
/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Value'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
