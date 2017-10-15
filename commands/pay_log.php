<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 17/10/15
 * Time: 19:49
 */

//插入充值日志
function action($data){
    if(isset($data["uid"])){
        $user_id = $data["uid"];
        //$app_id = $data["appid"];
        //$app_type = $data["apptype"];
        //$desc_id = $data["desc"];
        //$app_ip = $data["ip"];
        //$app_mac = $data["mac"];
        $sql = "INSERT INTO pocket_log.pay_log (user_id, app_id, app_type, sub_money, pay_num, ip, desc_t)".
            "VALUES ('$user_id','101','2','999999','6','127.0.0.1','test')";
        if(DBConnect::getInstance()->query($sql)){
            ECHO_PUSH(array("flag"=>1, "msg"=>"insert pay succeed"));
        }else{
            ECHO_PUSH(array("flag"=>2, "msg"=>"insert pay error"));
        }
    }
}