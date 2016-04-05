<?php

class m160320_171529_add_img_field extends CDbMigration
{
	public function up()
	{
		$this->addColumn('news', 'image', 'varchar(255) NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('news', 'image');
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