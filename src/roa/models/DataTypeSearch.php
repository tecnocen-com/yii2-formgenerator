<?php

namespace tecnocen\formgenerator\roa\models;

use yii\data\ActiveDataProvider;

/**
 * Contract to filter and sort collections of `DataType` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class DataTypeSearch extends DataType implements \tecnocen\roa\ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'resourceName' => 'data-type',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['name', 'label'], 'string'],
            [['created_by'], 'integer'],
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
                ])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'label', $this->label]),
        ]);
    }
}
