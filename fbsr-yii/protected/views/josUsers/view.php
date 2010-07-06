<?php
$this->breadcrumbs=array(
	'Jos Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List JosUsers', 'url'=>array('index')),
	array('label'=>'Create JosUsers', 'url'=>array('create')),
	array('label'=>'Update JosUsers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete JosUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JosUsers', 'url'=>array('admin')),
);
?>

<h1>View JosUsers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'username',
		'email',
		'password',
		'usertype',
		'block',
		'sendEmail',
		'gid',
		'registerDate',
		'lastvisitDate',
		'activation',
		'params',
	),
)); ?>
