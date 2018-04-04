<?php

class m170101_000010_data_type_translation extends tecnocen\rmdb\migrations\CreateEntity
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_data_type_translation';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'data_type' => $this->string(32)->notNull(),
            'lang' => $this->string(5)->notNull(),
            'label' => $this->string(64)->notNull(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return [
            'data_type' => [
                'table' => 'formgenerator_data_type',
                'columns' => [
                    'data_type' => 'name',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function compositePrimaryKeys()
    {
        return ['data_type', 'lang'];
    }
}
