<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Api;

use GuzzleHttp\Client;

class TravelPerk
{
    const BASE_URL = 'https://api.travelperk.com/';
    const SANDBOX_BASE_URL = 'https://sandbox.travelperk.com/';

    private $baseUrl;
    private $client;
    private $expenses;
    private $scim;
    private $webhooks;

    public function __construct(Client $client, bool $isSandbox)
    {
        $this->client = $client;
        $this->expenses = new Expenses($this);
        $this->scim = new SCIM($this);
        $this->webhooks = new WebhooksAPI($this);
        $this->baseUrl = $isSandbox ? TravelPerk::SANDBOX_BASE_URL : TravelPerk::BASE_URL;
    }

    public function getAuthUri(string $targetLinkUri): string
    {
        return $this->client->getAuthUri($targetLinkUri);
    }

    public function getJson($url): object
    {
        return json_decode(
            $this->client->get(
                $this->baseUrl.$url
            )->getBody()->getContents()
        );
    }

    public function get($url): string
    {
        return $this->client->get(
            $this->baseUrl.$url
        )->getBody()->getContents();
    }

    public function post($url, array $params): string
    {
        return $this->client->post(
            $this->baseUrl.$url,
            [\GuzzleHttp\RequestOptions::JSON => $params]
        )->getBody()->getContents();
    }

    public function postJson($url, array $params): object
    {
        return json_decode($this->client->post(
            $this->baseUrl.$url,
            [\GuzzleHttp\RequestOptions::JSON => $params]
        )->getBody()->getContents());
    }

    public function patch($url, array $params): string
    {
        return $this->client->patch(
            $this->baseUrl.$url,
            [\GuzzleHttp\RequestOptions::JSON => $params]
        )->getBody()->getContents();
    }

    public function patchJson($url, array $params): object
    {
        return json_decode($this->client->patch(
            $this->baseUrl.$url,
            [\GuzzleHttp\RequestOptions::JSON => $params]
        )->getBody()->getContents());
    }

    public function putJson($url, array $params): object
    {
        return json_decode($this->client->put(
            $this->baseUrl.$url,
            [\GuzzleHttp\RequestOptions::JSON => $params]
        )->getBody()->getContents());
    }

    public function delete($url): string
    {
        return $this->client->delete(
            $this->baseUrl.$url
        )->getBody()->getContents();
    }

    public function setAuthorizationCode(string $authorizationCode): TravelPerk
    {
        $this->client->setAuthorizationCode($authorizationCode);

        return $this;
    }

    public function expenses(): Expenses
    {
        return $this->expenses;
    }

    public function scim(): SCIM
    {
        return $this->scim;
    }

    public function webhooks(): WebhooksAPI
    {
        return $this->webhooks;
    }
}
