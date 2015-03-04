<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Philipp Frenzel <philipp@frenzel.net>
 * generates the mandanten table(s)
 */
class m999999_000001_comments extends Migration
{
    public function up()
    {
        switch (Yii::$app->db->driverName) {
            case 'mysql':
              $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
              break;
            case 'pgsql':
              $tableOptions = null;
              break;
            default:
              throw new RuntimeException('Your database is not supported!');
        }

        $this->createTable('{{%comment}}',array(
            'id'                    => Schema::TYPE_PK,
            'entity'                => Schema::TYPE_STRING,
            'entity_id'             => Schema::TYPE_INTEGER . ' NOT NULL',
            'text'                  => Schema::TYPE_TEXT,
            'parent_id'             => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            
            // blamable
            'created_by'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by'            => Schema::TYPE_INTEGER . ' NOT NULL',
            
            // timestamps
            'created_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at'            => Schema::TYPE_INTEGER . ' DEFAULT NULL'
        ),$tableOptions);

        $this->createIndex('IX_comment_entity', '{{%comment}}', ['entity']);
    }

    public function down()
    {
        $this->dropTable('{{%comments}}');
    }
    
}