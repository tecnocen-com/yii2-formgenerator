<?php

namespace tecnocen\formgenerator\roa\resources\form\section;

use Yii;
use tecnocen\formgenerator\roa\models\SectionField;
use tecnocen\formgenerator\roa\models\SectionFieldSearch;

/**
 * CRUD resource for `SectionField` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $idAttribute = 'field_id';

    /**
     * @inheritdoc
     */
    public $modelClass = SectionField::class;

    /**
     * @inheritdoc
     */
    public $searchClass = SectionFieldSearch::class;

    /**
     * @inheritdoc
     */
    public $filterParams = ['section_id'];
}
