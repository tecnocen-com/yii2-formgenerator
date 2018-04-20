<?php

namespace tecnocen\formgenerator\models;

use yii\base\Model;

/**
 * Model class for table `{{%formgenerator_field}}`
 *
 * @property integer $id
 * @property integer $data_type
 * @property string $name
 * @property string $label
 *
 * @property DataType $dataType
 * @property Rules[] $rules
 */
class Field extends \tecnocen\rmdb\models\Entity
{
    /**
     * @var string full class name of the model used in the relation
     * `getDataType()`.
     */
    protected $dataTypeClass = DataType::class;

    /**
     * @var string full class name of the model used in the relation
     * `getRules()`.
     */
    protected $ruleClass = FieldRule::class;

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_type', 'name', 'label'], 'required'],
            [['data_type'], 'string'],
            [
                ['data_type'],
                'exist',
                'skipOnError' => true,
                'targetClass' => DataType::class,
                'targetAttribute' => ['data_type' => 'name'],
                'message' => 'Unsupported Data Type "{value}".',
            ],
            [['name', 'label', 'service'], 'string', 'min' => 4],
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
            'data_type' => 'Data Type',
            'name' => 'Field name',
            'label' => 'Field label',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataType()
    {
        return $this->hasOne($this->dataTypeClass, ['name' => 'data_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRules()
    {
        return $this->hasMany($this->ruleClass, ['field_id' => 'id'])
            ->inverseOf('field');
    }

    /**
     * @return \yii\validators\Validator[]
     */
    public function buildValidators(Model $model, $attributes)
    {
        $validators = [];
        foreach ($this->rules as $rule) {
            $validators[] = $rule->buildValidator($model, $attributes);
        }
        return $validators;
    }
}
