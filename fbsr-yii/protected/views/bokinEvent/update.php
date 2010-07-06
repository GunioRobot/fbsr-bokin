<?php
$this->breadcrumbs=array(
	'Bokin Events'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BokinEvent', 'url'=>array('index')),
	array('label'=>'Create BokinEvent', 'url'=>array('create')),
	array('label'=>'View BokinEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BokinEvent', 'url'=>array('admin')),
);
?>

<h1>Update BokinEvent <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'divisions'=>$divisions)); ?>