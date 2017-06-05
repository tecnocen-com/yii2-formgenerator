<?php

namespace tecnocen\formgenerator\roa\resources\field\rule;

use tecnocen\formgenerator\roa\models\FieldRuleProperty;

/**
 * CRUD resource for `FieldRuleProperty` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class PropertyResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRuleProperty::class;
}
