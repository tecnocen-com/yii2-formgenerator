<?php

namespace section\field;

use ApiTester;
use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\SectionFieldFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to form/<form_id:\d+>/section/<section_id:\d+>/field resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class SectionFieldCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    /**
     * @depends form\SectionCest:fixtures
     */
    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'section_field' => SectionFieldFixture::class,
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
        $I->wantTo('Retrieve list of SectionField records.');
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
                    'form_id' => 1,
                    'section_id' => 1
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 4,
                ],
            ],
            'not found form' => [
                'urlParams' => [
                    'form_id' => 15,
                    'section_id' => 1
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'form_id' => 1,
                    'section_id' => 1,
                    'created_by' => 1
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 4,
                ],
            ],
            'rule form_id' => [
                'urlParams' => [
                    'form_id' => 1,
                    'section_id' => 1,
                    'created_by' => 'foo',
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
        $I->wantTo('Retrieve SectionField single record.');
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
                    'form_id' => 1,
                    'section_id' => 1,
                    'id' => 4,
                    'expand' => 'field,solicitudeValuesDetail'
                ],
                'httpCode' => HttpCode::OK,
            ],
            'not found form record' => [
                'urlParams' => [
                    'form_id' => 15,
                    'section_id' => 1,
                    'id' => 4
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found section record' => [
                'urlParams' => [
                    'form_id' => 1,
                    'section_id' => 15,
                    'id' => 4
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
        $I->wantTo('Create a SectionField record.');
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
                    'form_id' => 1,
                    'section_id' => 2,
                    'field_id' => 1
                ],
                'httpCode' => HttpCode::OK,
            ],
            'invalid form id' => [
                'urlParams' => [
                    'form_id' => 2,
                    'section_id' => 2,
                    'field_id' => 1
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'already associated field' => [
                'urlParams' => [
                    'form_id' => 1,
                    'section_id' => 1,
                    'field_id' => 4
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'field_id' => 'Field already associated to the section.',
                ],
            ],
            'not blank' => [
                'urlParams' => [
                    'form_id' => 1,
                    'section_id' => 1
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'field_id' => 'Field ID cannot be blank.',
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
        $I->wantTo('Update a SectionField record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update field 1' => [
                'url' => '/form/1/section/1/field/2',
                'data' => [
                    'label'=> 'Label Updated',
                ],
                'httpCode' => HttpCode::OK,
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
        $I->wantTo('Delete a SectionField record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete field 1' => [
                'url' => '/form/1/section/1/field/1',
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'url' => '/form/1/section/1/field/1',
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
            'section_id' => 'integer:>0',
            'field_id' => 'integer:>0',
            'position' => 'integer:>0'
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'form/<form_id:\d+>/section/<section_id:\d+>/field';
    }
}
