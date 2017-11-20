<?php

/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/6
 * Time: 16:47
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'class.phpmailer.php';

class MailProxy
{
    private $mail;

    //发件人名称
    public function MailProxy($name = '')
    {
        $this->mail = new PHPMailer();
        //$this->SMTPDebug = 1;
        $this->mail->IsSMTP();
        //设置邮件的字符编码，这很重要，不然中文乱码
        $this->mail->CharSet = 'UTF-8';
        //开启认证
        $this->mail->SMTPAuth   = true;
        //方式
        $this->mail->SMTPSecure = 'ssl';
        //QQ邮箱端口
        $this->mail->Port       = 465;
        //QQ邮箱host
        $this->mail->Host       = "smtp.qq.com";
        //本人账号
        $this->mail->Username   = "542540443@qq.com";
        //需要生成smtp密码
        $this->mail->Password   = "riddpfqeplpybehj";
        //发件人
        $this->mail->From       = "542540443@qq.com";
        $this->mail->FromName   = $name;
        //回复地址
        $this->mail->AddReplyTo("542540443@qq.com", $name);
        //是否
        $this->mail->IsHTML(true);
    }

    //标题
    public function SetHeader($title)
    {
        $this->mail->Subject  = $title;
    }

    //文本内容
    public function SetBody($data)
    {
        if(gettype($data) == "array"){
            $this->mail->Body = "";
            foreach ($data as $key => $value)
            {
                $this->mail->Body .= "<h1>$key</h1>$value";
            }
        }else{
            $this->mail->Body = $data;
        }
    }

    //添加附件
    public function AddAttachment($path)
    {
        $this->mail->AddAttachment($path);
    }

    /*
     * 收件人邮件地址 收件人名称
     * "lwzlove1314@163.com","lwzlove1314"
    */
    public function SendEmail($to, $name = '')
    {
        $this->mail->AddAddress($to, $name);
        if($this->mail->Send())
        {
            echo "<br>".'发送邮件成功:'.$to;
        }else {
            echo "<br>".'发送邮件失败: ' . $this->ErrorInfo;
        }
    }
}

//测试
function test()
{
    $m = new MailProxy("天使");
    $m->SetHeader("这是个测试");
    $m->SetBody("Test Body");
    $m->SendEmail("1252158702@qq.com","1252158702");
}


function action(){
    $mail = new PHPMailer();
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';                       //设置邮件的字符编码，这很重要，不然中文乱码
    $mail->SMTPAuth   = true;                       //开启认证
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->Host       = "smtp.qq.com";
    $mail->Username   = "542540443@qq.com";
    $mail->Password   = "riddpfqeplpybehj";//"pemszmgkrqqqdfge";//

//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
//发送者
    $mail->From       = "542540443@qq.com";
    $mail->FromName   = "发送者";
//回复地址
    $mail->AddReplyTo("542540443@qq.com","542540443");

//接收地址
    $mail->AddAddress("1252158702@qq.com","YOU");
    $mail->IsHTML(true);
    $mail->Subject  = "Test2";
    $mail->Body = "<h1>Test</h1>";
//当邮件不支持html时备用显示，可以省略
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
//$mail->WordWrap   = 80; // 设置每行字符串的长度
//$mail->AddAttachment("f:/test.png");  //可以添加附件
    if(!$mail->Send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else {
        echo 'success:'."<br>";
    }
}