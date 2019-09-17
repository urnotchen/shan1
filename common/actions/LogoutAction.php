<?php

namespace app\common\actions;

use Yii;
use yii\base\Action;

class LogoutAction extends Action
{

    public function run()
    {/*{{{*/
        Yii::$app->user->logout();
        return $this->controller->redirect(Yii::$app->getRequest()->referrer);
    }/*}}}*/

}
