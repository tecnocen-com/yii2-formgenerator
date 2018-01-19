<?php

use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\DataTypeFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to data-type resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class DataTypeCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'access_tokens' => OauthAccessTokensFixture::class,
            'data_type' => DataTypeFixture::class,
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
        $I->wantTo('Retrieve list of DataType records.');
        $this->internalIndex($I, $example);
    }

    /**
     * @return array<string,array> for test `index()`.
     */
    protected function indexDataProvider()
    {
        return [
            'list' => [
                'url' => '/data-type',
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 5,
                ],
            ],
            'not found data-type' => [
                'url' => '/data-type/15',
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'created_by' => 1,
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 5,
                ],
            ],
            'filter by name' => [
                'urlParams' => [
                    'name' => 'string',
                    'label' => 'String'
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
            ],
            'rule created_by' => [
                'urlParams' => [
                    'created_by' => 'da',
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
        $I->wantTo('Retrieve DataType single record.');
        $this->internalView($I, $example);
    }

    /**
     * @return array<string,array<string,string>> data for test `view()`.
     */
    protected function viewDataProvider()
    {
        return [
            'single record' => [
                'url' => '/data-type/1',
                'httpCode' => HttpCode::OK,
            ],
            'not found data type record' => [
                'url' => '/data-type/8',
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
        $I->wantTo('Create a DataType record.');
        $this->internalCreate($I, $example);
    }

    /**
     * @return array<string,array> data for test `create()`.
     */
    protected function createDataProvider()
    {
        return [
            'create data-type 6' => [
                'urlParams' => [
                    'name' => 'hello',
                    'label' => 'Hello',
                    'cast' => 'helloCast'
                ],
                'httpCode' => HttpCode::CREATED,
            ],
            'unique' => [
                'urlParams' => [
                    'name' => 'string',
                    'label' => 'String',
                    'cast' => 'stringCast'
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Data Type name "string" has already been taken.'
                ],
            ],
            'to short' => [
                'urlParams' => [
                    'name' => 'as',
                    'label' => 'as',
                    'cast' => 'as'
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Data Type name should contain at least 4 characters.',
                    'label' => 'Label should contain at least 4 characters.',
                    'cast' => 'Type Cast Method should contain at least 4 characters.'
                ],
            ],
            'not blank' => [
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Data Type name cannot be blank.',
                    'label' => 'Label cannot be blank.',
                    'cast' => 'Type Cast Method cannot be blank.',
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
        $I->wantTo('Update a DataType record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update data-type 1' => [
                'urlParams' => ['id' => '1'],
                'data' => [
                    'name' => 'test',
                    'label' => 'Test',
                    'cast' => 'testCast'
                ],
                'httpCode' => HttpCode::OK,
            ],
            'to short' => [
                'urlParams' => ['id' => '1'],
                'data' => [
                    'name' => 'da',
                    'label' => 'Da',
                    'cast' => 'ca',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Data Type name should contain at least 4 characters.',
                    'label' => 'Label should contain at least 4 characters.',
                    'cast' => 'Type Cast Method should contain at least 4 characters.',
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
        $I->wantTo('Delete a DataType record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete data-type 1' => [
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
            'name' => 'string',
            'label' => 'string',
            'cast' => 'string',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'data-type';
    }
}
