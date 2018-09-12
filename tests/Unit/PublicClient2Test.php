<?php
/**
 * Created by PhpStorm.
 * User: paulg
 * Date: 9/12/2018
 * Time: 10:12 AM
 */

use PHPUnit\Framework\TestCase;
use Hitbtc\PublicClient2;

class PublicClient2Test extends TestCase
{

    public function testGetSymbols()
    {
        $client = new PublicClient2();
        $this->assertInstanceOf(PublicClient2::class, $client);
        $symbols = $client->getSymbols();
        $this->assertTrue(is_array($symbols));
        $this->assertTrue(count($symbols) > 900);
    }

    public function testGetSymbol()
    {
        $client = new PublicClient2();
        $symbol = $client->getSymbol('ETHBTC');
        $this->assertTrue(is_array($symbol));
        $this->assertTrue(count($symbol) == 8);
        $this->assertArrayHasKey('id', $symbol);
        $this->assertArrayHasKey('baseCurrency', $symbol);
        $this->assertArrayHasKey('quoteCurrency', $symbol);
        $this->assertArrayHasKey('quantityIncrement', $symbol);
        $this->assertArrayHasKey('tickSize', $symbol);
        $this->assertArrayHasKey('takeLiquidityRate', $symbol);
        $this->assertArrayHasKey('provideLiquidityRate', $symbol);
        $this->assertArrayHasKey('feeCurrency', $symbol);
        $this->assertTrue($symbol['id'] == 'ETHBTC');
        $this->assertTrue($symbol['baseCurrency'] == 'ETH');
        $this->assertTrue($symbol['quoteCurrency'] == 'BTC');
        $this->assertTrue($symbol['quantityIncrement'] == 0.001);
        $this->assertTrue($symbol['tickSize'] == 0.000001);
        $this->assertTrue($symbol['takeLiquidityRate'] == 0.001);
        $this->assertTrue($symbol['provideLiquidityRate'] == -0.0001);
        $this->assertTrue($symbol['feeCurrency'] == 'BTC');
    }

    public function testGetCurrencies()
    {
        $client = new PublicClient2();
        $currencies = $client->getCurrencies();
        $this->assertTrue(is_array($currencies));
        $this->assertTrue(count($currencies) > 400);
    }

    public function testGetCurrency()
    {
        $client = new PublicClient2();
        $currency = $client->getCurrency('BTC');
        $this->assertTrue(is_array($currency));
        $this->assertTrue(count($currency) ==11);
        $this->assertArrayHasKey('id', $currency);
        $this->assertArrayHasKey('fullName', $currency);
        $this->assertArrayHasKey('crypto', $currency);
        $this->assertArrayHasKey('payinEnabled', $currency);
        $this->assertArrayHasKey('payinPaymentId', $currency);
        $this->assertArrayHasKey('payinConfirmations', $currency);
        $this->assertArrayHasKey('payoutEnabled', $currency);
        $this->assertArrayHasKey('payoutIsPaymentId', $currency);
        $this->assertArrayHasKey('transferEnabled', $currency);
        $this->assertArrayHasKey('delisted', $currency);
        $this->assertArrayHasKey('payoutFee', $currency);
        $this->assertTrue($currency['id'] == 'BTC');
        $this->assertTrue($currency['fullName'] == 'Bitcoin');
        $this->assertTrue($currency['crypto'] == 1);
        $this->assertTrue($currency['payinEnabled'] == 1);
        $this->assertTrue($currency['payinPaymentId'] == NULL);
        $this->assertTrue($currency['payinConfirmations'] == 2);
        $this->assertTrue($currency['payoutEnabled'] == 1);
        $this->assertTrue($currency['payoutIsPaymentId'] == NULL);
        $this->assertTrue($currency['transferEnabled'] == 1);
        $this->assertTrue($currency['delisted'] == NULL);
        $this->assertTrue($currency['payoutFee'] == 0.001);
    }

    public function testGetTickers()
    {
        $client = new PublicClient2();
        $tickers = $client->getTickers();
        $this->assertTrue(is_array($tickers));
        $this->assertTrue(count($tickers) > 900);
    }

    public function testGetTicker()
    {
        $client = new PublicClient2();
        $ticker = $client->getTicker('ETHBTC');
        $this->assertTrue(is_array($ticker));
        $this->assertTrue(count($ticker) == 10);
        $this->assertArrayHasKey('ask', $ticker);
        $this->assertArrayHasKey('bid', $ticker);
        $this->assertArrayHasKey('last', $ticker);
        $this->assertArrayHasKey('open', $ticker);
        $this->assertArrayHasKey('low', $ticker);
        $this->assertArrayHasKey('high', $ticker);
        $this->assertArrayHasKey('volume', $ticker);
        $this->assertArrayHasKey('volumeQuote', $ticker);
        $this->assertArrayHasKey('timestamp', $ticker);
        $this->assertArrayHasKey('symbol', $ticker);
        $this->assertTrue($ticker['ask'] > 0);
        $this->assertTrue($ticker['bid'] > 0);
        $this->assertTrue($ticker['last'] > 0);
        $this->assertTrue($ticker['open'] > 0);
        $this->assertTrue($ticker['low'] > 0);
        $this->assertTrue($ticker['high'] > 0);
        $this->assertTrue($ticker['volume'] > 0);
        $this->assertTrue($ticker['volumeQuote'] > 0);
        $this->assertTrue($ticker['timestamp'] != '');
        $this->assertTrue($ticker['symbol'] == 'ETHBTC');
    }

    public function testGetTrades()
    {
        $client = new PublicClient2();
        $trades = $client->getTrades('ETHBTC',NULL,NULL,NULL,NULL,3);
        #print_r($trades);
        #die();
        $this->assertTrue(is_array($trades));
        $this->assertTrue(count($trades) == 3);
        $this->assertTrue(is_array($trades[0]));
        $this->assertTrue(count($trades[0]) == 5);
    }

    public function testGetOrderBook()
    {
        $client = new PublicClient2();
        $book = $client->getOrderBook('ETHBTC',3);
        #print_r($book);
        #die();
        $this->assertTrue(is_array($book));
        $this->assertTrue(count($book) == 2);
        $this->assertTrue(is_array($book['ask']));
        $this->assertTrue(is_array($book['bid']));
        $this->assertTrue(count($book['ask']) == 3);
        $this->assertTrue(count($book['bid']) == 3);
    }

    public function testGetCandles()
    {
        $client = new PublicClient2();
        $candles = $client->getCandles('ETHBTC', 3, 'M1');
        $this->assertTrue(is_array($candles));
        $this->assertTrue(count($candles) == 3);
        $this->assertTrue(is_array($candles[0]));
        $this->assertTrue(count($candles[0]) == 7);
    }
}
