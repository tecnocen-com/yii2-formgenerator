<?php

namespace tecnocen\formgenerator\dataStrategies;

use tecnocen\formgenerator\models\SolicitudeValue;

/**
 * Strategy to load, store and read information for each data type.
 */
interface DataStrategy
{
    /**
     * Construct the strategy.
     */
    public function __construct();

    /**
     * Loads information from the data in the request to the model.
     *
     * @param  SolicitudeValue $model
     * @param  ?array $data
     * @param  ?string $formName
     * @return bool whether the data was loaded
     */
    public function load(
        SolicitudeValue $model,
        ?array $data,
        ?string $formName = null
    ): bool;

    /**
     * Process the information from the request for its storage.
     *
     * @param Model  $model
     * @param mixed $value
     * @return mixed the value to be stored on the database
     */
    public function store(SolicitudeValue $model, $value);

    /**
     * Takes the information stored in the database and process it to be
     * presented to the end user.
     *
     * @param mixed $raw the raw value stored in the database
     * @return mixed the processed value shown to the end user.
     */
    public function read($raw);

    /**
     * Called after deleting a SolicitudeValue record.
     *
     * @param mixed $raw
     */
    public function erase($raw);
}
