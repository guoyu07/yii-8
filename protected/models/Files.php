<?php

/**
 * This is the model class for table "files".
 *
 * The followings are the available columns in table 'files':
 * @property integer $id
 * @property integer $news_id
 * @property string $name
 */
class Files extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'files';
	}

	 /**
	  * @return array validation rules for model attributes.
	  */
	 public function rules()
	 {
	 	// NOTE: you should only define rules for those attributes that
	 	// will receive user inputs.
	 	return array(
	 		//array('news_id, name', 'required'),
	 		//array('news_id', 'numerical', 'integerOnly'=>true),
	 		//array('name', 'length', 'max'=>255),
                        array('name', 'file', 'types'=>'jpg, gif, png', 'maxSize'=> 1*1024*1024, 'allowEmpty'=>true),
	 	);
	 }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Файл принадлежит новости.
		return array(
			'news'=>array(self::BELONGS_TO, 'News', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'news_id' => 'News',
			'name' => 'Name',
		);
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
		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Files the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
	 * Загружает файл в директорию
	 */
        public function fileLoadInDir()
        {
            $path=Yii::getPathOfAlias('webroot').'/upload/'.$this->name->getName();
            $this->name->saveAs($path);
        }
        
        /**
        * Записывает экземпляр загруженного файла в атрибут модели.
        * @param str $sttribute - имя атрибута.
        */
        public function fileLoadInModel($attribute)
        {
           $this->$attribute=CUploadedFile::getInstance($this, $attribute);
        }
}
