<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\Form;

/**
 * CRUD resource for `Form` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FormResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Form::class;
}
