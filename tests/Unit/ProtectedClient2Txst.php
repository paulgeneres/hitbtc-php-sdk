<?php
/**
 * Created by PhpStorm.
 * User: paulg
 * Date: 9/12/2018
 * Time: 10:12 AM
 */

use PHPUnit\Framework\TestCase;
use Hitbtc\PublicClient2;

class ProtectedClient2Txst extends TestCase
{
    public function testGetBalanceTrading()
    {
        $client = new ProtectedClient2(PUBLIC_KEY, SECRET_KEY);
        $this->assertInstanceOf(ProtectedClient2::class, $client);
        $balances = $client->getBalanceTrading();
        print_r($balances);
        die();
    }
}
