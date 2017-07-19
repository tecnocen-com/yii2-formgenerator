<?php

namespace tecnocen\formgenerator\models;

use tenocen\formgenerator\behaviors\Positionable;

/**
 * Model class for table `{{%formgenerator_form_section}}`
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $name
 * @property string $label
 *
 * @property Form $form
 * @property SectionField[] $sectionFields
 * @property Field[] $fieds
 */
class Section extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_form_section}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + [
            'id' => 'integer',
            'form_id' => 'integer',
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors() + [
            'position' => [
                'class' => Positionable::class,
                'parentAttribute' => 'form_id',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id', 'name', 'label'], 'required'],
            [['form_id'], 'integer'],
            [
                ['form_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Form::class,
                'targetAttribute' => ['form_id' => 'id'],
            ],
            [['name', 'label'], 'trim'],
            [['name', 'label'], 'string', 'min' => 6],
            [
                ['name'],
                'unique',
                'targetAttribute' => ['form_id', 'name'],
                'message' => 'Name already in use for this form.',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => 'ID',
            'form_id' => 'Form ID',
            'name' => 'Section name',
            'label' => 'Section label',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(
            $this->getNamespace() . '\\Form',
            ['id' => 'form_id']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionFields()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\SectionField',
            ['section_id' => 'id']
        )->inverseOf('section');
    }

    /**
     * @return \yii\db\ActiveQuery sibling stages for the same workflow
     */
    public function getFields()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\Field',
            ['id' => 'field_id']
        )->via('sectionFields');
    }
}
