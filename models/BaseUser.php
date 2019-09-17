<?php

namespace app\models;
use Yii;

class BaseUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    use \app\traits\KVTrait,
        \app\traits\LoginUserTrait;

    public function behaviors()
    {/*{{{*/
        return [
            # only active on creating
            'authKey' => [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key',
                ],
                'value' => function ($event) {
                    return \Yii::$app->getSecurity()->generateRandomString();
                }
            ],
        ];
    }/*}}}*/

    public function rules()
    {/*{{{*/
        return [

            [['username', 'email', 'avatar'], 'required', 'on' => 'default'],
            [['username', 'email', 'avatar', 'password'], 'required', 'on' => 'create'],
            [['password'], 'required', 'on' => 'resetPassword'],
            [['email'], 'required', 'on' => 'requestResetPassword'],

            [['role_id', 'status'], 'integer'],
            [['username', 'email', 'avatar', 'real_name', 'qq', 'alipay', 'mark', 'password', 'authKey', 'password_reset_token'], 'string', 'max' => 255],

            ['email', 'email'],
            ['avatar', 'url'],
            [['username', 'email'], 'unique'],
            ['status', 'default', 'value' => 0],
            ['password', 'hashPassword'],

        ];
    }/*}}}*/

//    public static function getDb()
//    {
//        return \Yii::$app->dbUser;
//    }

    public static function tableName()
    {
        return 'user_backend';
    }
    public static function findIdentity($id)
    {/*{{{*/
        return static::findOne($id);
    }/*}}}*/

    public static function findIdentityByAccessToken($token, $type = null)
    {/*{{{*/
        return static::fineOne(['access_token' => $token]);
    }/*}}}*/

    public static function findByUsername($username)
    {/*{{{*/

        $res =  self::findOne(['username' => $username]);
        if(!$res)
            return false;
//        if($res->status == User::STATUS_OFF)
//            if($res->token == $token && $res->created_at < time() - $res->token_exptime) {
//                return $res;
//            }
//            else
//                return false;
        return $res;
    }/*}}}*/

//    public static function findByPasswordResetToken($token)
//    {/*{{{*/
//        if (!static::isPasswordResetTokenValid($token)) {
//            return null;
//        }
//
//        return static::findOne([
//            'password_reset_token' => $token,
//            'status' => self::STATUS_ACTIVE,
//        ]);
//    }/*}}}*/
//    public static function isPasswordResetTokenValid($token)
//    {/*{{{*/
//        if (empty($token)) {
//            return false;
//        }
//        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
//        $parts = explode('_', $token);
//        $timestamp = (int) end($parts);
//        return $timestamp + $expire >= time();
//    }/*}}}*/

    public function validateAuthKey($authKey)
    {/*{{{*/
        return $this->getAuthKey() === $authKey;
    }/*}}}*/

    public function validatePassword($rawPassword)
    {/*{{{*/
        return Yii::$app->getSecurity()->validatePassword($rawPassword, $this->password);
//        return $this->password == $rawPassword;
    }/*}}}*/

    public function getId()
    {/*{{{*/
        return $this->id;
    }/*}}}*/

//    public function getAuthKey()
//    {/*{{{*/
//        return $this->authKey;
//    }/*}}}*/

    public function generatePasswordResetToken()
    {/*{{{*/
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }/*}}}*/

    public function removePasswordResetToken()
    {/*{{{*/
        $this->password_reset_token = null;
    }/*}}}*/
    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }
}
