<?php

namespace app\common\helpers;

use yii\base\Object;
use yii\helpers\Html;

class EmailHelper extends Object
{
    public static function sendEmailCurl($titles,$content,$emails)
    {
        $dataString = '{
                        "subject": "'.$titles.'",
                        "content": "'.$content.'",
                        "send_to": "['.$emails.']",
                        "created_by": "chenxi"
                        }';
        $postAddress = 'http://notification.bluelive.me/api/compose';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postAddress);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($dataString)
            )
        );
        $output = curl_exec($ch);
    }
    public static function sendEmail($titles,$content,$emails)
    {
        $mail= \Yii::$app->mailer->compose();
        $mail->setTo($emails);
        $mail->setSubject($titles);
        $mail->setHtmlBody($content);    //发布可以带html标签的文本
        if($mail->send())
            return  1;
        else
            return  0;
    }
}
