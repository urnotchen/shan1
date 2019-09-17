<?php

namespace app\common\actions;

use Yii;
use yii\base\Action;

class LoginAction extends Action
{
    public function run()
    {
//        if ( ! Yii::$app->user->isGuest){
//            return $this->controller->goHome();
//        }
        # 设定登录后返回地址
        # 参考 \yii\web\User::returnUrlParam
        Yii::$app->getSession()->set( Yii::$app->getUser()->returnUrlParam, Yii::$app->getRequest()->hostInfo);
        return $this->controller->redirect( Yii::$app->user->loginUrl);
    }
}
