<?php

namespace tecnocen\formgenerator\models;

use tecnocen\formgenerator\dataStrategies\DataStrategy;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;

/**
 * Model class for table `{{%formgenerator_data_type}}`
 *
 * @property string $name
 * @property string $strategy
 * @property-read DataStrategy $dataStrategy
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
            [['strategy'], function ($model, $attribute) {
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

    /**
     * Creates the `dataStrategy` object
     */
    protected function ensureStrategy()
    {
        $class = $this->strategy;
        $this->dataStrategy = new $class();
        if (!$this->dataStrategy instanceof DataStrategy) {
            throw new InvalidConfigException(
                static::class . "::\$class '{$class}' must implement "
                    . DataStrategy::class
            );
        }
    }

    /**
     * @return DataStrategy
     */
    public function getDataStrategy(): DataStrategy
    {
        return $this->dataStrategy;
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
     * @return ActiveQuery
     */
    public function getFields(): ActiveQuery
    {
        return $this->hasMany($this->fieldClass, ['data_type' => 'name'])
            ->inverseOf('dataType');
    }
}
