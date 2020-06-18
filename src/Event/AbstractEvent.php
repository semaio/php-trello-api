<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Event;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractEvent extends GenericEvent
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $requestData;

    /**
     * @var array
     */
    protected $memberCreator;

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequestData(): array
    {
        return $this->requestData;
    }

    public function setRequestData(array $requestData): void
    {
        $this->requestData = $requestData;
    }

    public function getMemberCreator(): array
    {
        return $this->memberCreator;
    }

    public function setMemberCreator(array $memberCreator): void
    {
        $this->memberCreator = $memberCreator;
    }
}
