<?php

namespace tecnocen\formgenerator\roa\resources;

use tecnocen\formgenerator\roa\models\Field;

/**
 * CRUD resource for `Field` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldResource extends \tecnocen\roa\controllers\OAuth2Resource
{
    /**
     * @inheritdoc
     */
    $idAttribute = 'field.id';

    /**
     * @inheritdoc
     */
    public $modelClass = Field::class;

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->alias('field')->innerJoinWith(['dataType']);
    }
}
