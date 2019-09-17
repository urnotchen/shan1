<?php

namespace app\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string $leader_id
 * @property int $rank
 * @property string $donation_id
 * @property string $money
 * @property string $created_at
 * @property string $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'leader_id', 'donation_id', 'money'], 'required'],
            [['id', 'leader_id', 'rank', 'donation_id','product_id', 'created_at', 'updated_at'], 'integer'],
            [['money'], 'number'],
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
            'leader_id' => 'Leader ID',
            'rank' => 'Rank',
            'donation_id' => 'Donation ID',
            'money' => 'Money',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'product_id' => 'product_id',
        ];
    }

    public static function addDonation($user_id,$money,$donation_id,$product_id){

        $team = new self();
        $team->leader_id = $user_id;
        $team->product_id = $product_id;
        $team->donation_id = $donation_id;
        $team->money += $money;
        self::updateRank($product_id);
        //更新团队排名
    }

    public static function updateRank($product_id){

        $teams = self::find()->where(['product_id' => $product_id])->orderBy(['money' => 'desc'])->all();

        $i = 1;
        foreach ($teams as $team){
            $team->rank = $i;
            if(!$team->save()){
                throw new Exception('rank update failed');
            }
            $i++;
        }
    }
}
