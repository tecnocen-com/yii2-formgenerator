<?php

use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\FieldRuleFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to field/<field_id:\d+>/rule resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class FieldRuleCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'access_tokens' => OauthAccessTokensFixture::class,
            'field_rule' => FieldRuleFixture::class,
        ]);
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider indexDataProvider
     * @depends fixtures
     * @before authToken
     */
    public function index(ApiTester $I, Example $example)
    {
        $I->wantTo('Retrieve list of FieldRule records.');
        $this->internalIndex($I, $example);
    }

    /**
     * @return array<string,array> for test `index()`.
     */
    protected function indexDataProvider()
    {
        return [
            'list' => [
                'urlParams' => [
                    'field_id' => 3,
                    'expand' => 'properties'
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 3,
                ],
            ],
            'not found field' => [
                'url' => '/field/15',
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'field_id' => 1,
                    'created_by' => 1,
                    'expand' => 'properties'
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 3,
                ],
            ],
            'filter by name' => [
                'urlParams' => [
                    'field_id' => 1,
                    'class' => 'string',
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
            ],
            'rule field_by' => [
                'urlParams' => [
                    'field_id' => 'fi',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
            ],
        ];
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider viewDataProvider
     * @depends fixtures
     * @before authToken
     */
    public function view(ApiTester $I, Example $example)
    {
        $I->wantTo('Retrieve FieldRule single record.');
        $this->internalView($I, $example);
    }

    /**
     * @return array<string,array<string,string>> data for test `view()`.
     */
    protected function viewDataProvider()
    {
        return [
            'single record' => [
                'url' => '/field/1/rule/1',
                'httpCode' => HttpCode::OK,
            ],
            'not found field record' => [
                'url' => '/field/8/rule/1',
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found rule record' => [
                'url' => '/field/1/rule/10',
                'httpCode' => HttpCode::NOT_FOUND,
            ],
        ];
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider createDataProvider
     * @depends fixtures
     * @before authToken
     */
    public function create(ApiTester $I, Example $example)
    {
        $I->wantTo('Create a FieldRule record.');
        $this->internalCreate($I, $example);
    }

    /**
     * @return array<string,array> data for test `create()`.
     */
    protected function createDataProvider()
    {
        return [
            'create field 1' => [
                'urlParams' => [
                    'data_type_id' => 1,
                    'name' => 'complete_name',
                    'label' => 'Complete Name',
                ],
                'httpCode' => HttpCode::CREATED,
            ],
            'unique and invalid id' => [
                'urlParams' => [
                    'data_type_id' => 15,
                    'name' => 'complete_name',
                    'label' => 'Complete Name',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'data_type_id' => 'Data Type ID is invalid.',
                    'name' => 'FieldRule name "complete_name" has already been taken.',
                ],
            ],
            'to short' => [
                'urlParams' => [
                    'data_type_id' => 1,
                    'name' => 'co',
                    'label' => 'Co',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'FieldRule name should contain at least 4 characters.',
                    'label' => 'FieldRule label should contain at least 4 characters.',
                ],
            ],
            'not blank' => [
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'data_type_id' => 'Data Type ID cannot be blank.',
                    'name' => 'FieldRule name cannot be blank.',
                    'label' => 'FieldRule label cannot be blank.',
                ],
            ],
        ];
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider updateDataProvider
     * @depends fixtures
     * @before authToken
     */
    public function update(ApiTester $I, Example $example)
    {
        $I->wantTo('Update a FieldRule record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update field 1' => [
                'urlParams' => ['id' => '1'],
                'data' => [
                    'name' => 'first_name',
                    'label' => 'First Name'
                ],
                'httpCode' => HttpCode::OK,
            ],
            'to short' => [
                'urlParams' => ['id' => '1'],
                'data' => [
                    'name' => 'fi',
                    'label' => 'Fi',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'FieldRule name should contain at least 4 characters.',
                    'label' => 'FieldRule label should contain at least 4 characters.',
                ],
            ],
        ];
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider deleteDataProvider
     * @depends fixtures
     * @before authToken
     */
    public function delete(ApiTester $I, Example $example)
    {
        $I->wantTo('Delete a FieldRule record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete field 1' => [
                'urlParams' => ['id' => '1'],
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'urlParams' => ['id' => '1'],
                'httpCode' => HttpCode::NOT_FOUND,
                'validationErrors' => [
                    'name' => 'The record "1" does not exists.'
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function recordJsonType()
    {
        return [
            'id' => 'integer:>0',
            'field_id' => 'integer:>0',
            'class' => 'string'
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'field/<field_id:\d+>/rule';
    }
}
