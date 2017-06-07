<?php

namespace tecnocen\formgenerator\roa\modules;

class Version extends \tecnocen\roa\modules\ApiVersion
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'tecnocen\\formgenerator\\roa\\resources';

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

    /**
     * @inheritdoc
     */
    public $resources = [
        self::FORM_ROUTE,
        self::SECTION_ROUTE,
        self::SECTION_FIELD_ROUTE,

        self::DATA_TYPE_ROUTE,

        self::FIELD_ROUTE,
        self::FIELD_RULE_ROUTE,
        self::FIELD_RULE_PROPERTY_ROUTE,

        self::SOLICITUDE_ROUTE,
        self::SOLICITUDE_VALUE_ROUTE,
    ];
}
