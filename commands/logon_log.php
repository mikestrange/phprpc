<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 17/10/15
 * Time: 18:45
 */

//插入登陆日志
function action($data){
    if(isset($data["uid"])){
        $user_id = $data["uid"];
        //$app_id = $data["appid"];
        //$app_type = $data["apptype"];
        //$desc_id = $data["desc"];
        //$app_ip = $data["ip"];
        //$app_mac = $data["mac"];
        $sql = "INSERT INTO pocket_log.logon_log (uid,ip,mac,app_id,app_type,desc_t)VALUES ('$user_id','127.0.0.1','123',101,2,'123')";
        if(DBConnect::getInstance()->query($sql)){
            ECHO_PUSH(array("flag"=>1, "msg"=>"insert logon succeed"));
        }else{
            ECHO_PUSH(array("flag"=>2, "msg"=>"insert logon error"));
        }
    }
}