<?php

namespace tecnocen\formgenerator\roa\resources\field;

use Yii;
use tecnocen\formgenerator\roa\models\FieldRule;

/**
 * CRUD resource for `FieldRule` records
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class RuleResource extends \tecnocen\roa\controllers\Resource
{
    /**
     * @inheritdoc
     */
    public $modelClass = FieldRule::class;

    /**
     * @inheritdoc
     */
    public $filterParams = ['field_id', 'class', 'created_by'];

    /**
     * @inheritdoc
     */
    public function verbs()
    {
        $verbs = parent::verbs();
        unset($verbs['update']);

        return $verbs;
    }
}
