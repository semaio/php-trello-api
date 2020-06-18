<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

interface WebhookModelInterface extends ModelInterface
{
    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get modelId.
     *
     * @return string
     */
    public function getModelId();

    /**
     * Get callbackURL.
     *
     * @return string
     */
    public function getCallbackURL();

    /**
     * Is active?
     *
     * @return bool
     */
    public function isActive();
}
