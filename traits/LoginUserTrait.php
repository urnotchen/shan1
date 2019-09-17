<?php

namespace app\traits;

/**
 * LoginUserTrait class file.
 * @Author haoliang
 * @Date 18.09.2015 15:21
 */
trait LoginUserTrait
{

//    public static function getDb()
//    {
//        return \Yii::$app->dbUser;
//    }

    public static function tableName()
    {
        return '{{user}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::fineOne(['access_token' => $token]);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

}
