<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/2
 * Time: 18:26
 */
//导入包
require "init.php";
//处理
try{
    if(sizeof($_POST) > 0){
        Hunter::getInstance()->Invoker($_POST);
    }else{
        Hunter::getInstance()->Invoker($_GET);
    }
}catch (Exception $e){
    echo $e->getMessage();
    exit();
}
