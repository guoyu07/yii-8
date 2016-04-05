<?php

class m160328_144246_delete_img_field extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('news', 'image');
	}

	public function down()
	{
		$this->addColumn('news', 'image', 'varchar(255) NOT NULL');
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