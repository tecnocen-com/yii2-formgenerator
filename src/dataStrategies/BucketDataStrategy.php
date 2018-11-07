<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;
use yii2tech\filestorage\BucketInterface;
use yii\web\UploadedFile;

/**
 * Data strategy which utilizes the `BucketInterface` to store uploaded files.
 *
 * Needs to extends this class and implement the `getBucket()` method.
 *
 * ```php
 * class ImageBucketDataStrategy extends BucketDataStrategy
 * {
 *     public function getBucket(): BucketInterface
 *     {
 *         return Yii::$app->fileStorage->getBucket('images');
 *     }
 * }
 * ```
 *
 * This assumes there is a component `fileStorage` configured in the application
 * and it contains a bucket named 'images'.
 *
 * > Requires yii2tech/file-storage
 *
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
abstract class BucketDataStrategy extends BaseDataStrategy
{
    /**
     * @return BucketInterface the bucket which will be used to store uploaded
     * files.
     */
    abstract public getBucket(): BucketInterface;

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
            $scope ? $scope '[raw]' : 'raw'
        );

        return null !== $model->raw;
    }

    /**
     * @inheritdoc
     */
    public function store(SolicitudeValue $model, $value)
    {
        $name = $this->getName($value);
        $this->getBucket()->copyFileIn($value->tempName, $name);

        return $name;
    }

    /**
     * @inheritdoc
     */
    public function read($raw)
    {
        return $this->getBucket()->getFileUrl($raw);
    }

    /**
     * @inheritdoc
     */
    public function erase($raw)
    {
        $this->getBucket()->deleteFile($raw);
    }
 
   /**
     * @return string name used to store the file into the folder and database.
     */
    protected function getName(UploadedFile $value): string
    {
        return $value->getName();
    }
}
