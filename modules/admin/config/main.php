<?php

return [
    'modules' => [
        'eav' => [
            'class' => 'lo\modules\eav\modules\admin\Module',
            'defaultRoute' => 'entity',
			'menuItems' => [
                [
                    'label' => 'Entity',
                    'url' => ['/eav/entity/index'],
                ],
                [
                    'label' => 'Attribute',
                    'url' => ['/eav/attribute/index'],
                ],
                [
                    'label' => 'Value',
                    'url' => ['/eav/value/index'],
                ],
            ]
        ],
    ],
];