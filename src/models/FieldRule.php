<?php

namespace tecnocen\formgenerator\models;

use yii\base\Model;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\validators\Validator;

/**
 * Model class for table `{{%formgenerator_field_rule}}`
 *
 * @property integer $id
 * @property integer $field_id
 * @property string $validator
 *
 * @property Field $field
 * @property FieldRuleProperty[] $properties
 */
class FieldRule extends \tecnocen\rmdb\models\Entity
{
    /**
     * @var string full class name of the model used in the relation
     * `getField()`.
     */
    protected $fieldClass = Field::class;

    /**
     * @var string full class name of the model used in the relation
     * `getProperties()`.
     */
    protected $propertyClass = FieldRuleProperty::class;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_field_rule}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + [
            'id' => 'integer',
            'field_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id', 'validator'], 'required'],
            [['field_id'], 'integer'],
            [
                ['field_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Field::class,
                'targetAttribute' => ['field_id' => 'id'],
            ],
            [['validator'], 'string', 'min' => 2],
            [['validator'], function ($attribute) {
                $validator = $this->$attribute;

                if (!isset(Validator::$builtInValidators[$validator])
                    && !is_subclass_of($validator, Validator::class)
                ) {
                    $this->addError(
                        $attribute,
                        "'$validator' must be a valid validator."
                    );
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'field_id' => 'Field ID',
            'class' => 'Validator Class',
        ], parent::attributeLabels());
    }

    /**
     * @return ActiveQuery
     */
    public function getField(): ActiveQuery
    {
        return $this->hasOne($this->fieldClass, ['id' => 'field_id']);
    }

    /**
     * @retur ActiveQuery
     */
    public function getProperties(): ActiveQuery
    {
        return $this->hasMany($this->propertyClass, ['rule_id' => 'id'])
            ->inverseOf('rule');
    }

    /**
     * Builds a validator for the model.
     *
     * The validator will get attachedk the properties stored in the database.
     *
     * @param Model $model
     * @param string|array $attributes
     * @return Validator
     */
    public function buildValidator(Model $model, $attributes): Validator
    {
        return Validator::createValidator(
            $this->validator,
            $model,
            (array) $attributes,
            ArrayHelper::map($this->properties, 'property', 'value')
        );
    }
}
