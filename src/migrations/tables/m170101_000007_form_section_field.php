<?php
use tecnocen\formgenerator\migrations\SectionFieldConditionSupport;

class m170101_000007_form_section_field extends tecnocen\rmdb\migrations\CreateEntity
{
    use SectionFieldConditionSupport;
    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'formgenerator_form_section_field';
    }

    /**
     * @inheritdoc
     */
    public function columns()
    {
        return array_merge([
            'section_id' => $this->normalKey(),
            'field_id' => $this->normalKey(),
            'position' => $this->integer()->unsigned()->notNull(),
            'label' => $this->text()->defaultValue(null)
                ->comment('When not set it will use the label on field.'),
        ], $this->conditionColumns());
    }

    /**
     * @inheritdoc
     */
    public function foreignKeys()
    {
        return [
            'section_id' => 'formgenerator_form_section',
            'field_id' => 'formgenerator_field',
        ];
    }

    /**
     * @inheritdoc
     */
    public function compositePrimaryKeys()
    {
        return ['section_id', 'field_id'];
    }

    /**
     * @inheritdoc
     */
    public function compositeUniqueKeys()
    {
        return ['position' => ['section_id', 'position']];
    }
}
