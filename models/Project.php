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
    /**
     * {@inheritdoc}
     */
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
            [['id', 'title'], 'required'],
            [['id', 'count', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['expect_money', 'now_money'], 'number'],
            [['title', 'sub_title', 'receiver'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'content' => 'Content',
            'receiver' => 'Receiver',
            'expect_money' => 'Expect Money',
            'now_money' => 'Now Money',
            'count' => 'Count',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
