<?php

use lo\modules\eav\assets\EavAsset;
use lo\core\widgets\admin\TabMenu;
use yii\bootstrap\Alert;

use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = Yii::t('eav', 'Custom Fields');
$this->params['breadcrumbs'][] = Yii::t('eav', 'EAV');

EavAsset::register($this);
?>
<div class="eav-index">
    <?=TabMenu::widget()?>

    <div class="row">
        <div class="col-sm-12">
            <?= Alert::widget([
                'options' => ['class' => 'alert-primary eav-link-alert'],
                'body' => '<span class="glyphicon glyphicon-refresh glyphicon-spin"></span>',
            ]) ?>

            <?= Alert::widget([
                'options' => ['class' => 'alert-danger eav-link-alert'],
                'body' => Yii::t('eav', 'An error occurred during saving EAV attributes!'),
            ]) ?>

            <?= Alert::widget([
                'options' => ['class' => 'alert-info eav-link-alert'],
                'body' => Yii::t('eav', 'The changes have been saved.'),
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="pull-left" style="margin-right: 10px;">
                        <label class="control-label" for="entityModel">Model: </label>
                        <?= Html::dropDownList('entityModel', null, $entityModels, ['id' => 'entityModel']) ?>
                    </div>
                    <div class="pull-left" style="display: none;">
                        <label class="control-label pull-left" for="entityCategory">
                            <?= Yii::t('eav', 'Category') ?>:
                        </label>
                        <div class="eav-categories-wrapper">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body eav-attributes eav-available">
                    <h4><span class="label label-primary"><?= Yii::t('eav', 'Available Attributes') ?></span></h4>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body eav-attributes eav-selected">
                    <h4><span class="label label-primary"><?= Yii::t('eav', 'Selected Attributes') ?></span></h4>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


