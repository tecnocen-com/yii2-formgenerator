<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\roa\ResourceSearch;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ROA collection for SolicitudeValue records.
 */
class SolicitudeValueSearch extends SolicitudeValue implements ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugBehaviorConfig(): array
    {
        return [
            'idAttribute' => [],
            'parentSlugRelation' => 'solicitude',
            'resourceName' => 'value',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['solicitude_id'], 'required'],
            [['solicitude_id', 'section_id', 'field_id'], 'integer'],
            [['value'], 'safe'],
        ];
    }

    /**
     * @inhertidoc
     */
    public function search(
        array $params,
        ?string $formName = ''
    ): ?ActiveDataProvider {
        $this->load($params, $formName);
        if (!$this->validate()) {
            return null;
        }
        $this->checkAccess($params);
        $class = get_parent_class();

        return new ActiveDataProvider([
            'query' => $class::find()->innerJoinWith(['solicitude'])
                ->andFilterWhere([
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
