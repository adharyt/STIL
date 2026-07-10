<?php


class Process{
  private $pid;
  private $command;

  public function __construct($cl=false){
    if ($cl != false){
      $this->command = $cl;
      $this->runCom();
    }
  }
  private function runCom(){
    $command = $this->command . '& echo $!';
    exec($command ,$op);
    $this->pid = (int)$op[0];
  }

  public function setPid($pid){
    $this->pid = $pid;
  }

  public function getPid(){
    return $this->pid;
  }

  public function status(){
    $command = 'ps -p '.$this->pid;
    exec($command,$op);
    if (!isset($op[1]))return false;
    else return true;
  }

  public function start(){
    if ($this->command != '')$this->runCom();
    else return true;
  }

  public function stop(){
    $command = 'kill '.$this->pid;
    exec($command);
    if ($this->status() == false)return true;
    else return false;
  }
}

use SocketIO\Emitter;
use SocketIO\Binary;

class EmitterTest extends CI_Controller {
  public function testEmitCreatesARedisPublish() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->emit('so', 'yo');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    //$this->assertTrue(stripos($contents, 'publish') !== FALSE);
  }

  public function testDefaultsToLocalHostAndDefaultPort() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter();
    $emitter->emit('so', 'yo');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(stripos($contents, 'publish') !== FALSE);
  }


  public function testCanProvideRedisInstance() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $redis = new \TinyRedisClient('127.0.0.1:6379');
    $emitter = new Emitter($redis);
    $emitter->emit('so', 'yo');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(stripos($contents, 'publish') !== FALSE);
  }

  public function testPublishContainsExpectedAttributes() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->emit('so', 'yo');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, 'so') !== FALSE);
    $this->assertTrue(strpos($contents, 'yo') !== FALSE);
    $this->assertTrue(strpos($contents, 'rooms') !== FALSE);
    $this->assertTrue(strpos($contents, 'flags') !== FALSE);
    // Should not broadcast by default
    $this->assertFalse(strpos($contents, 'broadcast') !== FALSE);
    // Should have the default namespace
    $this->assertTrue(strpos($contents, '/') !== FALSE);
  }

  public function testPublishContainsBroadcastWhenBroadcasting() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->broadcast->emit('so', 'yo');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, 'so') !== FALSE);
    $this->assertTrue(strpos($contents, 'yo') !== FALSE);
    $this->assertTrue(strpos($contents, 'rooms') !== FALSE);
    $this->assertTrue(strpos($contents, 'flags') !== FALSE);
    $this->assertTrue(strpos($contents, 'broadcast') !== FALSE);
  }

  public function testPublishContainsExpectedDataWhenEmittingBinary() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->binary;
    $binarydata = pack('CCCCC', 0, 1, 2, 3, 4);
    $emitter->emit('binary event', $binarydata);

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, '\x00\x01\x02\x03\x04') !== FALSE);
  }

  public function testPublishContainsExpectedDataWhenEmittingBinaryWithWrapper() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $binarydata = pack('CCCCC', 0, 1, 2, 3, 4);
    $emitter->emit('binary event', new Binary($binarydata));

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, '\x00\x01\x02\x03\x04') !== FALSE);
  }

  public function testPublishContainsNamespaceWhenEmittingWithNamespaceSet() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->of('/nsp')->emit('yolo', 'data');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, '/nsp') !== FALSE);
  }

  public function testPublishKeyNameWithNamespaceSet() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->of('/nsp')->emit('yolo', 'data');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, 'socket.io#/nsp#') !== FALSE);
  }

  public function testPublishKeyNameWithRoomSet() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->to('rm')->emit('yolo', 'data');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, 'socket.io#/#rm#') !== FALSE);
  }

  public function testPublishKeyNameWithNamespaceAndRoomSet() {
    $p = new Process('redis-cli monitor > redis.log');

    sleep(1);
    // Running this should produce something that's visible in `redis-cli monitor`
    $emitter = new Emitter(NULL, array('host' => '127.0.0.1', 'port' => '6379'));
    $emitter->of('/nsp')->to('rm')->emit('yolo', 'data');

    $p->stop();
    $contents= file_get_contents('redis.log');
    unlink('redis.log');

    $this->assertTrue(strpos($contents, 'socket.io#/nsp#rm#') !== FALSE);
  }
}
?>
