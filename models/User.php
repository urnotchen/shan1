<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Exception;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

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

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'access_token', 'open_id', 'union_id', 'expires_in', 'nickname'], 'required'],
            [['id', 'expires_in', 'sex', 'created_at', 'updated_at'], 'integer'],
            [['donation_money'], 'number'],
            [['access_token', 'open_id', 'union_id', 'nickname', 'province', 'city', 'country', 'img_url'], 'string', 'max' => 255],
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
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

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
        return $this->password === $password;
    }

    public static function addMoney($user,$money){
        $user->money += $money;
        if(!$user->save()){
            throw new Exception('add user money failed');
        }
    }

    pub
}
