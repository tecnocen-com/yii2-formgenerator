<?php

use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\FieldRulePropertyFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to field/<field_id:\d+>/rule/<rule_id:\d+>/property resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class FieldRulePropertyCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'access_tokens' => OauthAccessTokensFixture::class,
            'field_rule_property' => FieldRulePropertyFixture::class,
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
        $I->wantTo('Retrieve list of FieldRuleProperty records.');
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
                    'rule_id' => 3
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
            ],
            'not found field' => [
                'urlParams' => [
                    'field_id' => 250,
                    'rule_id' => 3
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'field_id' => 3,
                    'rule_id' => 3,
                    'created_by' => 1,
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
            ],
            'rule field_by' => [
                'urlParams' => [
                    'field_id' => 'fi',
                    'rule_id' => 'ru',
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
        $I->wantTo('Retrieve FieldRuleProperty single record.');
        $this->internalView($I, $example);
    }

    /**
     * @return array<string,array<string,string>> data for test `view()`.
     */
    protected function viewDataProvider()
    {
        return [
            'single record' => [
                'urlParams' => [
                    'field_id' => 3,
                    'rule_id' => 3
                ],
                'httpCode' => HttpCode::OK,
            ],
            'not found field record' => [
                'urlParams' => [
                    'field_id' => 500,
                    'rule_id' => 3
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found rule record' => [
                'urlParams' => [
                    'field_id' => 1,
                    'rule_id' => 500
                ],
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
        $I->wantTo('Create a FieldRuleProperty record.');
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
                    'field_id' => 3,
                    'rule_id' => 3,
                    'property' => 'max',
                    'value' => 50
                ],
                'httpCode' => HttpCode::CREATED,
            ],
            'unique and invalid id' => [
                'urlParams' => [
                    'field_id' => 3,
                    'rule_id' => 3,
                    'property' => 'max',
                    'value' => 50
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'property' => 'Property already in use for this rule.',
                ],
            ],
            'not blank' => [
                'urlParams' => [
                    'field_id' => 3,
                    'rule_id' => 3,
                    'property' => '',
                    'value' => 50
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'property' => 'Property cannot be blank.',
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
        $I->wantTo('Update a FieldRuleProperty record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update field 1' => [
                'url' => '/field/3/rule/3/property/max',
                'data' => [
                    'value' => 60
                ],
                'httpCode' => HttpCode::OK,
            ]
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
        $I->wantTo('Delete a FieldRuleProperty record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete field 1' => [
                'url' => '/field/3/rule/3/property/max',
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'url' => '/field/3/rule/3/property/max',
                'httpCode' => HttpCode::NOT_FOUND,
                'validationErrors' => [
                    'property' => 'The record max does not exists.',
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
            'property' => 'string',
            'value' => 'string'
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'field/<field_id:\d+>/rule/<rule_id:\d+>/property';
    }
}
