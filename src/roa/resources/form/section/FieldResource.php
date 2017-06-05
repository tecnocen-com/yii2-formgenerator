<?php

namespace tecnocen\formgenerator\roa\resources\form\section;

use tecnocen\formgenerator\roa\models\SectionField;

/**
 * CRUD resource for `SectionField` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = SectionField::class;
}
