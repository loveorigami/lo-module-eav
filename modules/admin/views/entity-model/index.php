<?php

use lo\core\widgets\admin\Grid;
use lo\core\widgets\admin\CrudLinks;
use lo\core\widgets\admin\TabMenu;

$this->title = Yii::t('backend', 'Entity model');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="entity-model-index">
    <?= $this->render('/_menu'); ?>
    <?=CrudLinks::widget(["action"=>CrudLinks::CRUD_LIST, "model"=>$searchModel])?>
    <?= $this->render('_filter', ['model' => $searchModel]); ?>

    <?php

    /**
     * @var yii\web\View $this
     * @var yii\data\ActiveDataProvider $dataProvider
     */
    echo Grid::widget([
        'dataProvider' => $dataProvider,
        'model' => $searchModel,
    ]);
    ?>

</div>
