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
 * @property string $rule_class
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
            [['field_id', 'rule_class'], 'required'],
            [['field_id'], 'integer'],
            [
                ['field_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Field::class,
                'targetAttribute' => ['field_id' => 'id'],
            ],
            [['rule_class'], 'string', 'min' => 2],
            // todo check its a valid validator class
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'field_id' => 'Field ID',
            'rule_class' => 'Rule Class',
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
     * @return ActiveQuery
     */
    public function getProperties(): ActiveQuery
    {
        return $this->hasMany($this->propertyClass, ['rule_id' => 'id'])
            ->inverseOf('rule');
    }

    /**
     * @param Model $model
     * @param array $attributes
     */
    public function buildValidator(Model $model, $attributes)
    {
        return Validator::createValidator(
            $this->rule_class,
            $model,
            (array) $attributes,
            ArrayHelper::map($this->properties, 'property', 'value')
        );
    }
}
