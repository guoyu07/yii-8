<?php
/* @var $this NewsController */
/* @var $model News */
?>

<h1>Обновление новости <?php echo $model->id; ?></h1>

<?php Yii::app()->clientScript->registerPackage('imgPreload'); ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>