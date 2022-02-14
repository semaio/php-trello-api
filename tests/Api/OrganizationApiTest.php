<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\Organization\OrganizationBoardsApi;
use Semaio\TrelloApi\Api\OrganizationApi;

/**
 * @group unit
 */
class OrganizationApiTest extends ApiTestCase
{
    /**
     * @test
     */
    public function shouldShowOrganization(): void
    {
        $response = [
            'id' => '54744b094fef0c7d704ca379',
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with('organizations/54744b094fef0c7d704ca379')
            ->willReturn($response);

        static::assertEquals($response, $api->show('54744b094fef0c7d704ca379'));
    }

    /**
     * @test
     */
    public function shouldGetOrganizationBoardsApiObject(): void
    {
        static::assertInstanceOf(OrganizationBoardsApi::class, $this->getApiMock()->boards());
    }

    protected function getApiClass()
    {
        return OrganizationApi::class;
    }
}
