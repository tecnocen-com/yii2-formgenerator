<?php

namespace tecnocen\formgenerator\migrations;

trait SectionFieldConditionSupport
{
    protected function conditionColumns()
    {
        return [
            'condition_value' => $this->string(32)->defaultValue(null),
            'condition_operator' => $this->string(32)->defaultValue(null),
            'condition_section_id' => $this->normalKey()->defaultValue(null),
            'condition_field_id' => $this->normalKey()->defaultValue(null),
            'condition_effect' => $this->string(32)->defaultValue(null)
        ];
    }

    protected function conditionForeignKeys()
    {
        return [
            'condition_section_field' => [
                'table' => 'formgenerator_form_section_field',
                'onDelete' => 'restrict',
                'onUpdate' => 'restrict',
                'columns' => [
                    'condition_section_id' => 'section_id',
                    'condition_field_id' => 'field_id',
                ],
            ],
        ];
    }
}
