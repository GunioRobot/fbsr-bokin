<?php
$this->breadcrumbs=array(
	'Jos Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JosUsers', 'url'=>array('index')),
	array('label'=>'Manage JosUsers', 'url'=>array('admin')),
);
?>

<h1>Create JosUsers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>