<?php

namespace lo\modules\eav\migrations;

use lo\core\db\Migration;

class m160327_075320_eav_init extends Migration
{
    public function safeUp()
    {
        $tbl_entity_model = '{{%eav__entity_model}}';
        $tbl_attribute_type = '{{%eav__attribute_type}}';
        $tbl_attribute = '{{%eav__attribute}}';
        $tbl_attribute_option = '{{%eav__attribute_option}}';
        $tbl_entity = '{{%eav__entity}}';
        $tbl_entity_attribute = '{{%eav__entity_attribute}}';
        $tbl_value = '{{%eav__value}}';

        //---------------- eav_entity_model ----------------

        $this->createTable($tbl_entity_model, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'entity_name' => $this->string(100)->notNull(),
            'entity_model' => $this->string(100)->notNull(),
        ]);

        $this->createIndex('eav_entity_model_unique_model', $tbl_entity_model, ['entity_model'], true);
        $this->createIndex('eav_entity_model_status', $tbl_entity_model, ['status']);

        //---------------- eav_attribute_type ----------------

        $this->createTable($tbl_attribute_type, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'name' => $this->string()->notNull(),
            'store_type' => $this->string('32')->notNull()->defaultValue('raw')
        ]);

        $this->createIndex('eav_attribute_type_status', $tbl_attribute_type, ['status']);

        $this->insert($tbl_attribute_type, [
            'author_id' => 1,
            'updater_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'name' => 'text',
            'store_type' => 'raw'
        ]);
        $this->insert($tbl_attribute_type, [
            'author_id' => 1,
            'updater_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            'name' => 'select',
            'store_type' => 'option'
        ]);

        //---------------- eav_attribute ----------------

        $this->createTable($tbl_attribute, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'type_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'label' => $this->string(),
            'default_value' => $this->string(),
            'icon' => $this->string(64),
            'description' => $this->string(),
            'required' => $this->integer(1),
        ]);

        $this->createIndex('eav_attribute_type_id', $tbl_attribute, ['type_id']);
        $this->createIndex('eav_attribute_name', $tbl_attribute, ['name']);
        $this->createIndex('eav_attribute_status', $tbl_attribute, ['status']);

        $this->addForeignKey(
            'fk_eav_attribute_type',
            $tbl_attribute, 'type_id',
            $tbl_attribute_type, 'id',
            'CASCADE',
            'CASCADE'
        );

        //---------------- eav_attribute_option ----------------

        $this->createTable($tbl_attribute_option, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'attribute_id' => $this->integer(),
            'value' => $this->string(),
        ]);

        $this->createIndex('eav_attribute_option_attribute_id', $tbl_attribute_option, ['attribute_id']);
        $this->createIndex('eav_attribute_option_status', $tbl_attribute_option, ['status']);

        $this->addForeignKey(
            'fk_eav_option_attribute',
            $tbl_attribute_option, 'attribute_id',
            $tbl_attribute, 'id',
            'CASCADE',
            'CASCADE'
        );

        //---------------- eav_entity ----------------

        $this->createTable($tbl_entity, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'model_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        $this->createIndex('eav_entity_model_id', $tbl_entity, ['model_id']);
        $this->createIndex('eav_entity_category_id', $tbl_entity, ['category_id']);
        $this->createIndex('eav_entity_status', $tbl_entity, ['status']);

        $this->addForeignKey(
            'fk_eav_entity_model',
            $tbl_entity, 'model_id',
            $tbl_entity_model, 'id',
            'CASCADE',
            'CASCADE'
        );

        //---------------- eav_entity_attribute ----------------

        $this->createTable($tbl_entity_attribute, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'entity_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'order' => $this->integer()->defaultValue(0),
        ]);

        $this->createIndex('eav_entity_attribute_entity_id', $tbl_entity_attribute, ['entity_id']);
        $this->createIndex('eav_entity_attribute_attribute_id', $tbl_entity_attribute, ['attribute_id']);
        $this->createIndex('eav_entity_attribute_status', $tbl_entity_attribute, ['status']);

        $this->addForeignKey(
            'fk_eav_entity_attribute_entity',
            $tbl_entity_attribute, 'entity_id',
            $tbl_entity, 'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey('fk_eav_entity_attribute_attribute',
            $tbl_entity_attribute, 'attribute_id',
            $tbl_attribute, 'id',
            'CASCADE',
            'CASCADE'
        );

        //---------------- eav_value ----------------

        $this->createTable($tbl_value, [
            'id' => $this->primaryKey(),

            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'entity_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'item_id' => $this->integer(),
            'value' => $this->text(),
        ]);

        $this->createIndex('eav_value_entity_id', $tbl_value, ['entity_id']);
        $this->createIndex('eav_value_attribute_id', $tbl_value, ['attribute_id']);
        $this->createIndex('eav_value_item_id', $tbl_value, ['item_id']);

        $this->addForeignKey(
            'fk_eav_value_entity',
            $tbl_value, 'entity_id',
            $tbl_entity, 'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_eav_value_attribute',
            $tbl_value, 'attribute_id',
            $tbl_attribute, 'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_eav_attribute_type', 'eav_attribute');
        $this->dropForeignKey('fk_eav_option_attribute', 'eav_attribute_option');

        $this->dropForeignKey('fk_eav_entity_model', 'eav_entity', 'model_id');
        $this->dropForeignKey('fk_eav_entity_attribute_entity', 'eav_entity_attribute');
        $this->dropForeignKey('fk_eav_entity_attribute_attribute', 'eav_entity_attribute');
        $this->dropForeignKey('fk_eav_value_entity', 'eav_value');
        $this->dropForeignKey('fk_eav_value_attribute', 'eav_value');

        $this->dropTable('{{%eav_attribute}}');
        $this->dropTable('{{%eav_attribute_option}}');
        $this->dropTable('{{%eav_attribute_type}}');
        $this->dropTable('{{%eav_entity}}');
        $this->dropTable('{{%eav_entity_attribute}}');
        $this->dropTable('{{%eav_entity_model}}');
    }


}
