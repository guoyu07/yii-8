<?php
/* @var $this NewsController */
/* @var $model News */
?>

<h1>Create News</h1>

<?php Yii::app()->clientScript->registerPackage('imgPreload'); ?>

<?php $this->renderPartial('_form', array('model'=>$model, 'model2'=>$model2)); ?>