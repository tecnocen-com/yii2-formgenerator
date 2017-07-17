<?php

namespace tecnocen\formgenerator\roa\models;

use yii\helpers\Url;
use yii\web\Link;
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
              'expand' => new Link([
                  'href' => Url::to([$selfLink, 'expand' => '{rel}']),
                  'name' => 'expand',
                  'templated' => true,
                  'title' => 'expand values to embed at the resource.',
              ]),
          ],
          'expand:properties' => 'dataType',
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
