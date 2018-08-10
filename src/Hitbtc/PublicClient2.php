<?php

namespace Hitbtc;

use GuzzleHttp\Client as HttpClient;

class PublicClient2
{
    protected $host;
    protected $httpClient;

    public function __construct()
    {
        $this->host = 'https://api.hitbtc.com';
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (!$this->httpClient) {
            $this->httpClient = new HttpClient([
                'base_uri' => $this->host,
            ]);
        }

        return $this->httpClient;
    }

    public function getTicker($ticker)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker/'.$ticker)->getBody(), true);
    }

    public function getTickers()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker')->getBody(), true);
    }

    public function getOrderBook($ticker)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/orderbook/'.$ticker)->getBody(), true);
    }

    public function getCandles($ticker, $limit=null, $period=null)
    {
        $params = [];
        if ($limit) $params[] = "limit={$limit}";
        if ($period) $params[] = "period={$period}";
        $params = implode('&', $params);
        if ($params) $params = "?{$params}";
        
        return json_decode($this->getHttpClient()->get('/api/2/public/candles/'.$ticker.$params)->getBody(), true);
    }
}
