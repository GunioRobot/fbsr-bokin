<?php
$this->breadcrumbs=array(
	'Bokin Divisions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BokinDivision', 'url'=>array('index')),
	array('label'=>'Manage BokinDivision', 'url'=>array('admin')),
);
?>

<h1>Create BokinDivision</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>