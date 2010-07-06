<?php
$this->breadcrumbs=array(
	'Jos Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JosUsers', 'url'=>array('index')),
	array('label'=>'Create JosUsers', 'url'=>array('create')),
	array('label'=>'View JosUsers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage JosUsers', 'url'=>array('admin')),
);
?>

<h1>Update JosUsers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>