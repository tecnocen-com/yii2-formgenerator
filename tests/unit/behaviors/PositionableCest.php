<?php

use tecnocen\formgenerator\behaviors\Positionable;
use tecnocen\formgenerator\models\Form;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class PositionableCest
{
    protected $model;

    public function attach(UnitTester $I)
    {
        $I->expectException(
            new InvalidConfigException(
                Positionable::class . '::$parentAttribute must be set.'
            ),
            function () {
                $model = new Component();
                $model->attachBehavior('positionable', new Positionable());
            }
        );

        $I->expectException(
            new InvalidConfigException(
                Positionable::class
                    . '::$owner must extend '
                    . ActiveRecord::class
            ),
            function () {
                $model = new Component();
                $model->attachBehavior('positionable', new Positionable([
                    'parentAttribute' => 'none',
                ]));
            }
        );

        $I->expectException(
            new InvalidConfigException(
                Form::class . '::$none is not an attribute.'
            ),
            function () {
                $model = new Form();
                $model->attachBehavior('positionable', new Positionable([
                    'parentAttribute' => 'none',
                ]));
            }
        );

        $I->expectException(
            new InvalidConfigException(
                Form::class . '::$position is not an attribute.'
            ),
            function () {
                $model = new Form();
                $model->attachBehavior('positionable', new Positionable([
                    'parentAttribute' => 'id',
                ]));
            }
        );
    }
}
