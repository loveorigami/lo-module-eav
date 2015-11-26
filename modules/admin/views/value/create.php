<?php
/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Value',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Value'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
