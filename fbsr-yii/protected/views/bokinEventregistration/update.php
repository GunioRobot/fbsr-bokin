<?php
$this->breadcrumbs=array(
	'Bokin Eventregistrations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BokinEventregistration', 'url'=>array('index')),
	array('label'=>'Create BokinEventregistration', 'url'=>array('create')),
	array('label'=>'View BokinEventregistration', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BokinEventregistration', 'url'=>array('admin')),
);
?>

<h1>Update BokinEventregistration <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>