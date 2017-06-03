<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_form_section_field}}`
 *
 * @property integer $section_id
 * @property integer $field_id
 * @property string $label
 *
 * @property Section $section
 * @property Field $field
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
                'targetClass' => Section::class,
                'targetAttribute' => ['field_id' => 'id'],
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
            ['id' => 'section_id']
        );
    }
}
