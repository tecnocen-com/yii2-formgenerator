<?php

namespace tecnocen\formgenerator\dataTypes;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class FileDataType implements DataTypeInterface
{
    /**
     * @var string folder where the file will be stored. Can be an alias.
     */
    protected $filePath = '@webroot';

    /**
     * @var string url to access the saved file. Can be an alias.
     */
    protected $fileUrl = '@web';

    public function __construct()
    {
    }

    public function load(Model $model, $data, $formName = null)
    {
    }

    public function store(Model $model, $value)
    {
        $name = $this->getName($value);
        $value->saveAs(Yii::getAlias($this->filePath . '/' . $name));

        return $name;
    }

    public function read($raw)
    {
        return Yii::getAlias($this->fileUrl . '/' . $raw);
    }

    /**
     * @return string name used to store the file into the folder and database.
     */
    protected function getName(UploadedFile $value)
    {
        return $value->getName();
    }
}
