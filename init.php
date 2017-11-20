<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/3
 * Time: 00:45
 */

header("Content-type: text/html; charset=utf-8");

require("com/DBConnect.php");
require("com/TcpSocket.php");
require("frame/Hunter.php");

//全局参数
class OVERALL
{
    public static $YES = 1;
    public static $NO = -1;
}

//global
function PHP_GET($key)
{
    return isset($_GET[$key])?$_GET[$key]:null;
}

function PHP_POST($key)
{
    return isset($_POST[$key])?$_POST[$key]:null;
}

function GET_VALUE($data, $key, $def)
{
    return isset($data[$key])?$data[$key]:$def;
}

function PHP_DUMP($data)
{
    var_dump($data);
}

//输出
function ECHO_BEGIN()
{
    $GLOBALS['global_out'] = array();
}

function ECHO_PUSH($data)
{
    while(list($key,$val)= each($data))
    {
        $GLOBALS['global_out'][$key] = $val;
    }
}

function ECHO_END()
{
    echo json_encode($GLOBALS['global_out']);
}

//是否特殊字符（防止sql注入）
function sql_match($str)
{
    return preg_match("/[\'.,:;*?~`!@#$%^&+=)(< >{}]|\]|\[|\/|\\\|\"|\|/",$str) == 1;
}

//return string
//json_encode($arr);

//return data
//json_decode($str)