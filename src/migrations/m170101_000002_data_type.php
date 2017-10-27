<?php

class m170101_000002_data_type extends tecnocen\rmdb\migrations\CreateEntity
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
            'label' => $this->string(128)->notNull(),
            'cast' => $this->string(64)->notNull(),
        ];
    }
}
