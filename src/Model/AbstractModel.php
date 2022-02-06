<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

use Semaio\TrelloApi\Api\ApiInterface;
use Semaio\TrelloApi\ClientInterface;
use Semaio\TrelloApi\Exception\BadMethodCallException;

/**
 * @codeCoverageIgnore
 */
abstract class AbstractModel
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiName;

    /**
     * @var ApiInterface
     */
    protected $api;

    /**
     * @var array
     */
    protected $fields;

    /**
     * Default load params, should be overwritten
     * in child classes.
     *
     * @var array
     */
    protected $loadParams = [
        'fields' => 'all',
    ];

    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $data;

    public function __construct(ClientInterface $client, ApiInterface $api, ?string $id = null)
    {
        $this->client = $client;
        $this->api = $api;
        $this->fields = $this->api->getFields();

        if ($id !== null) {
            $this->id = $id;
            $this->refresh();
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function refresh(): self
    {
        $this->preRefresh();
        $this->data = $this->api->show($this->id, $this->loadParams);
        $this->postRefresh();

        return $this;
    }

    public function save(): self
    {
        try {
            $this->preSave();
            $this->id ? $this->update() : $this->create();
            $this->postSave();
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException(sprintf("You can't %s %s objects.", $this->id ? 'update' : 'create', static::class));
        }

        return $this->refresh();
    }

    public function remove(): self
    {
        try {
            $this->preRemove();
            $this->api->remove($this->id);
            $this->postRemove();
        } catch (BadMethodCallException $e) {
            throw new BadMethodCallException(sprintf("You can't remove %s objects.", static::class));
        }

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Update the object through API.
     */
    protected function update(): self
    {
        $this->preUpdate();
        $this->data = $this->api->update($this->id, $this->data);
        $this->postUpdate();

        return $this;
    }

    /**
     * Create the object through API.
     */
    protected function create(): self
    {
        $this->preCreate();
        $this->data = $this->api->create($this->data);
        $this->id = $this->data['id'];
        $this->postCreate();

        return $this;
    }

    /**
     * Called before saving (creating or updating) an entity.
     */
    protected function preSave(): void
    {
    }

    /**
     * Called after saving (creating or updating) an entity.
     */
    protected function postSave(): void
    {
    }

    /**
     * Called before creating an entity.
     */
    protected function preCreate(): void
    {
    }

    /**
     * Called after creating an entity.
     */
    protected function postCreate(): void
    {
    }

    /**
     * Called before updating an entity.
     */
    protected function preUpdate(): void
    {
    }

    /**
     * Called after updating an entity.
     */
    protected function postUpdate(): void
    {
    }

    /**
     * Called before refreshing an entity.
     */
    protected function preRefresh(): void
    {
    }

    /**
     * Called after refreshing an entity.
     */
    protected function postRefresh(): void
    {
    }

    /**
     * Called before removing an entity.
     */
    protected function preRemove(): void
    {
    }

    /**
     * Called after removing an entity.
     */
    protected function postRemove(): void
    {
    }
}
