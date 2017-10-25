<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_solicitude}}`
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $label
 *
 * @property Form $form
 * @property SolicitudeValue $values
 */
class Solicitude extends \tecnocen\rmdb\models\Entity
{
    /**
     * @var string full class name of the model used in the relation
     * `getForm()`.
     */
    protected $formClass = Form::class;

    /**
     * @var string full class name of the model used in the relation
     * `getSolicitudeValues()`.
     */
    protected $solicitudeValueClass = SolicitudeValue::class;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_solicitude}}';
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
    public function rules()
    {
        return [
            [['form_id'], 'required'],
            [['form_id'], 'integer'],
            [
                ['form_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Form::class,
                'targetAttribute' => ['form_id' => 'id'],
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
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne($this->formClass, ['id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(
            $this->solicitudeValueClass,
            ['solicitude_id' => 'id']
        )->inverseOf('solicitude');
    }
}
