<?php

use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\SolicitudeValueFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to form/<form_id:\d+>/solicitude/<solicitude_id:\d>/value resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class SolicitudeValueCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    /**
     * @depends Solicitude:fixtures
     */
    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'solicitude_value' => [
                'class' => SolicitudeValueFixture::class,
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
        $I->wantTo('Retrieve list of SolicitudeValue records.');
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
                    'solicitude_id' => 1
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 6,
                ],
            ],
            'not found form' => [
                'urlParams' => [
                    'form_id' => 15,
                    'solicitude_id' => 1
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'filter by author' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 1,
                    'created_by' => 1,
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 6,
                ],
            ],
            'filter by value' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 1,
                    'value' => 'Angel',
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
        $I->wantTo('Retrieve SolicitudeValue single record.');
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
                    'solicitude_id' => 1,
                    'value' => 'Manuel'
                ],
                'data' => [
                    'expand' => 'sectionField, section, field, solicitude',
                ],
                'httpCode' => HttpCode::OK,
            ],
            'not found form' => [
                'urlParams' => [
                    'form_id' => 10,
                    'solicitude_id' => 1,
                    'value' => 'Manuel'
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found solicitude record' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 200,
                    'value' => 'Manuel'
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
        $I->wantTo('Create a SolicitudeValue record.');
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
                    'solicitude_id' => 2,
                    'section_id' => 1
                ],
                'data' => [
                    'field_id' => 1,
                    'value' => 'Value Test',
                ],
                'httpCode' => HttpCode::CREATED,
            ],
            'unique' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 2,
                    'section_id' => 1
                ],
                'data' => [
                    'field_id' => 1,
                    'value' => 'Value Test',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'field_id' => 'Field already filled.'
                ],
            ],
            'to short' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 2,
                    'section_id' => 1
                ],
                'data' => [
                    'field_id' => 2,
                    'value' => 'fo',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'value' => 'Value should contain at least 6 characters.',
                ],
            ],
            'not blank' => [
                'urlParams' => [
                    'form_id' => 1,
                    'solicitude_id' => 2,
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'field_id' => 'Field ID cannot be blank.',
                    'section_id' => 'Section ID cannot be blank.'
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
        $I->wantTo('Update a SolicitudeValue record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update form 1' => [
                'url' => '/form/1/solicitude/1/value/1/1',
                'data' => [
                    'value' => 'Value Test Updated',
                ],
                'httpCode' => HttpCode::OK,
            ],
            'to short' => [
                'url' => '/form/1/solicitude/1/value/1/1',
                'data' => [
                    'value' => 'fo',
                ],
                'httpCode' => HttpCode::UNPROCESSABLE_ENTITY,
                'validationErrors' => [
                    'value' => 'Value should contain at least 6 characters.',
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
        $I->wantTo('Delete a SolicitudeValue record.');
        $this->internalDelete($I, $example);
    }

    /**
     * @return array[] data for test `delete()`.
     */
    protected function deleteDataProvider()
    {
        return [
            'delete form 1' => [
                'url' => '/form/1/solicitude/1/value/1/1',
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'url' => '/form/1/solicitude/1/value/1/1',
                'httpCode' => HttpCode::NOT_FOUND,
                'validationErrors' => [
                    'name' => 'The record "6" does not exists.'
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
            'solicitude_id' => 'integer:>0',
            'section_id' => 'integer:>0',
            'field_id' => 'integer:>0',
            'value' => 'string',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'form/<form_id:\d+>/solicitude/<solicitude_id:\d+>/value';
    }
}
