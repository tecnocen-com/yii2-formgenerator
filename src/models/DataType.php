<?php

namespace tecnocen\formgenerator\models;

use tecnocen\formgenerator\dataStrategies\DataStrategy;
use yii\base\InvalidConfigException;

/**
 * Model class for table `{{%formgenerator_data_type}}`
 *
 * @property string $name
 * @property string $class
 *
 * @property Field[] $fields
 */
class DataType extends \tecnocen\rmdb\models\Pivot
{
    protected $dataStrategy;
    /**
     * @var string full class name of the model used in the relation
     * `getFields()`.
     */
    protected $fieldClass = Field::class;

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
    public function rules()
    {
        return [
            [['name', 'class'], 'required'],
            [['name', 'class'], 'string', 'min' => 4],
            [['name'], 'unique'],
            [['class'], function ($model, $attribute) {
                if (is_subclass_of($model->$attribute, DataStrategy::class)) {
                    return;
                }
                $model->addErrors($attribute, 'Must implement DataStrategy.');
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->ensureStrategy();
    }

    protected function ensureStrategy()
    {
        $class = $this->class;
        $this->dataStrategy = new $class();
        if (!$this->dataStrategy instanceof DataStrategy) {
            throw new InvalidConfigException(
                static::class . "::\$class '{$class}' must implement "
                    . DataStrategy::class
            );
        }
    }

    public function loadFieldValue(SolicitudeValue $model, $params, $formName)
    {
        return $this->dataStrategy->load($model, $params, $formName);
    }

    public function storeFieldValue(SolicitudeValue $model, $raw)
    {
        return $this->dataStrategy->store($model, $raw);
    }

    public function readValue($raw)
    {
        return $this->dataStrategy->read($raw);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge([
            'name' => 'Data Type name',
            'class' => 'Data Type PHP Class',
        ], parent::attributeLabels());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany($this->fieldClass, ['data_type' => 'name'])
            ->inverseOf('dataType');
    }
}
