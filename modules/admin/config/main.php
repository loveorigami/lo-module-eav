<?php

return [
    'modules' => [
        'eav' => [
            'class' => 'lo\modules\eav\modules\admin\Module',
            'defaultRoute' => 'default',
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
        ],
    ],
];