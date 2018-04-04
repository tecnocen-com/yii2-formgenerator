<?php

namespace tecnocen\formgenerator\dataTypes;

use yii\base\Model;

/**
 * Strategy to load, store and read information for each data type.
 */
interface DataTypeInterface
{
    /**
     * Construct the strategy.
     */
    public function __construct();

    /**
     * Loads information from the data in the request to the model.
     *
     * @param  Model  $model
     * @param  array|null $data
     * @param  string|null $formName
     */
    public function load(Model $model, $data, $formName = null);

    /**
     * Process the information from the request for its storage.
     *
     * @param  Model  $model
     * @param  mixed $value
     */
    public function store(Model $model, $value);

    /**
     * Takes the information stored in the database and process it to be
     * presented to the end user.
     *
     * @param mixed $raw the raw value stored in the database
     * @return mixed the processed value shown to the end user.
     */
    public function read($raw);
}
