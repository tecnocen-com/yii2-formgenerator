<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_form}}`
 *
 * @property integer $id
 * @property string $name
 *
 * @property Section[] $sections
 */
class Form extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_form}}';
    }

    /**
     * @inheritdoc
     */
    protected function attributeTypecast()
    {
        return parent::attributeTypecast() + ['id' => 'integer'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'min' => 6],
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
            'name' => 'Form name',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\Section',
            ['section_id' => 'id']
        )->inverseOf('form');
    }
}
