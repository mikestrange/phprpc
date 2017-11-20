<?php

/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/30
 * Time: 09:38
 */

class TcpSocket
{
    private $socket;

    public function connect($ip,$port)
    {
        $this->close();
        error_reporting(E_ALL);
        set_time_limit(0);
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($sock < 0) {
            echo "socket_create() failed: reason: " . socket_strerror($sock) . "<br>";
            return;
        }
        $result = socket_connect($sock, $ip, $port);
        if ($result < 0) {
            echo "socket_connect() failed: ($result) " . socket_strerror($result) . "<br>";
        }else {
            $this->socket = $sock;
            echo "socket succeed". "<br>";
        }
        return $this->connected();
    }

    public function connected()
    {
        return $this->socket != null;
    }

    public function send($data)
    {
        //$in = "Ho\r\n"."first blood\r\n";
        if(!$this->connected()){
            echo "this socket is closed";
            return;
        }
        if(!socket_write($this->socket, $data, strlen($data))) {
            echo "socket_write() failed: reason: " . socket_strerror($this->socket) . "<br>";
        }else {
            echo "socket write succeed"."<br>";
        }
    }

    public function read()
    {
        while($out = socket_read($this->socket, 8192)) {
            echo "接收服务器回传信息成功"."<br>";
            echo "接受的内容为:".$out;
        }
    }

    public function close()
    {
        if($this->socket){
            socket_close($this->socket);
            $this->socket = null;
            echo "close socket "."<br>";
        }
    }
}