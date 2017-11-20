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
        $app_id = GET_VALUE($data, "appid", 100);
        $app_type = GET_VALUE($data, "apptype", 1);
        $desc_t = GET_VALUE($data, "desc", "");
        $addr_ip = GET_VALUE($data, "ip", "localhost");
        $sub_money = GET_VALUE($data, "money", 0);
        $pay_num = GET_VALUE($data, "num", 0);
        $version = GET_VALUE($data, "ver", "0.0.0");
        $sql = "INSERT INTO pocket_log.pay_log (user_id, app_id, app_type, sub_money, pay_num, ip, desc_t, version)".
            "VALUES ('$user_id','$app_id','$app_type','$sub_money','$pay_num','$addr_ip','$desc_t','$version')";
        if(DBConnect::getInstance()->query($sql)){
            ECHO_PUSH(array("flag"=>1, "msg"=>"insert pay succeed"));
        }else{
            ECHO_PUSH(array("flag"=>2, "msg"=>"insert pay error"));
        }
    }
}