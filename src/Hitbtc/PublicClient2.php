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

    public function getSymbols()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/symbol')->getBody(), true);
    }

    public function getSymbol($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/symbol/'.$symbol)->getBody(), true);
    }

    public function getCurrencies()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/currency')->getBody(), true);
    }

    public function getCurrency($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/currency'.$symbol)->getBody(), true);
    }

    public function getTickers()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker')->getBody(), true);
    }

    public function getTicker($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker/'.$symbol)->getBody(), true);
    }

    public function getTrades($symbol, $sort=NULL, $by=NULL, $from=NULL, $till=NULL, $limit=NULL, $offset=NULL)
    {
        $options = [];
        if ($sort   !== NULL) $options['query']['sort']   = $sort;
        if ($by     !== NULL) $options['query']['by']     = $by;
        if ($from   !== NULL) $options['query']['from']   = $from;
        if ($till   !== NULL) $options['query']['till']   = $till;
        if ($limit  !== NULL) $options['query']['limit']  = $limit;
        if ($offset !== NULL) $options['query']['offset'] = $offset;
        return json_decode($this->getHttpClient()->get('/api/2/public/trades/'.$symbol, $options)->getBody(), true);
    }

    public function getOrderBook($symbol, $limit=NULL)
    {
        $options = [];
        if ($limit !== NULL) $options['query']['limit'] = $limit;
        return json_decode($this->getHttpClient()->get('/api/2/public/orderbook/'.$symbol, $options)->getBody(), true);
    }

    public function getCandles($symbol, $limit=NULL, $period=NULL)
    {
        $options = [];
        if ($limit  !== NULL) $options['query']['limit'] = $limit;
        if ($period  !== NULL) $options['query']['period'] = $period;
        return json_decode($this->getHttpClient()->get('/api/2/public/candles/'.$symbol, $options)->getBody(), true);
    }
}
