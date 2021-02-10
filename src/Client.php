<?php

namespace AxlMedia\OddstakeSdk;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

abstract class Client
{
    /**
     * Debug mode.
     *
     * @var bool
     */
    protected $debug = false;

    /**
     * The handler used to mock Guzzle.
     *
     * @var mixed
     */
    protected $handler;

    /**
     * Access the key directly from the response,
     * instead of passing the whole response.
     *
     * @var string
     */
    protected $from;

    /**
     * The sport to retrieve the oods for.
     *
     * @var string
     */
    protected $sport;

    /**
     * List of wanted odds type.
     *
     * @var array
     */
    protected $types = [
        '1x2', 'Over/Under', 'Home/Away', 'Double Chance',
        'Both Teams To Score', 'Correct Score', 'Asian Handicap',
    ];

    /**
     * Enable debugging.
     *
     * @return $this
     */
    public function debug()
    {
        $this->debug = true;

        return $this;
    }

    /**
     * Set the handler for Guzzle.
     *
     * @param  mixed  $handler
     * @return $this
     */
    public function handler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Specify the key which should be retrieved
     * upon response.
     *
     * @param  string  $from
     * @return $this
     */
    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Specify the sport.
     *
     * @param  string  $sport
     * @return $this
     */
    public function sport(string $sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Set the only types to retrieve.
     *
     * @param  array  $types
     * @return $this
     */
    public function types(array $types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * Make an API call.
     *
     * @param  string  $method
     * @param  string  $endpoint
     * @return array|null
     */
    public function call(string $method, string $endpoint)
    {
        $callableUrl = $this->url($endpoint);

        if ($this->debug) {
            return $callableUrl;
        }

        $client = new \GuzzleHttp\Client([
            'handler' => $this->handler,
        ]);

        try {
            $response = $client->request($method, $callableUrl);

            $xml = simplexml_load_string($response->getBody()->__toString());
            $json = @json_decode(json_encode($xml), true);
        } catch (ClientException | Exception $e) {
            return [];
        }

        return $this->from
            ? Arr::get($json, $this->from)
            : $json;
    }

    /**
     * Get the URL on which the request will be made.
     *
     * @param  string  $endpoint
     * @return string
     */
    public function url(string $endpoint): string
    {
        $types = implode(',', $this->types);

        return "{$this->getApiBaseUrl()}{$endpoint}?only={$types}";
    }

    /**
     * Get the Base API URL.
     *
     * @return string
     */
    protected function getApiBaseUrl(): string
    {
        return "http://feeds.oddstake.com/get-feed/{$this->sport}/odds-extended";
    }
}
