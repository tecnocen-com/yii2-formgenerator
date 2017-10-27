<?php

class m170101_000006_form_section extends tecnocen\rmdb\migrations\CreateEntity
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_form_section';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->unsigned()->notNull(),
            'form_id' => $this->normalKey(),
            'name' => $this->string(16)->notNull(),
            'label' => $this->string(64)->notNull(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return ['form_id' => 'formgenerator_form'];
    }

    /**
     * @inheritdoc
     */
    public function compositeUniqueKeys()
    {
        return [
            'name' => ['form_id', 'name'],
            'position' => ['form_id', 'position'],
        ];
    }
}
