<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 17/11/18
 * Time: 11:24
 */


//开始日期 2017-11-17

//查看充值记录
function action($data){
    //$uid = 28796205;
    //$sql = "SELECT user_id,sub_money FROM pocket_log.pay_log WHERE user_id='$uid'";
    if(!isset($data["begin"]) || !isset($data["end"])){
        return;
    }
    $begin = $data['begin'];//"2017-11-18";
    $end = $data['end'];//"2017-11-19";
    $sql = "SELECT user_id,sub_money FROM pocket_log.pay_log WHERE time BETWEEN '$begin' AND '$end'";
    $ret = DBConnect::getInstance()->find($sql);
    if($ret) {
        $num = count($ret);
        $totals = 0;
        $user_list = array();   //充值人数
        $user_map = array();    //对应金额
        for ($i = 0; $i < $num; ++$i) {
            $result = $ret[$i];
            $rmb = get_rmb($result['sub_money']);
            $uid = $result['user_id'];
            $totals += $rmb;
            if(!isset($user_map[$uid])){
                $user_map[$uid] = array('rmb'=>$rmb,'count'=>1);
                array_push($user_list, $uid);
            }else{
                $user_map[$uid]['rmb'] += $rmb;
                $user_map[$uid]['count'] ++;
            }
        }
        echo $begin."到".$end."<br /> 充值总额:".$totals." 充值人数:".count($user_list).'<br />';
        //每个玩家的记录
        $user_count = count($user_list);
        for ($k = 0; $k < $user_count; ++$k) {
            $uid = $user_list[$k];
            echo "UID=".$uid." 充值总额=",$user_map[$uid]['rmb']." 充值次数=".$user_map[$uid]['count']."<br />";
        }
    }else{
        echo "查询错误，或者查询数据";
    }
}

function get_rmb($val){
    if($val <= 20000){
        return 2;
    }else if($val <= 110000){
        return 10;
    }else if($val <= 350000){
        return 35;
    }else if($val <= 1400000){
        return 100;
    }else if($val <= 8000000){
        return 500;
    }else if($val == 19000000){
        return 1000;
    }
    //echo "充值记录有问题";
    return -1;
}