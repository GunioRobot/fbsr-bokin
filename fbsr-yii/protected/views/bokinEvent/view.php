<?php
$this->breadcrumbs=array(
	'Bokin Events'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BokinEvent', 'url'=>array('index')),
	array('label'=>'Create BokinEvent', 'url'=>array('create')),
	array('label'=>'Update BokinEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BokinEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BokinEvent', 'url'=>array('admin')),
);
?>

<h1>View BokinEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user.name',
		'division.Name',
		'Name',
		'OpenDate',
		'CloseDate',
	),
));