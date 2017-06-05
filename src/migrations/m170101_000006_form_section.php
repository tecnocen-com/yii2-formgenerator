<?php

class m170101_000006_form_section
    extends tecnocen\formgenerator\migrations\BaseTable
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
            'form_id' => $this->normalKey(),
            'name' => $this->string(16)->unique()->notNull(),
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
}
