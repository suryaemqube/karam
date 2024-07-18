<?php

namespace Postpay;

use Exception;
use InvalidArgumentException;
use Postpay\Exceptions\PostpayException;
use Postpay\Http\Request;
use Postpay\HttpClients\Client;
use Postpay\HttpClients\ClientInterface;
use Postpay\HttpClients\CurlClient;
use Postpay\HttpClients\GuzzleClient;

class Postpay
{
    /**
     * @const string Version number of the Postpay SDK.
     */
    const VERSION = '0.0.4';

    /**
     * @const string Default API version for requests.
     */
    const DEFAULT_API_VERSION = 'v1';

    /**
     * @const string GraphQL path.
     */
    const GRAPHQL_PATH = '/graphql';

    /**
     * @const string GraphQL version for requests.
     */
    const GRAPHQL_VERSION = 'graphql';

    /**
     * @const string The name of the environment variable that contains the merchant ID.
     */
    const MERCHANT_ID_ENV_NAME = 'POSTPAY_MERCHANT_ID';

    /**
     * @const string The name of the environment variable that contains the secret key.
     */
    const SECRET_KEY_ENV_NAME = 'POSTPAY_SECRET_KEY';

    /**
     * @var Client The Postpay client service.
     */
    protected $client;

    /**
     * @var array The basic auth credentials.
     */
    protected $auth;

    /**
     * @var string|null The default API version.
     */
    protected $apiVersion;

    /**
     * @var bool Set to true for sandbox requests.
     */
    protected $sandbox;

    /**
     * @var \Postpay\Http\Response|null Stores the last request.
     */
    protected $lastResponse;

    /**
     * Instantiates a new Postpay super-class object.
     *
     * @param array $config
     *
     * @throws PostpayException
     */
    public function __construct(array $config = [])
    {
        $config = array_merge([
            'client_handler' => null,
            'merchant_id' => getenv(static::MERCHANT_ID_ENV_NAME),
            'secret_key' => getenv(static::SECRET_KEY_ENV_NAME),
            'api_version' => static::DEFAULT_API_VERSION,
            'sandbox' => false,
        ], $config);

        if ((!$config['merchant_id']) or (!$config['secret_key'])) {
            throw new PostpayException('Basic credentials required.');
        }
        $this->client = new Client(
            self::createClientHandler($config['client_handler'])
        );
        $this->auth = [$config['merchant_id'], $config['secret_key']];
        $this->apiVersion = $config['api_version'];
        $this->sandbox = $config['sandbox'];
    }

    /**
     * Returns the client service.
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Creates a client handler.
     *
     * @param ClientInterface|string|null $handler
     *
     * @throws \Exception               If extensions aren't available.
     * @throws InvalidArgumentException If client handler is invalid.
     *
     * @return ClientInterface
     */
    public static function createClientHandler($handler = null)
    {
        if ($handler instanceof ClientInterface) {
            return $handler;
        }
        $handler = $handler ?: 'curl';

        if ('curl' === $handler) {
            if (!extension_loaded('curl')) {
                throw new Exception('cURL extension must be loaded.');
            }
            return new CurlClient();
        }
        if ('guzzle' === $handler) {
            if (!class_exists('GuzzleHttp\Client')) {
                throw new Exception('GuzzleHttp\Client must be included.');
            }
            return new GuzzleClient();
        }
        throw new InvalidArgumentException('Invalid client handler.');
    }

    /**
     * Sets the HTTP client handler.
     *
     * @param ClientInterface $clientHandler
     */
    public function setClientHandler($clientHandler)
    {
        $this->client->setClientHandler(
            self::createClientHandler($clientHandler)
        );
    }

    /**
     * Returns the last response returned from API.
     *
     * @return \Postpay\Http\Response|null
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Sends a GET request to API and returns the response.
     *
     * @param string $path
     * @param array  $params
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function get($path, array $params = [])
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Sends a POST request to API and returns the response.
     *
     * @param string $path
     * @param array  $params
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function post($path, array $params = [])
    {
        return $this->request('POST', $path, $params);
    }

    /**
     * Sends a PUT request to API and returns the response.
     *
     * @param string $path
     * @param array  $params
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function put($path, array $params = [])
    {
        return $this->request('PUT', $path, $params);
    }

    /**
     * Sends a PATCH request to API and returns the response.
     *
     * @param string $path
     * @param array  $params
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function patch($path, array $params = [])
    {
        return $this->request('PATCH', $path, $params);
    }

    /**
     * Sends a DELETE request to API and returns the response.
     *
     * @param string $path
     * @param array  $params
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function delete($path, array $params = [])
    {
        return $this->request('DELETE', $path, $params);
    }

    /**
     * Sends a query to GraphQL API and returns the response.
     *
     * @param string $query
     * @param array  $variables
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function query($query, array $variables = [])
    {
        $params = [
            'query' => $query,
            'variables' => $variables,
        ];
        return $this->request(
            'POST',
            self::GRAPHQL_PATH,
            $params,
            self::GRAPHQL_VERSION
        );
    }

    /**
     * Sends a request to API and returns the response.
     *
     * @param string      $method
     * @param string      $path
     * @param array       $params
     * @param string|null $apiVersion
     *
     * @return \Postpay\Http\Response
     *
     * @throws PostpayException
     */
    public function request(
        $method,
        $path,
        array $params = [],
        $apiVersion = null
    ) {
        $request = new Request(
            $method,
            $path,
            $params,
            $this->auth,
            $apiVersion ?: $this->apiVersion,
            $this->sandbox
        );
        return $this->lastResponse = $this->client->request($request);
    }
}
