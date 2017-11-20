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
        $app_id = GET_VALUE($data, "appid", 100);
        $app_type = GET_VALUE($data, "apptype", 1);
        $desc_t =  GET_VALUE($data, "desc", "");
        $app_ip = GET_VALUE($data, "ip", "localhost");
        $app_mac = GET_VALUE($data, "mac", "");
        $version = GET_VALUE($data, "ver", "0.0.0");
        //var_dump($data);
        $sql = "INSERT INTO pocket_log.logon_log (uid,ip,mac,app_id,app_type,desc_t,version)".
            "VALUES ('$user_id','$app_ip','$app_mac',$app_id,$app_type,'$desc_t','$version')";
        if(DBConnect::getInstance()->query($sql)){
            ECHO_PUSH(array("flag"=>1, "msg"=>"insert logon succeed"));
        }else{
            ECHO_PUSH(array("flag"=>2, "msg"=>"insert logon error"));
        }
    }
}