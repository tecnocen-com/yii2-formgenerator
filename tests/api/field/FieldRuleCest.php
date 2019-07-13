<?php

namespace field;

use ApiTester;
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

    /**
     * @depends FieldCest:fixtures
     */
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
                    'rule_class' => 'string',
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
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
                'data' => [
                    'expand' => 'field, properties',
                ],
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
                    'field_id' => 1,
                ],
                'data' => ['rule_class' => 'string'],
                'httpCode' => HttpCode::CREATED,
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
            'update field rule 1' => [
                'urlParams' => [
                    'field_id' => 1,
                    'id' => '1',
                ],
                'httpCode' => HttpCode::METHOD_NOT_ALLOWED,
                'data' => [],
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
            'delete field rule 1' => [
                'urlParams' => [
                    'field_id' => 1,
                    'id' => 16,
                ],
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'urlParams' => [
                    'field_id' => 1,
                    'id' => 16,
                ],
                'httpCode' => HttpCode::NOT_FOUND,
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
            'rule_class' => 'string'
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
