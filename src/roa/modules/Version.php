<?php

namespace tecnocen\formgenerator\roa\modules;

use tecnocen\formgenerator\roa\resources;

class Version extends \tecnocen\roa\modules\ApiVersion
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = resources::class;

    const FORM_ROUTE = 'form';
    const SECTION_ROUTE = self::FORM_ROUTE . '/<form_id:\d+>/section';
    const SECTION_FIELD_ROUTE = self::SECTION_ROUTE . '/<section_id:\d+>/field';

    const DATA_TYPE_ROUTE = 'data-type';

    const FIELD_ROUTE = 'field';
    const FIELD_RULE_ROUTE = self::FIELD_ROUTE . '/<field_id:\d+>/rule';
    const FIELD_RULE_PROPERTY_ROUTE = self::FIELD_RULE_ROUTE
        . '/<rule_id:\d+>/property';

    const SOLICITUDE_ROUTE = self::FORM_ROUTE . '/<form_id:\d+>/solicitude';
    const SOLICITUDE_VALUE_ROUTE = self::SOLICITUDE_ROUTE
        . '/<solicitude_id:\d+>/value';

    const SOLICITUDE_VALUE_SEARCH_ROUTE = 'solicitude-value';

    /**
     * @inheritdoc
     */
    public $resources = [
        self::FORM_ROUTE,
        self::SECTION_ROUTE,
        self::SECTION_FIELD_ROUTE,

        self::DATA_TYPE_ROUTE => [
            'urlRule' => ['tokens' => ['{id}' => '<id:\w+>']],
        ],

        self::FIELD_ROUTE,
        self::FIELD_RULE_ROUTE,
        self::FIELD_RULE_PROPERTY_ROUTE => [
            'class' => resources\field\rule\PropertyResource::class,
            'urlRule' => ['tokens' => ['{id}' => '<id:\w+>']],
        ],

        self::SOLICITUDE_ROUTE,
        self::SOLICITUDE_VALUE_ROUTE => [
            'class' => resources\form\solicitude\ValueResource::class,
            'urlRule' => [
                'tokens' => [
                    '{section_id}' => '<section_id:\d+>',
                    '{id}' => '<id:\d+>',
                ],
                'patterns' => [
                    'PUT,PATCH {section_id}/{id}' => 'update',
                    'DELETE {section_id}/{id}' => 'delete',
                    'GET,HEAD {section_id}/{id}' => 'view',
                    'POST' => 'create',
                    'GET,HEAD {section_id}' => 'index',
                    'GET,HEAD' => 'index',
                    '{section_id}' => 'options',
                    '{section_id}/{id}' => 'options',
                    '' => 'options',
                ],
            ],
        ],
    ];
}
