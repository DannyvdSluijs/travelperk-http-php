<?php

declare(strict_types=1);

namespace Namelivia\TravelPerk\Client;

use GuzzleHttp\Client as GuzzleClient;
use Namelivia\TravelPerk\Exceptions\NotImplementedException;

class Client extends GuzzleClient
{
    private $apiKey;

    public function __construct(
        string $apiKey
    ) {
        return parent::__construct([
            'headers' => [
                'Api-Version'   => '1',
                'Authorization' => 'ApiKey '.$apiKey,
            ],
        ]);
    }

    public function setAuthorizationCode(string $authorizationCode): string
    {
        throw new NotImplementedException('No authorization code needed for simple api key authentication');
    }

    public function getAuthUri(string $targetLinkUri): string
    {
        throw new NotImplementedException('No authorization URI for simple api key authentication');
    }
}
