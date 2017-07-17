<?php

namespace tecnocen\formgenerator\roa\models;

use yii\helpers\Url;
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
      $selfLink = $this->getSelfLink();
      return $this->getSlugLinks() + [
          'rules' => $selfLink . '/rule',
          'dataType' => $this->dataType->getSelfLink(),
          'curies' => [
              'expand' => Url::to($selfLink, ['expand' => '{rel}']),
          ],
          'expand:properties' => 'properties',
      ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return ['dataType'];
    }
}
