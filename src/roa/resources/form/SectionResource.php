<?php

namespace tecnocen\formgenerator\roa\resources\form;

use Yii;
use tecnocen\formgenerator\roa\models\Section;
use tecnocen\formgenerator\roa\models\SectionSearch;

/**
 * CRUD resource for `Section` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SectionResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Section::class;

    /**
     * @inheritdoc
     */
    public $searchClass = SectionSearch::class;

    /**
     * @inheritdoc
     */
    public $filterParams = ['form_id'];
}
