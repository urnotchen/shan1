<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;

class User extends ActiveRecord
{



    /**
     * This is the model class for table "user".
     *
     * @property int $id
     * @property string $access_token
     * @property string $open_id
     * @property string $union_id
     * @property string $expires_in
     * @property string $donation_money
     * @property string $nickname
     * @property int $sex
     * @property string $province
     * @property string $city
     * @property string $country
     * @property string $img_url
     * @property int $created_at
     * @property int $updated_at
     */
    public static $users = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    public function behaviors()
    {/*{{{*/
        return [
            'timestamp' => \yii\behaviors\TimestampBehavior::classname(),
        ];
    }/*}}}*/
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'access_token', 'open_id',], 'required'],
            [['id', 'expires_in', 'sex', 'created_at', 'updated_at'], 'integer'],
            [['donation_money'], 'number'],
            [['access_token', 'refresh_token','open_id', 'union_id', 'nickname', 'province', 'city', 'country', 'img_url'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_token' => 'Access Token',
            'open_id' => 'Open ID',
            'union_id' => 'Union ID',
            'expires_in' => 'Expires In',
            'donation_money' => 'Donation Money',
            'nickname' => 'Nickname',
            'sex' => 'Sex',
            'province' => 'Province',
            'city' => 'City',
            'country' => 'Country',
            'img_url' => 'Img Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['access_token'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByOpenId($token)
    {/*{{{*/

        $res =  self::find()->where(['open_id' => $token])->one();
        if(!$res)
            return false;
        return $res;
    }/*}}}*/
    public static function findById($id)
    {/*{{{*/

        $res =  self::findOne($id);
        if(!$res)
            return false;
        return $res;
    }/*}}}*/



    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);

//        return $this->password === $password;
    }

    public static function addMoney($user_id,$money){
        $user = self::findById($user_id);
        $user->donation_money += $money;
        if(!$user->save()){
            throw  new Exception('add user money failed');
        }

    }
    public static function updateUser($open_id,$access_token, $expires_in, $refresh_token,$userinfo = null){
        $model = self::findOne(['open_id' => $open_id]);
        if(!$model){
            $model = new self();
        }
        $model->open_id = $open_id;
        $model->access_token = $access_token;
        $model->expires_in = $expires_in = time();
        $model->refresh_token = $refresh_token;
        $model->open_id = $open_id;
        if($userinfo){
            $model->setAttributes([
                'nickname' => $userinfo['nickname'],
                'img_url' => $userinfo['headimgurl'],
                'sex' => $userinfo['sex'],
                'city' => $userinfo['city'],
                'province' => $userinfo['province'],
                'country' => $userinfo['country'],
            ]);
        }
        if(!$model->save()){
            throw new Exception(500,'数据库错误');
        }
        return $model;
    }
    /*
     * 更新用户token
     * */

}
