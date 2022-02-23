<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use Semaio\TrelloApi\Exception\InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-group-labels
 *
 * Fully implemented.
 */
class LabelApi extends AbstractApi
{
    /**
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-group-labels
     */
    public static $fields = [
        'idBoard',
        'name',
        'color',
    ];

    protected $path = 'labels';

    /**
     * Find a label by id.
     *
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-labels-id-get
     */
    public function show(string $id, array $params = []): array
    {
        return $this->get($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Create a label.
     *
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-labels-post
     *
     * @throws \Semaio\TrelloApi\Exception\MissingArgumentException
     */
    public function create(array $params = []): array
    {
        $this->validateRequiredParameters(['idBoard', 'name'], $params);

        $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];

        if (array_key_exists('color', $params)) {
            $color = $params['color'];
            if (!in_array($color, $colors, true)) {
                throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
            }
        } else {
            $params['color'] = null;
        }

        return $this->post($this->getPath(), $params);
    }

    /**
     * Update a label.
     *
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-labels-id-put
     */
    public function update(string $id, array $params = []): array
    {
        $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];

        if (array_key_exists('color', $params)) {
            $color = $params['color'];
            if (!in_array($color, $colors, true)) {
                throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
            }
        }

        return $this->put($this->getPath().'/'.rawurlencode($id), $params);
    }

    /**
     * Set a given field to the label.
     *
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-labels-id-field-put
     */
    public function set(string $id, string $field, string $value): array
    {
        if (!in_array($field, ['name', 'color'], true)) {
            throw new InvalidArgumentException(sprintf('The "field" parameter must be one of "%s".', implode(', ', ['name', 'color'])));
        }

        if ('color' === $field) {
            $colors = ['black', 'blue', 'green', 'lime', 'orange', 'pink', 'purple', 'red', 'sky', 'yellow'];
            if (!in_array($value, $colors, true)) {
                throw new InvalidArgumentException(sprintf('The "color" parameter must be one of "%s".', implode(', ', $colors)));
            }
        }

        return $this->put($this->getPath().'/'.rawurlencode($id).'/'.$field, [
            'value' => $value,
        ]);
    }

    /**
     * Remove a label.
     *
     * @see https://developer.atlassian.com/cloud/trello/rest/api-group-labels/#api-labels-id-delete
     */
    public function remove(string $id): array
    {
        return $this->delete($this->getPath().'/'.rawurlencode($id));
    }
}
