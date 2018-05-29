<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 24.05.2018
 * Time: 14:53
 */

use yii\bootstrap\Nav;

echo Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px'
    ],
    'items' => [
        [
            'label' => 'Entity',
            'url' => ['/eav/entity-model/index'],
        ],
        [
            'label' => 'Form',
            'url' => ['/eav/default/index'],
        ],
        [
            'label' => 'Attribute',
            'url' => ['/eav/attribute/index'],
        ],
        [
            'label' => 'Option',
            'url' => ['/eav/attribute-option/index'],
        ],
        [
            'label' => 'Type',
            'url' => ['/eav/attribute-type/index'],
        ],
        [
            'label' => 'Value',
            'url' => ['/eav/value/index'],
        ],
    ]
]);