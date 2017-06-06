<?php

namespace tecnocen\formgenerator\models;

use yii\web\UploadedFile;

/**
 * Model class for table `{{%formgenerator_form}}`
 *
 * @property integer $id
 * @property string $name
 * @property string $cast
 *
 * @property Section[] $sections
 */
class DataType extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%formgenerator_data_type}}';
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
            [['name', 'cast'], 'required'],
            [['name', 'cast'], 'string', 'min' => 4],
            [['name'], 'unique'],
            [['cast'], 'verifyCast'],
        ];
    }

    /**
     * @return Callable
     */
    protected function getCastCallable()
    {
         $values = explode(':', $this->cast, 2);
         return isset($values[1]) 
             ? [$values[0], $values[1]]
             : [static::class, $values[0]];
    }

    protected function castValue(SolicitudeValue $model, $attribute)
    {
         $callable = $this->getCastCallabe();
         $model->$attribute = $callable($model->$attribute, $attribute);
    }

    public function verifyCast($attribute)
    {
         if (!is_callable($this->getCastCallable())) {
             $this->addError(
                 $attribute,
                 '`cast` must be an statically callable method.'
             );
         }
    }

    public static function booleanCast($value, $attribute)
    {
        return (bool)$value;
    }

    public static function integerCast($value, $attribute)
    {
        return (int)$value;
    }

    public static function stringCast($value, $attribute)
    {
        return (string)$value;
    }

    public static function floatCast($value, $attribute)
    {
        return (float)$value;
    }

    public static function fileCast($value, $attribute)
    {
        if (null !== ($uploadedFile = UploadedFile::getInstanceByName(
            $attribute
        ))) {
            return $uploadedFile;
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'id' => 'ID',
            'name' => 'Data Type name',
            'cast' => 'Type Cast Method',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(
            $this->getNamespace() . '\\Field',
            ['data_type_id' => 'id']
        )->inverseOf('dataType');
    }
}
