<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

/**
 * @see https://trello.com/docs/api/webhook
 *
 * Not implemented:
 * - https://trello.com/docs/api/webhook/#put-1-webhooks (what is the use of this? compared to #post-1-webhooks)
 */
class WebhookApi extends AbstractApi
{
    /**
     * @see https://trello.com/docs/api/webhook/#get-1-webhooks-idwebhook-field
     */
    public static array $fields = [
        'description',
        'idModel',
        'callbackURL',
        'active',
    ];

    protected string $path = 'webhooks';

    /**
     * Find a webhook by id.
     *
     * @see https://trello.com/docs/api/webhook/#get-1-webhooks-idwebhook
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a webhook.
     *
     * @see https://trello.com/docs/api/webhook/#post-1-webhooks
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['callbackURL', 'idModel'], $params);

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a webhook.
     *
     * @see https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function update(string $id, array $params = []): array
    {
        $this->validateRequiredParameters(['callbackURL', 'idModel'], $params);

        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Remove a webhook.
     *
     * @see https://trello.com/docs/api/webhook/#delete-1-webhooks-idwebhook
     */
    public function remove(string $id): array
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }

    /**
     * Set a given webhook's callback url.
     *
     * @see https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-callbackurl
     */
    public function setCallbackUrl(string $id, string $url): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/callbackUrl', [
            'value' => $url,
        ]);
    }

    /**
     * Set a given webhook's description.
     *
     * @see https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-description
     */
    public function setDescription(string $id, string $description): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/description', [
            'value' => $description,
        ]);
    }

    /**
     * Set a given webhook's board.
     *
     * @see https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-idmodel
     */
    public function setModel(string $id, string $modelId): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/idModel', [
            'value' => $modelId,
        ]);
    }

    /**
     * Set a given webhook's active state.
     *
     * @see https://trello.com/docs/api/webhook/#put-1-webhooks-idwebhook-active
     */
    public function setActive(string $id, bool $status): array
    {
        return $this->put($this->getPath().'/'.rawurlencode($id).'/active', [
            'value' => $status,
        ]);
    }
}
