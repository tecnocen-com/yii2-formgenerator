<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\Form;
use tecnocen\formgenerator\roa\models\FormSearch;

/**
 * CRUD resource for `Form` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FormResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Form::class;

    /**
     * @inheritdoc
     */
    public $searchClass = FormSearch::class;
}
