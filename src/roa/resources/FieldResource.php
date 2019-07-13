<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\Field;
use tecnocen\formgenerator\roa\models\FieldSearch;
use yii\db\ActiveQuery;

/**
 * CRUD resource for `Field` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = Field::class;

    /**
     * @inheritdoc
     */
    public $searchClass = FieldSearch::class;

    /**
     * @inheritdoc
     */
    public function baseQuery(): ActiveQuery
    {
        return parent::baseQuery()->alias('field')->with(['dataType']);
    }
}
