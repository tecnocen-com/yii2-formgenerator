<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;

class FileDataStrategy implements DataStrategy
{
    /**
     * @var string folder where the file will be stored. Can be an alias.
     */
    protected $filePath = '@webroot/uploads';

    /**
     * @var string url to access the saved file. Can be an alias.
     */
    protected $fileUrl = '@web/uploads';

    public function __construct()
    {
    }

    public function load(SolicitudeValue $model, $data, $formName = null)
    {
    }

    public function store(SolicitudeValue $model, $value)
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
