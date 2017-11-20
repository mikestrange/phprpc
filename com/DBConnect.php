<?php

/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/2
 * Time: 22:53
 */
class DBConnect
{
    const host = '120.77.149.74';
    const user = 'root';
    const password = '';

    private $mysql_con;

    static $_instance = null;

    public static function getInstance()
    {
        if (!DBConnect::$_instance)
        {
            DBConnect::$_instance = new DBConnect();
        }
        return DBConnect::$_instance;
    }

    public function DBConnect()
    {
        $this->content();
    }

    public function content()
    {
        $this->close();
        $this->mysql_con = mysqli_connect(DBConnect::host, DBConnect::user, DBConnect::password);
        if (!$this->mysql_con)
        {
            die('Could not connect: ' . mysqli_error());
            //echo "mysql is close";
        }else{
            mysqli_set_charset($this->mysql_con,"utf-8");
            $this->query("set names utf8");
            //echo "mysql content"."<br>";
        }
    }

    public function close()
    {
        if($this->mysql_con)
        {
            mysqli_close($this->mysql_con);
            $this->mysql_con = null;
            //echo "mysql close"."<br>";
        }
    }

    public function find($sql)
    {
        if(!$this->mysql_con) return null;
        //get data base
        $result = mysqli_query($this->mysql_con, $sql);
        if ($result && mysqli_num_rows($result) > 0 )
        {
//            $list = array();
//            while($row = mysqli_fetch_array($result))
//            {
//                $list[] = $row;
//            }
            //mysqli_fetch_all这个函数和环境有关系
            $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            //var_dump($list);
            return $list;
        }
        return null;
    }

    public function query($sql)
    {
        if($this->mysql_con){
            return mysqli_query($this->mysql_con, $sql);
        }
        return false;
    }
}