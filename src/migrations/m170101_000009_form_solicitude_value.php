<?php

class m170101_000009_form_solicitude_value
    extends tecnocen\formgenerator\migrations\BaseTable
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_form_solicitude_value';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'solicitude_id' => $this->normalKey(),
            'section_id' => $this->normalKey(),
            'field_id' => $this->normalKey(),
            'value' => $this->string(128),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return [
            'solicitude_id' => 'formgenerator_form_solicitude',
            'field' => [
                'table' => 'formgenerator_form_section_field',
                'columns' => [
                    'section_id' => 'section_id',
                    'field_id' => 'field_id',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function compositePrimaryKeys()
    {
        return [
            'solicitude_id',
            'section_id',
            'field_id',
        ];
    }
}
