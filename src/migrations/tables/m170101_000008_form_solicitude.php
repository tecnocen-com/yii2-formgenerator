<?php

class m170101_000008_form_solicitude extends tecnocen\rmdb\migrations\CreateEntity
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_solicitude';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'id' => $this->primaryKey(),
            'form_id' => $this->normalKey(),
            'current_section_id' => $this->integer()->unsigned()->defaultValue(null),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return ['form_id' => 'formgenerator_form'];
    }
}
