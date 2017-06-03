<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_field_rule_property}}`
 *
 * @property integer $rule_id
 * @property string $property
 * @property string $value
 *
 * @property FieldRule $rule
 */
class FieldRuleProperty extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_field_rule_property}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + ['rule_id' => 'integer'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rule_id', 'property', 'value'], 'required'],
            [['rule_id'], 'integer'],
            [
                ['rule_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => FieldRule::class,
                'targetAttribute' => ['rule_id' => 'id'],
            ],
            [['property', 'value'], 'trim'],
            [['property', 'value'], 'string'],
            [
                ['property'],
                'unique',
                'targetAttribute' => ['rule_id', 'property'],
                'message' => 'Property already in use for this rule.',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'rule_id' => 'Rule ID',
            'property' => 'Property',
            'value' => 'Value',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(
            $this->getNamespace() . '\\FieldRule',
            ['id' => 'rule_id']
        );
    }
}
