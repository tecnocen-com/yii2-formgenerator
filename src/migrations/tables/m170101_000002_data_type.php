<?php

class m170101_000002_data_type
    extends tecnocen\rmdb\migrations\CreatePivot
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_data_type';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'id' => $this->primaryKey(),
            'name' => $this->string(16)->notNull()->unique(),
            'cast' => $this->string(64)->notNull(),
        ];
    }
}
