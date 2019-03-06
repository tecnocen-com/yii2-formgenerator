<?php

namespace tecnocen\formgenerator\dataStrategies;

use Yii;
use tecnocen\formgenerator\models\SolicitudeValue;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class FileDataStrategy extends BaseDataStrategy
{
    /**
     * @var string folder where the file will be stored. Can be an alias.
     */
    protected $filePath = '@webroot/uploads';

    /**
     * @var string url to access the saved file. Can be an alias.
     */
    protected $fileUrl = '@web/uploads';

    /**
     * @inheritdoc
     */
    public function load(
        SolicitudeValue $model,
        ?array $data,
        ?string $formName = null
    ): bool {
        $scope = $formName === null ? $model->formName() : $formName;
        $model->raw = UploadedFile::getInstanceByName(
            $scope ? $scope . '[raw]' : 'raw'
        );

        return null !== $model->raw;
    }

    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        $name = $this->getName($value);
        $value->saveAs(Yii::getAlias($this->filePath . '/' . $name));

        return $name;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        return Yii::getAlias($this->fileUrl . '/' . $raw);
    }

    /**
     * @inheritdoc
     */
    public function erase($raw)
    {
        unlink(Yii::getAlias($this->filePath . '/' . $raw));
    }

    /**
     * @return string name used to store the file into the folder and database.
     */
    protected function getName(UploadedFile $value): string
    {
        return $value->getName();
    }
}
