<?php


use yii\db\Migration;

class m190911_100852_create_table_donation extends Migration
{
    public $tableDonation           = 'donation';
    public $tableUser           = 'user';
    public $tableProject           = 'project';
    public $tableTream           = 'team';


    public $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    
    public function safeUp()
    {
        //用户表
        $this->createTable($this->tableUser, [
            'id'            => $this->primaryKey(),
            'access_token'          => $this->string()->notNull(),
            'open_id'          => $this->string()->notNull(),
            'union_id'          => $this->string()->notNull(),
            'expires_in'  => $this->integer()->unsigned()->notNull(),
            'donation_money'  => $this->decimal(2),

            'nickname'     => $this->string()->notNull(),
            'sex'  => $this->smallInteger(),
            'province'  => $this->string(),
            'city'  => $this->string(),
            'country'  => $this->string(),
            'img_url'  => $this->string(),

            'created_at'    => $this->integer()->unsigned()->notNull(),
            'updated_at'    => $this->integer()->unsigned()->notNull(),
        ], $this->tableOptions. " COMMENT '用户表'");

        //捐款表
        $this->createTable($this->tableDonation, [
            'id'            => $this->primaryKey(),
            'user_id'     => $this->integer()->unsigned()->notNull(),
            'product_id'     => $this->integer()->unsigned()->notNull(),
            'team_id'     => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'comment'     => $this->string()->unsigned()->notNull()->defaultValue(''),
            'money'     => $this->decimal(2)->notNull(),

            'created_at'    => $this->integer()->unsigned()->notNull(),
            'updated_at'    => $this->integer()->unsigned()->notNull(),
        ], $this->tableOptions. " COMMENT '捐款表'");

        //项目表
        $this->createTable($this->tableProject, [
            'id'            => $this->primaryKey(),


            'title'    => $this->string()->notNull(),
            'sub_title'    => $this->string()->notNull()->defaultValue(''),
            'content'    => $this->text()->notNull(),
            'receiver'    => $this->string()->notNull()->defaultValue(''),
            'expect_money' => $this->decimal(2)->notNull()->defaultValue(0),
            'now_money' => $this->decimal(2)->notNull(),
            'count' => $this->integer()->unsigned()->notNull(),

            'created_at'    => $this->integer()->unsigned()->notNull(),
            'created_by'    => $this->integer()->unsigned()->notNull(),
            'updated_at'    => $this->integer()->unsigned()->notNull(),
            'updated_by'    => $this->integer()->unsigned()->notNull(),
        ], $this->tableOptions. " COMMENT '项目表'");

        //团队表
        $this->createTable($this->tableTream, [
            'id'            => $this->primaryKey(),

            'leader_id' => $this->integer()->unsigned()->notNull(),
            'rank'          => $this->smallInteger()->unsigned(),
            'donation_id'          => $this->integer()->unsigned(),
            'money' => $this->decimal(2)->notNull(),

            'created_at'    => $this->integer()->unsigned()->notNull(),
            'updated_at'    => $this->integer()->unsigned()->notNull(),

        ], $this->tableOptions. " COMMENT '团队表'");



    }

    public function safeDown()
    {
        $this->dropTable($this->tableUser);
        $this->dropTable($this->tableDonation);
        $this->dropTable($this->tableProject);
        $this->dropTable($this->tableTream);
    }
}
