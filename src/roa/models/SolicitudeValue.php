<?php

namespace tecnocen\formgenerator\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling Field records.
 */
class SolicitudeValue extends \tecnocen\formgenerator\models\SolicitudeValue
    implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => ['section_id', 'field_id'],
            'resourceName' => 'value',
            'parentSlugRelation' => 'solicitude',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks();
    }
}
