<?php
 
 require_once __DIR__.'/../vendor/autoload.php';
 require 'RemoteConnect.php';

 use PHPUnit\Framework\TestCase;
 
class RemoteConnectTest extends TestCase
{
  public function setUp(){ }
  public function tearDown(){ }
 
  public function testConnectionIsValid()
  {
    // проверка валидности соединения с сервером
    $connObj = new RemoteConnect();
    $serverName = 'tvr.zzz.com.ua';
    $this->assertTrue($connObj->connectToServer($serverName) !== false);
  }
}
?>