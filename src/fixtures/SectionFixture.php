<?php

namespace tecnocen\formgenerator\fixtures;

use tecnocen\formgenerator\models\Section;

/**
 * Fixture to load `Section` records.
 * @author Angel (Faryshta) Guevara <aguevara@alquimiadigital.mx>
 */
class SectionFixture extends \yii\test\ActiveFixture
{
    /**
     * @inheritdoc
     */
    public $modelClass = Section::class;

    /**
     * @inheritdoc
     */
    public $dataFile = __DIR__ . '/data/Section.php';
}
