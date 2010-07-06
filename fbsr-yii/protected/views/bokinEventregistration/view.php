<?php
$this->breadcrumbs=array(
	'Bokin Eventregistrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BokinEventregistration', 'url'=>array('index')),
	array('label'=>'Create BokinEventregistration', 'url'=>array('create')),
	array('label'=>'Update BokinEventregistration', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BokinEventregistration', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BokinEventregistration', 'url'=>array('admin')),
);
?>

<h1>View BokinEventregistration #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'User_id',
		'Event_id',
		'RegisteredDate',
		'UnregisteredDate',
	),
)); ?>
