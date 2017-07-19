<?php

namespace tecnocen\formgenerator\behaviors;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveRecordInterface;
use yii\db\Expression as DbExpression;
use yii\validators\Validator;

/**
 * Handles position for a record and its siblings determined by a common
 * `$parentAttribute`.
 *
 * @property ActiveRecordInterface $owner
 */
class Positionable extends \yii\base\Behavior
{
    /**
     * @var string attribute used to determine all the sibling records.
     */
    public $parentAttribute;

    /**
     * @var string attribute which will store the position among siblings.
     */
    public $positionAttibute = 'position';

    /**
     * @inheritdoc
     */
    public function attach($owner)
    {
        if (null !== $this->parentAttribute) {
            throw new InvalidConfigException(
                static::class . '::$parentAttribute must be set.'
            );
        }
        if (!$owner instanceof ActiveRecordInterface) {
            throw new InvalidConfigException(static::class
                . '::$owner must implement'
                .  ActiveRecordInterface::class
            );
        }
        if (!$owner->hasAttribute($this->parentAttribute)) {
            throw new InvalidConfigException(get_class($owner) . '::$'
                . $this->parentAttribute
                . ' is not an attribute.'
            );
        }
        if (!$owner->hasAttribute($this->positionAttribute)) {
            throw new InvalidConfigException(get_class($owner) . '::$'
                . $this->positionAttribute
                . ' is not an attribute.'
            );
        }
        parent::attach($owner);
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            Model::EVENT_BEFORE_VALIDATE => 'attachValidators',
            Model::EVENT_BEFORE_INSERT => 'beforeInsert',
            Model::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            Model::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    /**
     * Attaches validators to the `$owner`.
     */
    public function attachValidators()
    {
        $this->owner->validators[] = Validator::createValidator(
            'default',
            $this->owner,
            $this->positionAttribute,
            [
                'when' => function () {
                    return !$this->owner->hasErrors($this->parentAttribute);
                },
                'value' => function () {
                    return $this->getSiblings()->max('position') + 1;
                }
            ]
        );
        $this->owner->validators[] = Validator::createValidator(
            'integer',
            $this->owner,
            $this->positionAttribute,
            ['min' => 1]
        );
    }

    /**
     * Increases the position by 1 of siblings with equal or bigger position as
     * the new record.
     */
    public function beforeInsert()
    {
        $this->updateSiblingsPosition(
            new DbExpression("{$this->positionAttribute} + 1"),
            [
                '>=',
                $this->positionAttribute,
                $this->owner->getAttribute($this->positionAttribute),
            ]
        );
    }

    /**
     * Forbids updating `$parentAttribute` on the `$owner` record and reorganize
     * position among siblings when changing a record position.
     */
    public function beforeUpdate()
    {
        if ($this->isAttributeChanged($this->parentAttribute)) {
            throw new \yii\base\NotSupportedException(get_class($this->owner)
                . '::$' . $this->parentAttribute
                . ' is not editable.'
            );
        }
        if ($this->isAttributeChanged($this->positionAttribute)) {
            $attribute = $positionAttribute;
            $newPosition = $this->getAttribute($attribute);
            $oldPosition = $this->getOldAttribute($attribute);
            $this->updateSilinbsPosition(0, [$attribute => $oldPosition]);
            if ($newPosition < $oldPosition) {
                $this->updateSiblingsPosition(
                    new DbExpression("$attribute + 1"),
                    ['between', $attribute, $newPosition, $oldPosition]
                );
            } else {
                $this->updateSiblingsPosition(
                    new DbExpression("$attribute - 1"),
                    ['between', $attribute, $oldPosition, $newPosition]
                );
            }
        }
    }

    /**
     * Decreases the position by 1 of siblings with equal or bigger position as
     * the deleted record.
     */
    public function afterDelete()
    {
        $this->updateSiblingsPosition(
            new DbExpression("{$this->positionAttribute} - 1"),
            [
                '>',
                $this->positionAttribute,
                $this->owner->getAttribute($this->positionAttribute),
            ]
        );
    }

    /**
     * Update the position of siblings on the database.
     * @param integer|DbExpression $position the new position.
     * @param array $condition the extra condition to update siblings.
     * @return integer the number of updated siblings.
     */
    protected function updateSilinbsPosition($position, array $condition)
    {
        return $this->owner->updateAll(
            [$this->positionAttribute => $position],
            [
                'and',
                [
                    $this->parentAttribute => $this->owner->getAttribute(
                        $this->parentAttribute
                    )
                ],
                $condition,
            ]
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiblings()
    {
        return $this->owner->hasMany(get_class($owner), [
            $this->parentAttribute => $this->parentAttribute
        ]);
    }
}
