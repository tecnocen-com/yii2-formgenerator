<?php

namespace tecnocen\formgenerator\roa\resources\form;

use tecnocen\formgenerator\roa\models\Section;

/**
 * CRUD resource for `Section` records 
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SectionResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Section::class;
}
