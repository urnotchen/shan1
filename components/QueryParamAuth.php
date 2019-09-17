<?php

namespace app\components;

class QueryParamAuth extends \yii\filters\auth\QueryParamAuth
{

    public $tokenParam = 'token';

}
