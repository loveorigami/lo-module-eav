<?php
/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Option',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Attribute'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
