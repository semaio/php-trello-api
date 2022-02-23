<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Model;

use Semaio\TrelloApi\Exception\BadMethodCallException;
use Semaio\TrelloApi\Exception\PermissionDeniedException;

interface ModelInterface
{
    /**
     * Get identifier.
     *
     * @return string
     */
    public function getId();

    /**
     * Save the object through API.
     *
     * @throws BadMethodCallException    If this method is not allowed by the API on the child object
     * @throws PermissionDeniedException If the client does not have sufficient privileges
     *
     * @return AbstractModel
     */
    public function save();

    /**
     * Remove the object through API.
     *
     * @throws BadMethodCallException    If this method is not allowed by the API on the child object
     * @throws PermissionDeniedException If the client does not have sufficient privileges
     *
     * @return AbstractModel
     */
    public function remove();

    /**
     * Refresh the object through API.
     *
     * @return AbstractModel
     */
    public function refresh();

    /**
     * Get data.
     *
     * @return array
     */
    public function getData();

    /**
     * Set data.
     *
     * @return AbstractModel
     */
    public function setData(array $data);
}
