<?php

namespace tecnocen\formgenerator\roa\resources\form;

use Yii;
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

    /**
     * @inheritdoc
     */
    public function baseQuery()
    {
        return parent::baseQuery()->andWhere([
            'form_id' => Yii::$app->request->getQueryParam('form_id'),
        ]);
    }
}
