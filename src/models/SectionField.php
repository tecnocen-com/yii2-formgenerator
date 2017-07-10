<?php

namespace tecnocen\formgenerator\models;

use Yii;

/**
 * Model class for table `{{%formgenerator_form_section_field}}`
 *
 * @property integer $section_id
 * @property integer $field_id
 * @property string $label
 *
 * @property Section $section
 * @property Field $field
 * @property SolicitudeValue $solicitudeValues
 * @property array $solicitudeValuesData
 * @property array $solicitudeValuesDataDetail
 */
class SectionField extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_form_section_field}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + [
            'section_id' => 'integer',
            'field_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'field_id'], 'required'],
            [['section_id', 'field_id'], 'integer'],
            [
                ['section_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Section::class,
                'targetAttribute' => ['section_id' => 'id'],
            ],
            [
                ['field_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Field::class,
                'targetAttribute' => ['field_id' => 'id'],
                'message' => 'The field does not exists.',
            ],
            [['label'], 'trim'],
            [['label'], 'string'],
            [
                ['field_id'],
                'unique',
                'targetAttribute' => ['section_id', 'field_id'],
                'message' => 'Field already associated to the section.',
            ],
        ];
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
    public function getSection()
    {
        return $this->hasOne(
            $this->getNamespace() . '\\Section',
            ['id' => 'section_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(
            $this->getNamespace() . '\\Field',
            ['id' => 'field_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudeValues()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\SolicitudeValue',
            [
                'field_id' => 'field_id',
                'section_id' => 'section_id',
            ]
        )->inverseOf('sectionField');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudeValuesData()
    {
        return Yii::configure(
                $this->getSolicitudeValues(),
                ['multiple' => false]
            )
            ->select([
                'amount' => 'count(value)',
                'amountDistinct' => 'count(distinct value)',
            ])
            ->groupBy(['section_id', 'field_id'])
            ->inverseOf(null)
            ->asArray();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudeValuesDataDetail()
    {
        return $this->getSolicitudeValues()
            ->select([
                'field_id',
                'section_id',
                'value',
                'amount' => 'count(value)',
            ])
            ->groupBy(['field_id', 'section_id', 'value'])
            ->inverseOf(null)
            ->asArray();
    }
}
