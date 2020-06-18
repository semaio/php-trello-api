<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Tests\Api;

use Semaio\TrelloApi\Api\WebhookApi;
use Semaio\TrelloApi\Exception\MissingArgumentException;

/**
 * @group unit
 */
class WebhookApiTest extends ApiTestCase
{
    protected $fakeId = '5461efc60872da1eca5bf45c';

    protected $apiPath = 'webhooks';

    /**
     * @test
     */
    public function shouldShowWebhook(): void
    {
        $response = ['id' => $this->fakeId];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('get')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->show($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldRemoveToken(): void
    {
        $response = ['response'];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('delete')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->remove($this->fakeId));
    }

    /**
     * @test
     */
    public function shouldSetDescription(): void
    {
        $response = ['response'];

        $description = 'Test Webhook Description';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/description')
            ->willReturn($response);

        static::assertEquals($response, $api->setDescription($this->fakeId, $description));
    }

    /**
     * @test
     */
    public function shouldSetCallbackUrl(): void
    {
        $response = ['response'];

        $description = 'Test Webhook CallbackUrl';

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/callbackUrl')
            ->willReturn($response);

        static::assertEquals($response, $api->setCallbackUrl($this->fakeId, $description));
    }

    /**
     * @test
     */
    public function shouldSetModel(): void
    {
        $response = ['response'];

        $modelId = $this->fakeId('webhook');

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/idModel')
            ->willReturn($response);

        static::assertEquals($response, $api->setModel($this->fakeId, $modelId));
    }

    /**
     * @test
     */
    public function shouldSetActive(): void
    {
        $response = ['response'];

        $status = true;

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId.'/active')
            ->willReturn($response);

        static::assertEquals($response, $api->setActive($this->fakeId, $status));
    }

    /**
     * @test
     */
    public function shouldCreateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('post')
            ->with($this->apiPath)
            ->willReturn($response);

        static::assertEquals($response, $api->create($response));
    }

    /**
     * @test
     */
    public function shouldNotCreateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = ['idModel' => $this->fakeId('board')];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldNotCreateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = ['callbackUrl' => 'http://www.callback.com/'];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->create($data);
    }

    /**
     * @test
     */
    public function shouldUpdateWebhook(): void
    {
        $response = [
            'callbackURL' => 'http://www.callback.com/',
            'idModel' => $this->fakeId('board'),
        ];

        $api = $this->getApiMock();
        $api->expects(static::once())
            ->method('put')
            ->with($this->apiPath.'/'.$this->fakeId)
            ->willReturn($response);

        static::assertEquals($response, $api->update($this->fakeId, $response));
    }

    /**
     * @test
     */
    public function shouldNotUpdateWebhookWithoutCallbackUrl(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = ['idModel' => $this->fakeId('board')];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->update($this->fakeId, $data);
    }

    /**
     * @test
     */
    public function shouldNotUpdateWebhookWithoutModelId(): void
    {
        $this->expectException(MissingArgumentException::class);

        $data = ['callbackUrl' => 'http://www.callback.com/'];

        $api = $this->getApiMock();
        $api->expects(static::never())->method('post');

        $api->update($this->fakeId, $data);
    }

    protected function getApiClass()
    {
        return WebhookApi::class;
    }
}
