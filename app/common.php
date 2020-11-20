<?php
// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function emailto($to,$title,$content)
{
    try {
        $email = new PHPMailer();
        //使用SMTP发送邮件
        $email->isSMTP();
        //调试模式
        $email->SMTPDebug = 0;
        $email->CharSet ='utf-8';
        //SMTP主机
        $email->Host = 'smtp.163.com';
        //SMTP用户名
        $email->Username = '18697703903@163.com';
        //SMTP密码
        $email->Password = 'yyou1995.';
        //设置邮件的发件人电子邮件地址
        $email->From = $to;
        //设置消息的主题。
        $email->Subject = $title;
        //本消息正文
        $email->Body = $content;
        //smtp需要鉴权 这个必须是true
        $email->SMTPAuth = true;
        //在SMTP连接上使用哪种加密
        $email->SMTPSecure = 'ssl';
        //SMTP服务器端口
        $email->Port = 465;
        //设置发送人
        $email->setFrom('18697703903@163.com','战士');
        //添加收件人地址
        $email->addAddress($to);
        //创建并发送消息
        return $email->send();
    }catch (Exception $e){
        exception($email->ErrorInfo);
    }

}
