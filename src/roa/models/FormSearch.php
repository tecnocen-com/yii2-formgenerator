<?php

namespace tecnocen\formgenerator\roa\models;

use yii\data\ActiveDataProvider;

/**
 * Contract to filter and sort collections of `Form` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class FormSearch extends Form implements \tecnocen\roa\ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'resourceName' => 'form',
        ];
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['created_by'], 'integer'],
            [['name'], 'string'],
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
                ->andFilterWhere(['like', 'name', $this->name]),
        ]);
    }
}
