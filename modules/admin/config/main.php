<?php

return [
    'modules' => [
        'eav' => [
            'class' => 'lo\modules\eav\modules\admin\Module',
            'defaultRoute' => 'entity-model',
			'menuItems' => [
                [
                    'label' => 'Entity',
                    'url' => ['/eav/entity-model/index'],
                ],
                [
                    'label' => 'Attribute',
                    'url' => ['/eav/attribute/index'],
                ],
                [
                    'label' => 'Option',
                    'url' => ['/eav/option/index'],
                ],
                [
                    'label' => 'Type',
                    'url' => ['/eav/type/index'],
                ],
                [
                    'label' => 'Value',
                    'url' => ['/eav/value/index'],
                ],
            ]
        ],
    ],
];