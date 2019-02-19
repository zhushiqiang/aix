<?php

namespace Xinchan\Aix;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Xinchan\Aix\Exceptions\HttpException;
use Xinchan\Aix\Exceptions\InvalidArgumentException;

class AccessToken
{
    protected $client_id;
    protected $client_secret;
    protected $grant_type;
    protected $guzzleOptions = [];

    public function __construct(int $client_id, string $client_secret, $grant_type = 'client_credentials')
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->grant_type = $grant_type;
    }
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }
    public function getAccessToken($format = 'json')
    {
        $url = env('AIX-URL') . '/api/oauth/token';

        if (!\in_array(\strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        $query = json_encode([
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'grant_type' => $this->grant_type,
        ], JSON_UNESCAPED_UNICODE);
        try {
            $response = $this->getHttpClient()->post($url, [
                'body' => $query,
                //content-type为application/json
                'headers' => ['content-type' => 'application/json']
            ])->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }

        return 'json' === $format ? \json_decode($response, true) : $response;
    }
    public function getToken()
    {
        $access_token = Cache::get("ai_access_token");
        if ($access_token) {
            return $access_token;
        }
        $result = $this->getAccessToken();

        Cache::put("ai_access_token", $result['access_token'], ($result['expires_in']/60)-1);

        return $result['access_token'];
    }
}