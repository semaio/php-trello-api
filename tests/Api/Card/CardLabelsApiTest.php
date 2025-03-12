<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Semaio\TrelloApi\Api\Card\CardLabelsApi;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

#[Group('unit')]
class CardLabelsApiTest extends ApiTestCase
{
    protected string $apiPath = 'cards/#id#/idLabels';

    #[Test]
    public function shouldSetLabels(): void
    {
        $labels = ['green', 'purple'];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($labels);

        static::assertEquals($labels, $api->set($this->fakeParentId, $labels));
    }

    #[Test]
    public function shouldRemoveALabel(): void
    {
        $response = ['response'];

        $label = 'green';

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with($this->getPath().'/'.$label)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $label));
    }

    protected function getApiClass(): string
    {
        return CardLabelsApi::class;
    }
}
