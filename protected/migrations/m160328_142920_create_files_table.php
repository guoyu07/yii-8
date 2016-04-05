<?php

class m160328_142920_create_files_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('files', array(
			'id' => 'pk',
			'news_id' => 'int NOT NULL',
			'name' => 'VARCHAR(255) NOT NULL',
		));
		$this->addForeignKey('files_news_id', 'files', 'news_id', 'news', 'id');
	}

	public function safeDown()
	{
		$this->dropTable('files');
	}
}