<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use DateMalformedStringException;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Semaio\TrelloApi\Client\TrelloClientInterface;
use Semaio\TrelloApi\Tests\Fake\AbstractApiFake;

class AbstractApiTest extends TestCase
{
    #[Test]
    public function it_can_pass_get_request_to_client(): void
    {
        $response = ['value'];

        $httpClient = $this->getTrelloClientMock();
        $httpClient
            ->method('get')
            ->with('/path', [
                'param1' => 'param1value',
            ], [
                'header1' => 'header1value',
            ])
            ->willReturn($response);

        $api = new AbstractApiFake($httpClient);

        static::assertEquals($response, $api->get('/path', [
            'param1' => 'param1value',
        ], [
            'header1' => 'header1value',
        ]));
    }

    #[Test]
    public function it_can_pass_post_request_to_client(): void
    {
        $response = ['value'];

        $httpClient = $this->getTrelloClientMock();
        $httpClient->expects($this->once())
            ->method('post')
            ->with('/path', [
                'param1' => 'param1value',
            ], [
                'option1' => 'option1value',
            ])
            ->willReturn($response);

        $api = new AbstractApiFake($httpClient);

        static::assertEquals($response, $api->post('/path', [
            'param1' => 'param1value',
        ], [
            'option1' => 'option1value',
        ]));
    }

    #[Test]
    public function it_can_pass_patch_request_to_client(): void
    {
        $response = ['value'];

        $httpClient = $this->getTrelloClientMock();
        $httpClient->expects($this->once())
            ->method('patch')
            ->with('/path', [
                'param1' => 'param1value',
            ], [
                'option1' => 'option1value',
            ])
            ->willReturn($response);

        $api = new AbstractApiFake($httpClient);

        static::assertEquals($response, $api->patch('/path', [
            'param1' => 'param1value',
        ], [
            'option1' => 'option1value',
        ]));
    }

    #[Test]
    public function it_can_pass_put_request_to_client(): void
    {
        $response = ['value'];

        $httpClient = $this->getTrelloClientMock();
        $httpClient->expects($this->once())
            ->method('put')
            ->with('/path', [
                'param1' => 'param1value',
            ], [
                'option1' => 'option1value',
            ])
            ->willReturn($response);

        $api = new AbstractApiFake($httpClient);

        static::assertEquals($response, $api->put('/path', [
            'param1' => 'param1value',
        ], [
            'option1' => 'option1value',
        ]));
    }

    #[Test]
    public function it_can_pass_delete_request_to_client(): void
    {
        $response = ['value'];

        $httpClient = $this->getTrelloClientMock();
        $httpClient->expects($this->once())
            ->method('delete')
            ->with('/path', [
                'param1' => 'param1value',
            ], [
                'option1' => 'option1value',
            ])
            ->willReturn($response);

        $api = new AbstractApiFake($httpClient);

        static::assertEquals($response, $api->delete('/path', [
            'param1' => 'param1value',
        ], [
            'option1' => 'option1value',
        ]));
    }

    /**
     * @throws DateMalformedStringException
     */
    #[Test]
    public function it_can_transform_parameters(): void
    {
        $parameters = [
            'bool_true' => true,
            'bool_false' => false,
            'array' => [
                'bool_true' => true,
                'bool_false' => false,
            ],
            'date' => new DateTime('2020-01-01 10:00:00', new DateTimeZone('UTC')),
        ];

        $api = new AbstractApiFake($this->getTrelloClientMock());
        $api->testTransformParameters($parameters);

        static::assertEquals([
            'bool_true' => 'true',
            'bool_false' => 'false',
            'array/bool_true' => 'true',
            'array/bool_false' => 'false',
            'date' => '2020-01-01T10:00:00+00:00',
        ], $api->testTransformParameters($parameters));
    }

    /**
     * @return MockObject|TrelloClientInterface
     */
    protected function getTrelloClientMock(): TrelloClientInterface|MockObject
    {
        return $this->getMockBuilder(TrelloClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return GuzzleClient
     */
    protected function getHttpClientMock(): GuzzleClient
    {
        $mock = $this->getMockBuilder(GuzzleClient::class)
            ->onlyMethods(['send'])
            ->getMock();

        $mock->method('send');

        return $mock;
    }
}
