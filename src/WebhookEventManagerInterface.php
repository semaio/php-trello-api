<?php

declare(strict_types=1);

namespace Semaio\TrelloApi;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

interface WebhookEventManagerInterface
{
    /**
     * Checks whether a given request is a Trello webhook and raises appropriate events @see WebhookEvents.
     */
    public function execute(?Request $request = null): void;

    /**
     * Add a new EventSubscriberInterface to the request.
     */
    public function addEventSubscriber(EventSubscriberInterface $subscriber): void;

    /**
     * Add a custom callable function to the request.
     */
    public function addListener(string $eventName, callable $listener, int $priority = 0): void;
}
