<?php

namespace tecnocen\formgenerator\roa\models;

use yii\helpers\Url;
use yii\web\Linkable;
use yii\web\NotFoundHttpException;

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
    protected $dataTypeClass = DataType::class;

    /**
     * @inheritdoc
     */
    protected $ruleClass = FieldRule::class;
    /**
     * @inheritdoc
     */
    protected function slugConfig()
    {
        return [
            'resourceName' => 'field',
            'checkAccess' => function ($params) {
                if (isset($params['field_id'])
                    && $params['field_id'] != $this->id
                ) {
                    throw new NotFoundHttpException(
                        'Field doesnt contain the requested route.'
                    );
                }
            }
        ];
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
        return ['dataType', 'rules'];
    }
}
