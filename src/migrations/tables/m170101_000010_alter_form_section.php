<?php

use yii\db\Migration;

class m170101_000010_alter_form_section extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addForeignKey(
            'fk-formgenerator_form_section',
            'formgenerator_form_section',
            [
                'condition_section_id',
                'condition_field_id' 
            ],
            'formgenerator_form_section_field',
            [
                'section_id',
                'field_id',
            ],
            'restrict',
            'restrict'
        );
    }
}
