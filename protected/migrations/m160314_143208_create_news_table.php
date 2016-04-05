<?php

class m160314_143208_create_news_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('news', array(
			'id' => 'pk',
			'title' => 'VARCHAR(255) NOT NULL',
			'desc' => 'text NOT NULL',
			'body' => 'text NOT NULL',
			'alias' => 'VARCHAR(255) NOT NULL',
			'status' => 'int(1) DEFAULT 0'
		));
	}

	public function down()
	{
		$this->dropTable('news');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}