<?php
$this->breadcrumbs=array(
	'Bokin Divisions'=>array('index'),
	$model->Name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BokinDivision', 'url'=>array('index')),
	array('label'=>'Create BokinDivision', 'url'=>array('create')),
	array('label'=>'View BokinDivision', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BokinDivision', 'url'=>array('admin')),
);
?>

<h1>Update BokinDivision <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>