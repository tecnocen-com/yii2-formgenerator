<?php

class m170101_000002_data_type extends tecnocen\rmdb\migrations\CreatePivot
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
            'name' => $this->string(32)->notNull()->unique(),
            'strategy' => $this->string(64)->notNull(),
        ];
    }
}
