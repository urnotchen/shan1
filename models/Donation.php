<?php

namespace app\models;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'user_id', 'product_id'], 'required'],
            [['id', 'user_id', 'product_id', 'team_id', 'created_at', 'updated_at'], 'integer'],
            [['money'], 'number'],
            [['comment'], 'string', 'max' => 255],
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
}
