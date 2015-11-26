<?php

use console\db\Migration;

class m151024_093960_cols_ent extends Migration
{
    public $tableName = "{{%eav__entity}}";

    public function up()
    {
        $this->addColumn($this->tableName, "status", 'tinyint(1) NOT NULL DEFAULT 1');
        $this->addColumn($this->tableName, "author_id", $this->integer()->notNull()->defaultValue(1));
        $this->addColumn($this->tableName, "updater_id", $this->integer()->notNull()->defaultValue(1));
        $this->addColumn($this->tableName, "created_at", $this->integer()->notNull());
        $this->addColumn($this->tableName, "updated_at", $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn($this->tableName, "status");
        $this->dropColumn($this->tableName, "author_id");
        $this->dropColumn($this->tableName, "updater_id");
        $this->dropColumn($this->tableName, "created_at");
        $this->dropColumn($this->tableName, "updated_at");
    }
}
