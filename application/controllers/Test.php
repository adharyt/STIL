<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//KITA AKAN COBA SIMULASIKAN KIRIM NOTIFIKASI VIA CONTROLLER TEST INI

class Test extends CI_Controller {
    public function testNotif(){
      $data['id_user']='4';
      $channel='notification_user';
      $this->redisModel->publishSocketIO($channel,$data);
    }

    public function emit(){

      $redis = new \Redis(); // Using the Redis extension provided client
      $redis->connect('127.0.0.1', '6379');
      $emitter = new SocketIO\Emitter($redis);
      $payload=json_encode(array(
                    'message' => 'Saya echo dari Code igniter',
                    'date' => date('m-d-Y'),
                    'msgcount' => '??',
                    'success' => true
                    ));


      //$emitter->emit('new_message', $payload);
      $redis->publish('new_notification',$payload);

      //echo str_replace(pack('c', 0xda), pack('c', 0xd8), $payload);

      }

      public function redis(){
        $redis = new \Redis(); // Using the Redis extension provided client

        if($redis->connect('127.0.0.1', '6379')){
          echo "a";
        }else{
          echo "b";
        }


      }
}
