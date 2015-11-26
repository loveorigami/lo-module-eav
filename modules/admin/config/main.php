<?php

return [
    'modules' => [
        'eav' => [
            'class' => 'lo\modules\eav\modules\admin\Module',
            'defaultRoute' => 'attribute',
			'menuItems' => [
                [
                    'label' => Yii::t('common', 'Attributes'),
                    'url' => ['/eav/attribute/index'],
                ],
            ]
        ],
    ],
];