<?php

namespace app\models;

use Faker\Provider\Uuid;
use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "donation".
 *
 * @property int $id
 * @property string $user_id
 * @property string $product_id
 * @property string $team_id
 * @property string $comment
 * @property string $money
 * @property string $created_at
 * @property string $updated_at
 */
class Donation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'donation';
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
            [['user_id', 'product_id'], 'required'],
            [['id', 'user_id', 'product_id', 'team_id', 'created_at', 'updated_at'], 'integer'],
            [['money'], 'number'],
            [['comment','tradeno'], 'string', 'max' => 255],
            [['tradeno'],'generateTradeno' ,'skipOnEmpty' => false],
            [['id'], 'unique'],
        ];
    }

    public function generateTradeno(){

        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $max = strlen($strPol)-1;

        for($i=0;$i<8;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }


        $this->tradeno = $str;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'team_id' => 'Team ID',
            'comment' => 'Comment',
            'money' => 'Money',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function add($user_id,$product_id,$team_id,$comment,$money){

        $donation = new self();
        $donation->user_id    = $user_id;
        $donation->product_id = $product_id;
        $donation->team_id    = $team_id;
        $donation->comment    = $comment;
        $donation->money      = $money;
        if(!$donation->save()){
            throw new Exception('save failed');
        }
    }

    public static function getDonationsById($project_id,$begin = 0,$limit = 5){


        if($begin > 0) {
           return self::find()->where(['product_id' => $project_id])->andWhere(['<', 'id', $begin])->orderBy('id desc')->limit($limit)->all();
        }
        else
            return self::find()->where(['product_id' => $project_id])->orderBy('id desc')->limit($limit)->all();

    }

    public static function findByDonationId($id){

        return self::findOne($id);
    }

    public static function findByTradeno($tradeno){

        return self::findOne(['tradeno' => $tradeno]);
    }

    public static function getDonationsByProject($project_id){

        return  self::find()->where(['product_id' => $project_id])->all();
    }

    public function getUser(){

        return $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
