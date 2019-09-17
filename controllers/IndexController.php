<?php

namespace app\controllers;


use app\models\Donation;
use app\models\Project;
use app\models\Team;
use app\models\User;
use app\common\helpers\Curl;
use yii\db\Exception;
use yii\web\Controller;
use yii\db\Connection;

class IndexController extends Controller
{
    const SCOPE = 'snsapi_userinfo';
    const REDIRECT_URI = 'http://47.99.46.80/index.php';
    const APP_ID = 'wx8d771bff3c8c1eaf';
    const APP_SECRET = '0336ad17025337ad17193f079d6da8e8';

    public function actionIndex($token = null){

        //获取基本access_token签名
        $access_token = Curl::httpGet("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".self::APP_ID."&secret=".self::APP_SECRET,true);
        $access_token = json_decode($access_token,true);
        $res = Curl::httpGet("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token['access_token']}&type=jsapi",true);
        $ticket = json_decode($res,true);

        $noncestr = 'Wm3WZYTPz0wzccnW';
        $jsapi_ticket = $ticket['ticket'];
        $timestamp = time();
        $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];

        $str = "jsapi_ticket={$jsapi_ticket}&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";
        $str_sha1 = sha1($str);
        return $this->render('index',[
            'app_id' => self::APP_ID,
            'timestamp' => $timestamp,
            'nonceStr' => $noncestr,
            'signature' => $str_sha1,
            'jsapi_ticket' => $jsapi_ticket,
//            'jsApiList' => json_encode(['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone']),
        ]);
    }


    /*
     * 捐款
     * */
    public function donate($access_token,$money,$product_id,$team = null,$comment = ''){


        try{

            //根据token获取用户
            $user = User::findIdentityByAccessToken($access_token);
            //已经确认过金额后,写入捐款表
            Donation::add($user->id,$product_id,$team,$comment,$money);
            //累加到个人表
            User::addMoney($user,$money);
            //写入团队表



        }catch (Exception $e){

        }



    }
}
