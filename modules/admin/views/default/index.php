<?php

use lo\modules\eav\assets\EavAsset;
use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = Yii::t('eav', 'Custom Fields');
$this->params['breadcrumbs'][] = Yii::t('eav', 'EAV');

EavAsset::register($this);
?>
<div class="eav-index">

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


