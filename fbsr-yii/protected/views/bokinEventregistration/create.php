<?php
$this->breadcrumbs=array(
	'Bokin Eventregistrations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BokinEventregistration', 'url'=>array('index')),
	array('label'=>'Manage BokinEventregistration', 'url'=>array('admin')),
);
?>

<h1>Create BokinEventregistration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>