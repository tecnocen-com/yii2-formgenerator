<?php

namespace tecnocen\formgenerator\roa\models;

use yii\data\ActiveDataProvider;

class SolicitudeSearch extends Solicitude implements \tecnocen\roa\ResourceSearch
{
    /**
     * @inhertidoc
     */
    protected function slugConfig()
    {
        return [
            'idAttribute' => [],
            'parentSlugRelation' => 'form',
            'resourceName' => 'form',
        ];
    }

    /**
     * @inhertidoc
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['value']);
    }

    /**
     * @inhertidoc
     */
    public function rules()
    {
        return [
            [['form_id'], 'required'],
            [['form_id', 'created_by'], 'integer'],
            [['value'], 'default', 'value' => []],
            [['value'], 'validateValues'],
        ];
    }

    public function validateValues($attribute, $params, $validator)
    {
        $values = $this->$attribute;
        if (!is_array($values)) {
            $validator->addError(
                $this,
                $attribute,
                '{attribute} must receive an array'
            );
            return;
        }
        foreach ($values as $field_id => $value) {
            if (is_string($field_id)) {
                $validator->addError(
                    $this,
                    $attribute,
                    '`value` only accepts key integers to filter by `field_id`.'
                );
            }
            if (empty($value)) {
                $validator->addError(
                    $this,
                    $attribute,
                    '`value`  must not be empty.'
                );
            }
        }
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
        $query = $class::find()->andFilterWhere([
            'form_id' => $this->form_id,
            'created_by' => $this->created_by,
        ]);
        foreach ($this->value as $field_id => $value) {
            $alias = "value_$field_id";
            $query->andWhere([
                'exists',
                SolicitudeValue::find()->andWhere([
                    'and',
                    'solicitude_id = id',
                    [
                        'field_id' => $field_id,
                        'value' => $value,
                    ],
                ])
            ]);
        }
        return new ActiveDataProvider(['query' => $query]);
    }
}
