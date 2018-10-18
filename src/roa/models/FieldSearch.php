<?php

namespace tecnocen\formgenerator\roa\models;

use tecnocen\roa\ResourceSearch;
use yii\data\ActiveDataProvider;

/**
 * Contract to filter and sort collections of `Field` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FieldSearch extends Field implements ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'resourceName' => 'field',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['data_type_id', 'created_by'], 'integer'],
            [['name', 'label'], 'string'],
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
        $class = get_parent_class();
        return new ActiveDataProvider([
            'query' => $class::find()->andFilterWhere([
                    'created_by' => $this->created_by,
                    'data_type_id' => $this->data_type_id,
                ])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'label', $this->label]),
        ]);
    }
}
