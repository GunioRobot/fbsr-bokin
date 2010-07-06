<?php
$this->breadcrumbs=array(
	'Bokin Divisions'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BokinDivision', 'url'=>array('index')),
	array('label'=>'Create BokinDivision', 'url'=>array('create')),
	array('label'=>'Update BokinDivision', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BokinDivision', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BokinDivision', 'url'=>array('admin')),
);
?>

<h1>View BokinDivision #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'User_id',
		'Name',
		'OpenDate',
		'CloseDate',
	),
)); ?>
