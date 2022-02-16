<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api\Card;

use Semaio\TrelloApi\Api\Card\CardLabelsApi;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Tests\Api\ApiTestCase;

/**
 * @group unit
 */
class CardLabelsApiTest extends ApiTestCase
{
    protected $apiPath = 'cards/#id#/idLabels';

    /**
     * @test
     */
    public function shouldSetLabels(): void
    {
        $labels = ['green', 'purple'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->getPath())
            ->willReturn($labels);

        static::assertEquals($labels, $api->set($this->fakeParentId, $labels));
    }

    /**
     * @test
     */
    public function shouldRemoveALabel(): void
    {
        $response = ['response'];

        $label = 'green';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->getPath().'/'.$label)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeParentId, $label));
    }

    protected function getApiClass()
    {
        return CardLabelsApi::class;
    }
}
