<?php

use yii\db\Migration;

/**
 * Class m240531_051144_user
 */
class m240531_051144_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $db = \Yii::$app->db;
        $this->createTable('user', [
            'id'=> $this->primaryKey(),
            'username'=> $this->string()->notNull(),
            'password'=> $this->string()->notNull(),
            'auth_key'=> $this->string()->notNull(),
            'access_token'=> $this->string()->notNull(),
        ]);

        $this->insert('user', [
            'id'=> 1,
            'username'=> 'user1',
            'password' => "*Rifatbs23#",
            'auth_key'=> \Yii::$app->security->generateRandomString() ,
            'access_token' => \Yii::$app->security->generateRandomString() ,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->delete('user', ['id'=> 1]);
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240531_051144_user cannot be reverted.\n";

        return false;
    }
    */
}
