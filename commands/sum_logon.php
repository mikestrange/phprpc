<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 17/11/18
 * Time: 13:43
 */


//查看登陆记录
function action($data){
    if(!isset($data["begin"]) || !isset($data["end"])){
        return;
    }
    $begin = $data['begin'];//"2017-11-18";
    $end = $data['end'];//"2017-11-19";
    $sql = "SELECT uid FROM pocket_log.logon_log WHERE time BETWEEN '$begin' AND '$end'";
    $ret = DBConnect::getInstance()->find($sql);
    if($ret) {
        $num = count($ret);
        //
        $user_list = array();   //登陆玩家
        $user_map = array();  //登陆次数
        for ($i = 0; $i < $num; ++$i) {
            $result = $ret[$i];
            $uid = $result['uid'];
            if(!isset($user_map[$uid])){
                $user_map[$uid] = 1;
                array_push($user_list, $uid);
            }else{
                $user_map[$uid]++;
            }
        }
        //每个玩家的记录
        $user_count = count($user_list);
        echo $begin."到".$end."<br />登陆玩家总数:".$user_count."<br />";
        for ($k = 0; $k < $user_count; ++$k) {
            $uid = $user_list[$k];
            echo "UID=".$uid."登陆次数=",$user_map[$uid]."<br />";
        }
    }
}