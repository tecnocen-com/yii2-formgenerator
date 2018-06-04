<?php

namespace tecnocen\formgenerator\models;

trait SectionFieldConditionSupport
{
    protected function conditionRules()
    {
        return [
            [
                [
                    'condition_value',
                    'condition_operator',
                    'condition_section_id',
                    'condition_field_id',
                    'condition_effect',
                ],
                'required',
                'when' => function () {
                    return !empty($this->condition_value)
                        || !empty($this->condition_operator)
                        || !empty($this->condition_section_id)
                        || !empty($this->condition_field_id)
                        || !empty($this->condition_effect);
                },
                'message' => 'Required to set the condition.',
            ],
            [
                [
                    'condition_value',
                    'condition_operator',
                    'condition_effect',
                ],
                'string',
            ],
            [
                [
                    'condition_section_id',
                    'condition_field_id',
                ],
                'integer',
            ],
            [
                ['condition_field_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => SectionField::class,
                'targetAttribute' => [
                    'condition_section_id' => 'section_id',
                    'condition_field_id' => 'field_id',
                ],
                'when' => function () {
                    return !$this->hasErrors('condition_section_id');
                },
                'message' => 'Condtion Field not associated to the Section.',
            ],
        ];
    }
}
