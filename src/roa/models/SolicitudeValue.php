<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\formgenerator\models as base;
use tecnocen\roa\hal\Contract;
use tecnocen\roa\hal\ContractTrait;
use yii\helpers\Url;
use yii\web\Link;

/**
 * ROA contract handling SolicitudeValue records.
 */
class SolicitudeValue extends base\SolicitudeValue implements Contract
{
    use ContractTrait {
        getLinks as getContractLinks;
    }

    /**
     * @inheritdoc
     */
    protected $sectionFieldClass = SectionField::class;

    /**
     * @inheritdoc
     */
    protected $sectionClass = Section::class;

    /**
     * @inheritdoc
     */
    protected $fieldClass = Field::class;

    /**
     * @inheritdoc
     */
    protected $solicitudeClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        $selfLink = $this->getSelfLink();

        return array_merge($this->getContractLinks(), [
            'field' => $this->field->getSelfLink(),
            'section' => $this->section->getSelfLink(),
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function slugBehaviorConfig(): array
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
    public function extraFields()
    {
        return [
            'field',
            'section',
            'sectionField',
            'solicitude',
        ];
    }
}
