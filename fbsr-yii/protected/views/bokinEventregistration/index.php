<?php
$this->breadcrumbs=array(
	'Bokin Eventregistrations',
);

$this->menu=array(
	array('label'=>'Create BokinEventregistration', 'url'=>array('create')),
	array('label'=>'Manage BokinEventregistration', 'url'=>array('admin')),
);
?>

<h1>Bokin Eventregistrations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
