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

    /**
     * @return mixed
     */
    public function getCurrencies()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/currency')->getBody(), true);
    }

    /**
     * @param $symbol
     * @return mixed
     */
    public function getCurrency($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/currency/'.$symbol)->getBody(), true);
    }

    /**
     * @return mixed
     */
    public function getSymbols()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/symbol')->getBody(), true);
    }

    /**
     * @param $symbol
     * @return mixed
     */
    public function getSymbol($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/symbol/'.$symbol)->getBody(), true);
    }

    /**
     * @return mixed
     */
    public function getTickers()
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker')->getBody(), true);
    }

    /**
     * @param $symbol
     * @return mixed
     */
    public function getTicker($symbol)
    {
        return json_decode($this->getHttpClient()->get('/api/2/public/ticker/'.$symbol)->getBody(), true);
    }

    /**
     * @param $symbol
     * @param null $sort 'ASC' | 'DESC'
     * @param null $by 'id' | 'timestamp'
     * @param null $from
     * @param null $till
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
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

    /**
     * @param $symbol
     * @param null $limit
     * @return mixed
     */
    public function getOrderBook($symbol, $limit=NULL)
    {
        $options = [];
        if ($limit !== NULL) $options['query']['limit'] = $limit;
        return json_decode($this->getHttpClient()->get('/api/2/public/orderbook/'.$symbol, $options)->getBody(), true);
    }

    /**
     * @param $symbol
     * @param null $limit
     * @param null $period
     * @return mixed
     */
    public function getCandles($symbol, $limit=NULL, $period=NULL)
    {
        $options = [];
        if ($limit  !== NULL) $options['query']['limit'] = $limit;
        if ($period  !== NULL) $options['query']['period'] = $period;
		$options['query']['sort'] = 'DESC';
        return json_decode($this->getHttpClient()->get('/api/2/public/candles/'.$symbol, $options)->getBody(), true);
    }
}
