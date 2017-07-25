<?php

namespace tecnocen\formgenerator\roa\models;

use yii\data\ActiveDataProvider;

class SectionFieldSearch extends SectionField implements \tecnocen\roa\ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'parentSlugRelation' => 'field',
            'resourceName' => 'section',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['section_id'], 'required'],
            [['section_id', 'position', 'created_by'], 'integer'],
            [['label'], 'string'],
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
                    'section_id' => $this->form_id,
                    'created_by' => $this->created_by,
                    'position' => $this->position,
                ])
                ->andFilterWhere(['like', 'label', $this->label]),
            'sort' => [
                'defaultOrder' => [
                    'position' => SORT_ASC,
                ]
            ]
        ]);
    }
}
