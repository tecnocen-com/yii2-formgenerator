<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\roa\ResourceSearch;
use yii\data\ActiveDataProvider;

/**
 * Contract to filter and sort collections of `Section` records.
 *
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SectionSearch extends Section implements ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugBehaviorConfig()
    {
        return [
            'idAttribute' => [],
            'parentSlugRelation' => 'form',
            'resourceName' => 'section',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['form_id'], 'required'],
            [['form_id', 'position', 'created_by'], 'integer'],
            [['name', 'label'], 'string'],
        ];
    }

    /**
     * @inhertidoc
     */
    public function search(array $params, $formName = '')
    {
        $this->load($params, $formName);
        $this->getBehavior('position')->attachValidators = false;
        if (!$this->validate()) {
            return null;
        }
        $class = get_parent_class();

        return new ActiveDataProvider([
            'query' => $class::find()->andFilterWhere([
                    'form_id' => $this->form_id,
                    'created_by' => $this->created_by,
                    'position' => $this->position,
                ])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'label', $this->label]),
            'sort' => [
                'defaultOrder' => [
                    'position' => SORT_ASC,
                ]
            ]
        ]);
    }
}
