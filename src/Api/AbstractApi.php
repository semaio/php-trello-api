<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Api;

use DateTime;
use Semaio\TrelloApi\Client\TrelloClientInterface;
use Semaio\TrelloApi\Exception\BadMethodCallException;
use Semaio\TrelloApi\Exception\InvalidArgumentException;
use Semaio\TrelloApi\Exception\MissingArgumentException;

abstract class AbstractApi implements ApiInterface
{
    /**
     * @var array
     */
    public static $fields;

    /**
     * The client.
     *
     * @var TrelloClientInterface
     */
    protected $client;

    /**
     * API sub namespace.
     *
     * @var string
     */
    protected $path;

    public function __construct(TrelloClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Catches any undefined "get{$field}" calls, and passes them
     * to the getField() if the $field is in the $this->fields property.
     *
     * @param string $method    called method
     * @param array  $arguments array of arguments passed to called method
     *
     *@throws BadMethodCallException If the method does not start with "get"
     *                                or the field is not included in the $fields property
     *
     * @return array
     */
    public function __call(string $method, array $arguments)
    {
        if (isset($this->fields) && strpos($method, 'get') === 0) {
            $property = lcfirst(substr($method, 3));
            if (in_array($property, $this->fields, true) && count($arguments) === 2) {
                return $this->getField($arguments[0], $arguments[1]);
            }
        }

        throw new BadMethodCallException(sprintf('There is no method named "%s" in class "%s".', $method, static::class));
    }

    public function getFields(): array
    {
        return static::$fields;
    }

    /**
     * Get a field value by field name.
     *
     * @param string $id    the board's id
     * @param string $field the field
     *
     * @throws InvalidArgumentException If the field does not exist
     *
     * @return mixed field value
     */
    public function getField(string $id, string $field)
    {
        if (!in_array($field, static::$fields, true)) {
            throw new InvalidArgumentException(sprintf('There is no field named %s.', $field));
        }

        $response = $this->get($this->path.'/'.rawurlencode($id).'/'.rawurlencode($field));

        // TODO: Validate

        return $response['_value'] ?? $response;
    }

    public function get(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->client->get($uri, $parameters, $headers);
    }

    public function head(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->client->head($uri, [
            'query' => $parameters,
        ], $headers);
    }

    public function post(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->postRaw($uri, $this->transformParameters($parameters), $headers);
    }

    public function patch(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->client->patch($uri, $this->transformParameters($parameters), $headers);
    }

    public function put(string $uri, array $parameters = [], array $headers = []): array
    {
        foreach ($parameters as $name => $parameter) {
            if (is_bool($parameter)) {
                $parameters[$name] = $parameter ? 'true' : 'false';
            }
        }

        return $this->client->put($uri, $this->transformParameters($parameters), $headers);
    }

    public function delete(string $uri, array $parameters = [], array $headers = []): array
    {
        return $this->client->delete($uri, $this->transformParameters($parameters), $headers);
    }

    /**
     * @param null $body
     */
    protected function postRaw(string $uri, $body = null, array $headers = []): array
    {
        return $this->client->post($uri, $body, $headers);
    }

    /**
     * Transform request parameters in Trello compatible form.
     *
     * @param array $parameters Request parameters
     */
    protected function transformParameters(array $parameters): array
    {
        foreach ($parameters as $name => $parameter) {
            if (is_bool($parameter)) {
                $parameters[$name] = $parameter ? 'true' : 'false';
            } elseif (is_array($parameter)) {
                foreach ($parameter as $subName => $subParameter) {
                    if (is_bool($subParameter)) {
                        $subParameter = $subParameter ? 'true' : 'false';
                    }
                    $parameters[$name.'/'.$subName] = $subParameter;
                }
                unset($parameters[$name]);
            } elseif ($parameter instanceof DateTime) {
                $parameters[$name] = $parameter->format($parameter::ATOM);
            }
        }

        return $parameters;
    }

    protected function getPath(?string $id = null): string
    {
        if ($id !== null) {
            return preg_replace('/\#id\#/', $id, $this->path);
        }

        return $this->path;
    }

    /**
     * Validate parameters array.
     *
     * @param string[] $required   required properties (array keys)
     * @param array    $parameters array to check for existence of the required keys
     *
     * @throws MissingArgumentException if a required parameter is missing
     */
    protected function validateRequiredParameters(array $required, array $parameters): void
    {
        foreach ($required as $parameter) {
            if (!isset($parameters[$parameter])) {
                throw new MissingArgumentException(sprintf('The "%s" parameter is required.', $parameter));
            }
        }
    }

    protected function validateAllowedParameter(array $allowed, string $parameter, string $parameterName): array
    {
        return $this->validateAllowedParameters($allowed, [$parameter], $parameterName);
    }

    /**
     * Validate allowed parameters array. Checks whether the passed parameters are allowed.
     */
    protected function validateAllowedParameters(array $allowed, array $parameters, string $parameterName): array
    {
        foreach ($parameters as $parameter) {
            if (!in_array($parameter, $allowed, true)) {
                throw new InvalidArgumentException(sprintf('The "%s" parameter may contain only values within "%s". "%s" given.', $parameterName, implode(', ', $allowed), $parameter));
            }
        }

        return $parameters;
    }

    /**
     * Validate that the params array includes at least one of
     * the keys in a given array.
     *
     * @param string[] $atLeastOneOf allowed properties
     * @param array    $parameters   array to check
     *
     * @throws MissingArgumentException
     */
    protected function validateAtLeastOneOf(array $atLeastOneOf, array $parameters): bool
    {
        foreach ($atLeastOneOf as $parameter) {
            if (isset($parameters[$parameter])) {
                return true;
            }
        }

        throw new MissingArgumentException(sprintf('You need to provide at least one of the following parameters "%s".', implode('", "', $atLeastOneOf)));
    }
}
