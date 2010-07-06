<?php
$this->breadcrumbs=array(
	'Bokin Divisions',
);

$this->menu=array(
	array('label'=>'Create BokinDivision', 'url'=>array('create')),
	array('label'=>'Manage BokinDivision', 'url'=>array('admin')),
);
?>

<h1>Bokin Divisions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
