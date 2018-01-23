<?php

use app\fixtures\OauthAccessTokensFixture;
use app\fixtures\SolicitudeFixture;
use Codeception\Example;
use Codeception\Util\HttpCode;

/**
 * Cest to form/<form_id:\d+>/solicitude resource.
 *
 * @author Carlos (neverabe) Llamosas <carlos@tecnocen.com>
 */
class SolicitudeCest extends \tecnocen\roa\test\AbstractResourceCest
{
    protected function authToken(ApiTester $I)
    {
        $I->amBearerAuthenticated(OauthAccessTokensFixture::SIMPLE_TOKEN);
    }

    public function fixtures(ApiTester $I)
    {
        $I->haveFixtures([
            'access_tokens' => OauthAccessTokensFixture::class,
            'form' => SolicitudeFixture::class,
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
        $I->wantTo('Retrieve list of Solicitude records.');
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
                ],
                'httpCode' => HttpCode::OK,
                'headers' => [
                    'X-Pagination-Total-Count' => 1,
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
        $I->wantTo('Retrieve Solicitude single record.');
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
                ],
                'httpCode' => HttpCode::OK,              
            ],
            'not found form and solicitude' => [
                'urlParams' => [
                    'form_id' => 10,
                    'id' => 10,
                    'expand' => 'solicitudes'
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found form record' => [
                'urlParams' => [
                    'form_id' => 10,
                    'id' => 1,
                    'expand' => 'solicitudes'
                ],
                'httpCode' => HttpCode::NOT_FOUND,
            ],
            'not found solicitude record' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 10,
                    'expand' => 'solicitudes'
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
        $I->wantTo('Create a Solicitude record.');
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
        $I->wantTo('Update a Solicitude record.');
        $this->internalUpdate($I, $example);
    }

    /**
     * @return array[] data for test `update()`.
     */
    protected function updateDataProvider()
    {
        return [
            'update form 1' => [
                'url' => '/form/1/solicitude/1',
                'data' => [
                    'name' => 'asignatures2',
                    'label' => 'Asignatures 2',
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
        $I->wantTo('Delete a Solicitude record.');
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
                    'id' => 1,
                ],
                'httpCode' => HttpCode::NO_CONTENT,
            ],
            'not found' => [
                'urlParams' => [
                    'form_id' => 1,
                    'id' => 1,
                ],
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
            'form_id' => 'integer:>0',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getRoutePattern()
    {
        return 'form/<form_id:\d+>/solicitude';
    }
}
