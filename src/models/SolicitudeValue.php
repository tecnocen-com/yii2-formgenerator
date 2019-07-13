<?php

namespace tecnocen\formgenerator\models;

use yii\db\ActiveQuery;

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
            [['value'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterValidate()
    {
        if (!$this->hasErrors()) {
            $field = $this->getField()
                ->with([
                    'dataType',
                    'rules' => function ($query) {
                        $query->modelClass = 'tecnocen\\formgenerator\\models\\FieldRule';
                    },
                    'rules.properties',
                ])
                ->one();
            $this->populateRelation('field', $field);
            foreach ($field->buildValidators($this, 'value')
                as $validator
            ) {
                $validator->validateAttributes($this, ['value']);
            }
            $field->dataType->castValue($this, 'value');
        }
        parent::afterValidate();
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
     * @return ActiveQuery
     */
    public function getSectionField(): ActiveQuery
    {
        return $this->hasOne(
            $this->sectionFieldClass,
            ['section_id' => 'section_id', 'field_id' => 'field_id']
        );
    }

    /**
     * @return ActiveQuery
     */
    public function getSection(): ActiveQuery
    {
        return $this->hasOne($this->sectionClass, ['id' => 'section_id']);
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
    public function getSolicitude(): ActiveQuery
    {
        return $this->hasOne($this->solicitudeClass, ['id' => 'solicitude_id']);
    }
}
