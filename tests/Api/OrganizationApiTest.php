<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Organization\OrganizationBoardsApi;
use Semaio\TrelloApi\Api\OrganizationApi;

#[Group('unit')]
class OrganizationApiTest extends ApiTestCase
{
    #[Test]
    public function shouldShowOrganization(): void
    {
        $response = [
            'id' => '54744b094fef0c7d704ca379',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('organizations/54744b094fef0c7d704ca379')
            ->willReturn($response);

        static::assertEquals($response, $api->show('54744b094fef0c7d704ca379'));
    }

    #[Test]
    public function shouldGetOrganizationBoardsApiObject(): void
    {
        static::assertInstanceOf(OrganizationBoardsApi::class, $this->getApiMock()->boards());
    }

    protected function getApiClass(): string
    {
        return OrganizationApi::class;
    }
}
