<?php

namespace tecnocen\formgenerator\roa\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ROA collection for SolicitudeValue records.
 */
class SolicitudeValueSimpleSearch extends SolicitudeValue implements
    \tecnocen\roa\ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'parentSlugRelation' => null,
            'resourceName' => 'solicitude-value',
        ];
    }

    /**
     * @inhertidoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['form_id']);
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['form_id', 'solicitude_id', 'section_id', 'field_id'], 'integer'],
            [['value'], 'safe'],
        ];
    }

    /**
     * @inhertidoc
     */
    public function search(array $params, $formName = '')
    {
        $this->load($params, $formName);
        if (!$this->validate()) {
            return null;
        }
        $this->checkAccess($params);
        $class = get_parent_class();
        return new ActiveDataProvider([
            'query' => $class::find()->innerJoinWith(['solicitude'])
                ->andFilterWhere([
                    'form_id' => $this->form_id,
                    'solicitude_id' => $this->solicitude_id,
                    'section_id' => $this->section_id,
                    'field_id' => $this->field_id,
                ])->andFilterWhere(['like', 'value', $this->value])
        ]);
    }

    /**
     * @inhertidoc
     */
    public function afterValidate()
    {
        Model::afterValidate();
    }
}
