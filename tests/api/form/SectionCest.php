<?php
namespace form;

use ApiTester;
use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\SectionFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to form/<form_id:\d+>/section resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class SectionCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    /**
     * @depends FormCest:fixtures
     */
    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'section' => [
                'class' => SectionFixture::class,
                'depends' => [],
            ],
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
        $I->wantTo('Retrieve list of Section records.');
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
                    'expand' => 'form',
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 3,
                ],
            ],
            'not found form' => [
                'urlParams' => [
                    'form_id' => 15,
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'form_id' => 1,
                    'created_by' => 1,
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 3,
                ],
            ],
            'filter by name' => [
                'urlParams' => [
                    'form_id' => 1,
                    'name' => 'personal',
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
                ],
            ],
            'rule created_by' => [
                'urlParams' => [
                    'form_id' => 1,
                    'created_by' => 'wo',
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
        $I->wantTo('Retrieve Section single record.');
        $this->internalView($I, $example);
    }

    /**
     * @return array<string,array<string,string>> data for test `view()`.
     */
    protected function viewDataProvider()
    {
        return [
            'single record' => [
                'url' => '/form/1/section/1',
                'data' => [
                    'expand' => 'form, sectionFields, fields',
                ],
                'httpCode' => HttpCode::OK,
                'response' => [
                    '_embedded' => [
                        'sections' => [
                            ['id' => 1],
                        ],
                    ],
                ],
            ],
            'not found form and section' => [
                'urlParams' => [
                    'form_id' => 10,
                    'id' => 10,
                    'expand' => 'sections'
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found form record' => [
                'urlParams' => [
                    'form_id' => 10,
                    'id' => 1,
                    'expand' => 'sections'
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found section record' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 10,
                    'expand' => 'sections'
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
        $I->wantTo('Create a Section record.');
        $this->internalCreate($I, $example);
    }

    /**
     * @return array<string,array> data for test `create()`.
     */
    protected function createDataProvider()
    {
        return [
            'create form 1' => [
                'urlParams' => [
                    'form_id' => 1,
                ],
                'data' => [
                    'name' => 'asignatures',
                    'label' => 'Asignatures',
                ],
                'httpCode' => HttpCode::CREATED,
            ],
            'unique' => [
                'urlParams' => [
                    'form_id' => 1,
                ],
                'data' => [
                    'name' => 'asignatures',
                    'label' => 'Asignatures',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Section name "asignatures" already in use for this form.'
                ],
            ],
            'to short' => [
                'urlParams' => [
                    'form_id' => 1,
                ],
                'data' => [
                    'name' => 'fo',
                    'label' => 'Fo',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Section name should contain at least 6 characters.',
                    'label' => 'Section label should contain at least 6 characters.',
                ],
            ],
            'not blank' => [
                'urlParams' => [
                    'form_id' => 1,
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Section name cannot be blank.',
                    'label' => 'Section label cannot be blank.'
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
        $I->wantTo('Update a Section record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update form 1' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 3,
                ],
                'data' => [
                    'name' => 'asignatures2',
                    'label' => 'Asignatures 2',
                    'position' => 1
                ],
                'httpCode' => HttpCode::OK,
            ],
            'to short' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 3,
                ],
                'data' => [
                    'name' => 'fo',
                    'label' => 'Fo',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'name' => 'Section name should contain at least 6 characters.',
                    'label' => 'Section label should contain at least 6 characters.',
                ],
            ],
        ];
    }

    /**
     * @param  ApiTester $I
     * @param  Example $example
     * @dataprovider deleteDataProvider
     * @depends fixtures
     * @depends form\section\SectionFieldCest:delete
     * @before authToken
     */
    public function delete(ApiTester $I, Example $example)
    {
        $I->wantTo('Delete a Section record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete form 1' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 3,
                ],
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 3,
                ],
                'httpCode' => HttpCode::NOT_FOUND,
                'validationErrors' => [
                    'name' => 'The record "3" does not exists.'
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
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'form/<form_id:\d+>/section';
    }
}
