<?php

namespace tecnocen\formgenerator\models;

/**
 * Model class for table `{{%formgenerator_data_type}}`
 *
 * @property string $name
 * @property string $class
 *
 * @property Field[] $fields
 */
class DataType extends \tecnocen\rmdb\models\Entity
{
    protected $strategy;
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
            [['class'], 'verifyClass'],
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
        $strategyClass = $this->class;
        $this->strategy = new $strategyClass();
        if (!$this->strategy instanceof DataTypeInterface) {
            throw new InvalidParamException(
                static::class . "::\$class '{$strategyClass}' must implement "
                    . DataTypeInterface::class
            );
        }
    }

    public function loadFieldValue(Model $model, $params, $formName)
    {
        return $this->strategy->load($model, $params, $formName);
    }

    public function storeFieldValue(Model $model, $raw)
    {
        return $this->strategy->store($model, $raw);
    }

    public function readFieldValue($raw)
    {
        return $this->strategy->read($raw);
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
