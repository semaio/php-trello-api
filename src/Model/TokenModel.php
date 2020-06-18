<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

/**
 * @codeCoverageIgnore
 */
class TokenModel extends AbstractModel implements TokenModelInterface
{
    protected $apiName = 'token';

    protected $loadParams = [
        'fields' => 'all',
        'webhooks' => true,
    ];

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->data['identifier'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMemberId()
    {
        return $this->data['idMember'];
    }

    /**
     * {@inheritdoc}
     */
    public function getMember()
    {
        return new MemberModel($this->client, $this->client->getMemberApi(), $this->data['idMember']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfCreation()
    {
        return new \DateTime($this->data['dateCreated']);
    }

    /**
     * {@inheritdoc}
     */
    public function getDateOfExpiry()
    {
        return new \DateTime($this->data['dateExpires']);
    }

    /**
     * {@inheritdoc}
     */
    public function getPermissions()
    {
        return $this->data['permissions'];
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhooks()
    {
        $webhooks = [];

        foreach ($this->data['webhooks'] as $webhook) {
            $webhooks[] = new WebhookModel($this->client, $this->client->getWebhookApi(), $webhook['id']);
        }

        return $webhooks;
    }
}
