<?php

namespace app\controllers;


use app\models\Donation;
use app\models\Project;
use app\models\Team;
use app\models\User;
use yii\db\Exception;
use yii\web\Controller;
use yii\db\Connection;

class IndexController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
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
            Team::add($u)


        }catch (Exception $e){

        }



    }
}
