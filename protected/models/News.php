<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $body
 * @property string $alias
 * @property integer $status
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	public function rules()
	{
		return array(
			array('title, body, alias, status', 'required'),
			array('desc', 'required', 'on'=>'update'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// У новости есть один файл.
		return array(
			'files'=>array(self::HAS_ONE, 'Files', 'news_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'desc' => 'Desc',
			'body' => 'Body',
			'alias' => 'Alias',
			'status' => 'Status',
		);
	}

	protected function afterSave(){
            parent::afterSave();

            //Если файл был выбран.
            if (is_object($this->files->name))
            {
                // Задаем файлам id новости.
                $this->files->news_id = $this->id;
                
                // Если проходим валидацию, сохраняем файл в директорию и в базу.
                if ($this->files->save())
                {
                    $this->files->fileLoadInDir();
                }
            }
        }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
}
