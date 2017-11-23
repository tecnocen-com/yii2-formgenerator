<?php

class m170101_000005_field_rule_property
    extends tecnocen\rmdb\migrations\CreatePivot
{
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_field_rule_property';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return [
            'rule_id' => $this->normalKey(),
            'property' => $this->string(64)->notNull(),
            'value' => $this->string(64)->notNull(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return ['rule_id' => 'formgenerator_field_rule'];
    }

    /**
     * @inheritdoc
     */
    public function compositePrimaryKeys()
    {
        return ['rule_id', 'property'];
    }
}
