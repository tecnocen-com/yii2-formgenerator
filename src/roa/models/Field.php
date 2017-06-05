<?php

namespace tecnocen\formgenerato\roa\models;

use yii\web\Linkable;

/**
 * ROA contract handling Field records.
 */
class Field extends \tecnocen\formgenerator\models\Field
    implements Linkable
{
    use SlugTrait;

    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return ['resourceName' => 'field'];
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        return $this->getSlugLinks() + [
            'rules' => $this->getSelfLink() . '/rule',
        ];
    }
}
