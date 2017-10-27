<?php

class m170101_000004_field_rule extends tecnocen\rmdb\migrations\CreateEntity
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_field_rule';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'id' => $this->primaryKey(),
            'field_id' => $this->normalKey(),
            'class' => $this->string(64)->notNull(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return ['field_id' => 'formgenerator_field'];
    }
}
