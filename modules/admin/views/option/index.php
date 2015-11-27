<?php

use lo\core\widgets\admin\Grid;
use lo\core\widgets\admin\CrudLinks;
use lo\core\widgets\admin\TabMenu;

$this->title = Yii::t('backend', 'Option');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="option-index">
    <?=TabMenu::widget()?>
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
