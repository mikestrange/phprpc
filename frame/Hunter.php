<?php

/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/2
 * Time: 23:46
 */
require("Command.php");
require("Message.php");

class Hunter
{
    static $_instance = null;

    public static function getInstance()
    {
        if (!Hunter::$_instance)
        {
            Hunter::$_instance = new Hunter();
        }
        return Hunter::$_instance;
    }

    public function SendMessage($key, $data)
    {
        $file = "commands/".$key.'.php';
        if (file_exists($file))
        {
            require($file);
            //执行动作
            action($data);
        } else {
            ECHO_PUSH(array("flag"=>404,"desc"=>"无效接口 ".$key));
        }
    }

    public function SendCommand($command, $data)
    {
        $target = new $command();
        //handler command
        $target->action($data);
    }

    public function Invoker($data)
    {
        //任务 回执添加到 ECHO_PUSH中
        ECHO_BEGIN();
        $begin = microtime(true);
        if ($this->auth_check()){
            $this->SendMessage(GET_VALUE($data, "handle"), $data);
        }else{
            ECHO_PUSH(array("flag"=>405));
            ECHO_PUSH(array("msg"=>"授权不通过"));
        }
        $end = microtime(true);
        ECHO_PUSH(array("runtime"=>round($end - $begin, 3)));
        ECHO_END();
    }

    //这里做用户校正
    private function auth_check()
    {
        //$data = PHP_GET("auth");
        return true;
    }
    //end
}


