<?php

namespace tecnocen\formgenerator\roa\resources\form\section;

use Yii;
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

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->andWhere([
            'section_id' => Yii::$app->request->getQueryParam('section_id'),
        ]);
    }
}
