<?php

class m170101_000003_field
    extends tecnocen\formgenerator\migrations\BaseTable
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_field';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'id' => $this->primaryKey(),
            'data_type_id' => $this->normalKey(),
            'name' => $this->string(16)->unique()->notNull(),
            'label' => $this->string(64)->notNull(),            
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return ['data_type_id' => 'formgenerator_data_type'];
    }
}
