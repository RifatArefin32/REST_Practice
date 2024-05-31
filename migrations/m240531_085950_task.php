<?php

use yii\db\Migration;

/**
 * Class m240531_085950_task
 */
class m240531_085950_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("task", [
            "id"=> $this->primaryKey(),
            "title"=> $this->string()->notNull(),
            "body"=> $this->text()->notNull(),
            "created_by"=> $this->integer()->notNull(),
            "created_at" => $this->integer()->notNull(),
            "updated_at"=> $this->integer()->notNull(),
            "updated_by"=> $this->integer()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("task");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240531_085950_task cannot be reverted.\n";

        return false;
    }
    */
}
