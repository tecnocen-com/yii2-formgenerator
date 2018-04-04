<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_solicitude_value}}`
 *
 * @property integer $section_id
 * @property integer $field_id
 * @property integer $solicitude_id
 * @property string $value
 *
 * @property SectionField $sectionField
 * @property Section $section
 * @property Field $field
 * @property Solicitude $solicitude
 */
class SolicitudeValue extends \tecnocen\rmdb\models\Entity
{
    /**
     * @var string full class name of the model used in the relation
     * `getSectionField()`.
     */
    protected $sectionFieldClass = SectionField::class;

    /**
     * @var string full class name of the model used in the relation
     * `getSection()`.
     */
    protected $sectionClass = Section::class;

    /**
     * @var string full class name of the model used in the relation
     * `getField()`.
     */
    protected $fieldClass = Field::class;

    /**
     * @var string full class name of the model used in the relation
     * `getSolicitude()`.
     */
    protected $solicitudeClass = Solicitude::class;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_solicitude_value}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + [
            'section_id' => 'integer',
            'field_id' => 'integer',
            'solicitude_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'field_id', 'solicitude_id'], 'required'],
            [['section_id', 'field_id', 'solicitude_id'], 'integer'],
            [
                ['solicitude_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Solicitude::class,
                'targetAttribute' => ['solicitude_id' => 'id'],
            ],
            [
                ['section_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Section::class,
                'targetAttribute' => ['section_id' => 'id'],
                'when' => function () {
                    return !$this->hasErrors('solicitude_id');
                },
                'filter' => function ($query) {
                    $query->andWhere(['form_id' => $this->solicitude->form_id]);
                },
                'message' => 'Section is not associated to the form.',
            ],
            [
                ['field_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SectionField::class,
                'targetAttribute' => [
                    'section_id' => 'section_id',
                    'field_id' => 'field_id',
                ],
                'when' => function () {
                    return !$this->hasErrors('section_id');
                },
                'message' => 'Field not associated to the Section.',
            ],
            [
                ['field_id'],
                'unique',
                'targetAttribute' => [
                    'section_id',
                    'field_id',
                    'solicitude_id',
                ],
                'when' => function () {
                    return !$this->hasErrors('section_id')
                        && !$this->hasErrors('solicitude_id');
                },
                'message' => 'Field already filled.',
            ],
            [['raw'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        if (null === $this->value) {
            // memento
            $this->value = $this->field->dataType->readFieldValue($this->raw);
        }

        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->raw = $this->field->dataType->storeFieldValue($this, $this->raw);
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function load($params, $formName)
    {
        parent::load($params, $formName);
        $this->field->dataType
            ->loadFieldValue($model, $params, $formName);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'section_id' => 'Section ID',
            'field_id' => 'Field ID',
            'label' => 'label',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionField()
    {
        return $this->hasOne(
            $this->sectionFieldClass,
            ['section_id' => 'section_id', 'field_id' => 'field_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne($this->sectionClass, ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne($this->fieldClass, ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitude()
    {
        return $this->hasOne($this->solicitudeClass, ['id' => 'solicitude_id']);
    }
}
