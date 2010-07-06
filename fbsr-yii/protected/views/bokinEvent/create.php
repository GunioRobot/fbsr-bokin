<?php
$this->breadcrumbs=array(
	'Bokin Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BokinEvent', 'url'=>array('index')),
	array('label'=>'Manage BokinEvent', 'url'=>array('admin')),
);
?>

<h1>Create BokinEvent</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'divisions'=>$divisions)); ?>