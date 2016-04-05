<?php
class NewsController extends Controller
{
    /**
     * Отображает список новостей.
     */
    public function actionIndex()
    {
        $news = News::model()->findAll();

        $this->render('index', array(
                'news'=>$news,
        ));
    }

    /**
     * Отображает конкретную новость.
     */
    public function actionGet()
    {
        $news = News::model()->with('files')->findByPk($_GET['id']);

        $this->render('get', array(
                'news'=>$news,
        ));
    }
    /* old function
    public function actionGet()
    {
        $news = News::model()->findByPk($_GET['id']);

        $this->render('get', array(
                'news'=>$news,
        ));
    }
    */

    
    /* old function
    public function actionCreate()
    {
        $model=new News;

        if(isset($_POST['News']))
        {
            $model->attributes=$_POST['News'];

            // Сохраняем изображение если выбрано
        	if(!empty($_FILES['News']['name']['image']))
    		{
    			$model->image=CUploadedFile::getInstance($model,'image');
            	$path=Yii::getPathOfAlias('webroot').'/upload/'.$model->image->getName();
            	$model->image->saveAs($path);
        	}

            if($model->save())
            	$this->redirect(array('get','id'=>$model->id));

        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    */
    /**
     * Создает новость.
     */
    public function actionCreate()
    {
        $model=new News;
        $model->files=new Files;
        $model->scenario = 'create';

        if(isset($_POST['News']))
        {
            $transaction=$model->dbConnection->beginTransaction();
            try
            {
                $model->attributes=$_POST['News'];

                // Загружаем изображение если выбрано.
                if(!empty($_FILES['Files']['name']['name']))
                    $model->files->fileLoadInModel('name');

                if ($model->files->validate())
                {
                    // Обновляем запись
                    if($model->save())
                        $transaction->commit();
                    else
                        $transaction->rollback();
                }
            }
            catch(Exception $ex) {
                $transaction->rollback();
                throw $ex;
            }
            //$this->redirect(array('get','id'=>$model->id));

        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Редактирование новости.
     */
    public function actionUpdate()
    {
    	$model=News::model()->with('files')->findByPk($_GET['id']);
        $model->scenario='update';
        
        // Если небыло файла создаем новый объект.
        if ($model->files == null)
            $model->files = new Files;

            if(isset($_POST['News']))
            {
                $transaction=$model->dbConnection->beginTransaction();
                try
                {
                    $model->attributes=$_POST['News'];

                    // Если выбрано изображение, загружаем новое.
                    if (!empty($_FILES['Files']['name']['name']))
                        $model->files->fileLoadInModel('name');               

                    if ($model->files->validate())
                    {
                        // Обновляем запись
                        if($model->save())
                            $transaction->commit();
                        else
                            $transaction->rollback();
                    }
                }
                catch(Exception $ex) {
                    $transaction->rollback();
                    throw $ex;
                }
                
                //$this->redirect(array('get','id'=>$model->id));
            }
        
        

    	$this->render('update',array(
            'model'=>$model,
    	));
    }

    
    /* old function
    public function actionUpdate()
    {
    	// Заполняем формы данными из бд.
    	$model=News::model()->findByPk($_GET['id']);
    	$model->scenario='update';

    	if(isset($_POST['News']))
		{
    		$model->attributes=$_POST['News'];

    		// Если выбрано изображение.
    		if (!empty($_FILES['News']['name']['image']))
    		{
    			// Загружаем новое изображение.
    			$model->image=CUploadedFile::getInstance($model,'image');
    			$path=Yii::getPathOfAlias('webroot').'/upload/'.$model->image->getName();
                $model->image->saveAs($path);

                // Обновляем запись
                $model->save();
    		}
    		else
    		{
    			// Обновляем запись без изображения.
    			$model->save(true, array('title', 'desc', 'body', 'alias', 'status')); 
    		}

    		$this->redirect(array('get','id'=>$model->id));
		}

    	$this->render('update',array(
    		'model'=>$model,
    	));
    }
    */

    /**
     * Удаляет новость.
     */
    public function actionDelete()
    {
    	$model=News::model()->with('files')->findByPk($_GET['id']);
    	$model->delete();
    	$this->redirect(array('index'));
    }
}