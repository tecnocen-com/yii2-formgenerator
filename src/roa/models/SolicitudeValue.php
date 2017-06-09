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
    public function attributes()
    {
        return array_merge(parent::attributes(), ['resourceId']);

    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $resourceId = $this->section_id . '/' . $this->field_id;
        $this->setAttribute('resourceId', $resourceId);
        $this->setOldAttribute('resourceId', $resourceId);
    }

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => 'resourceId',
            'resourceName' => 'value',
            'parentSlugRelation' => 'solicitude',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks() + [
            'values' => $this->getSelfLink() . '/value',
        ];
    }
}
