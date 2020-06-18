<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

/**
 * @codeCoverageIgnore
 */
class WebhookModel extends AbstractModel implements WebhookModelInterface
{
    protected $apiName = 'webhook';

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->data['description'];
    }

    /**
     * {@inheritdoc}
     */
    public function getModelId()
    {
        return $this->data['idModel'];
    }

    /**
     * {@inheritdoc}
     */
    public function getCallbackURL()
    {
        return $this->data['callbackURL'];
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        return $this->data['active'];
    }
}
