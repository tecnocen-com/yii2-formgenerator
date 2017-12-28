<?php

class m170101_000003_field extends tecnocen\rmdb\migrations\CreateEntity
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
            'name' => $this->string(32)->unique()->notNull(),
            'label' => $this->text()->notNull(),
            'service' => $this->text()->defaultValue(null)
                ->comment('url for a web service to provide searcheable data'),
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
