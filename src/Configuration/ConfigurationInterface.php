<?php

declare(strict_types=1);

namespace Semaio\TrelloApi\Configuration;

interface ConfigurationInterface
{
    public const SUPPORTED_API_VERSIONS = [1];

    /**
     * Constant for authentication method. Indicates the default, but deprecated
     * login with username and token in URL.
     */
    public const AUTH_URL_TOKEN = 'url_token';

    /**
     * Constant for authentication method. Not indicates the new login, but allows
     * usage of unauthenticated rate limited requests for given client_id + client_secret.
     */
    public const AUTH_URL_CLIENT_ID = 'url_client_id';

    /**
     * Constant for authentication method. Indicates the new favored login method
     * with username and password via HTTP Authentication.
     */
    public const AUTH_HTTP_PASSWORD = 'http_password';

    /**
     * Constant for authentication method. Indicates the new login method with
     * with username and token via HTTP Authentication.
     */
    public const AUTH_HTTP_TOKEN = 'http_token';
}
