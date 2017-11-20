<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 17/11/19
 * Time: 20:33
 */


function action($data){
    $tcp = new TcpSocket();
    $tcp->connect("localhost",8081);
    $tcp->send("Ho\r\n"."first blood\r\n");
    //echo $data["name"];
//    $sql = "INSERT INTO pocket_log.test (uid, name) VALUES ('10086','$name')";
//    if(DBConnect::getInstance()->query($sql)){
//        ECHO_PUSH(array("flag"=>1, "msg"=>"insert test succeed"));
//    }else{
//        ECHO_PUSH(array("flag"=>2, "msg"=>"insert test error"));
//    }
}