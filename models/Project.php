<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property string $content
 * @property string $receiver
 * @property string $expect_money
 * @property string $now_money
 * @property string $count
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Project extends \yii\db\ActiveRecord
{

    const SEPARATOR = ' - ';


    public $time_range;
    public $created_at_range = [];
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {/*{{{*/
        return [
            'timestamp' => \yii\behaviors\TimestampBehavior::classname(),
            'blameable' => \yii\behaviors\BlameableBehavior::classname(),
        ];
    }/*}}}*/

    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['id', 'count','begin_at','end_at','begin_at','end_at', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['expect_money', 'now_money'], 'number'],
            [['title', 'sub_title', 'receiver','img_url'], 'string', 'max' => 255],
            [['time_range'],'validateRange'],

        ];
    }

    public function validateRange($attr, $params)
    {
        if ($this->hasErrors()) var_dump($this->hasErrors());

        $created_at = explode(self::SEPARATOR, $this->time_range);

        if (!is_array($created_at) || count($created_at) != 2) {
            $this->addError($attr, '时间格式错误.');
            return false;
        }
        foreach ($created_at as $v) {
            $time = strtotime($v);
            if ($time === false) {
                $this->addError($attr, '时间格式错误.');
                break;
            }
            $temp[] = $time;
        }
        $this->begin_at = $temp[0];
        $this->end_at = $temp[1];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'sub_title' => '小标题',
            'content' => '内容',
            'receiver' => '接受者',
            'expect_money' => '预期金额',
            'now_money' => '实时金额',
            'count' => '参与人数',
            'img_url' => '封面',
            'begin_at' => '开始时间',
            'end_at' => '结束时间',
            'created_at' => '创建时间',
            'created_by' => '创建者',
            'updated_at' => '更新时间',
            'updated_by' => '更新者',
        ];
    }
    //todo 403 not login
    public static function findById($id){

       return  Project::findOne($id);
    }

    public static function addMoney($project_id,$money){

        $project = self::findOne($project_id);
        $project->now_money += $money;
        $project->save();
    }
}
