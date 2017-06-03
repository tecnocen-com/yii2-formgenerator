<?php

namespace tecnocen\formgenerator\models;

use yii\base\Model;

/**
 * Model class for table `{{%formgenerator_field}}`
 *
 * @property integer $id
 * @property integer $data_type_id
 * @property string $name
 * @property string $label
 *
 * @property DataType $dataType
 * @property Rules[] $rules
 */
class Field extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_field}}';
    }
 
    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + [
            'id' => 'integer',
            'data_type_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_type_id', 'name', 'label'], 'required'],
            [['data_type_id'], 'integer'],
            [
                ['data_type_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DataType::class,
                'targetAttribute' => ['data_type_id' => 'id'],
            ],
            [['name', 'label'], 'string', 'min' => 4],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => 'ID',
            'data_type_id' => 'Data Type ID',
            'name' => 'Field name',
            'label' => 'Field label',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataType()
    {
        return $this->hasOne(
            $this->getNamespace() . '\\DataType',
            ['data_type_id' => 'id']
        )->inverseOf('form');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\FieldRule',
            ['field_id' => 'id']
        )->inverseOf('field');
    }

    public function attachValidators(Model $model, $attributes)
    {
        foreach ($this->rules as $rule) {
            $model->validators[] = $rule->buildValidator($model, $attributes);
        }
    }
}
