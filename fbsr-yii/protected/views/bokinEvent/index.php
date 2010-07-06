<?php
$this->breadcrumbs=array(
	'Bokin Events',
);

$this->menu=array(
	array('label'=>'Create BokinEvent', 'url'=>array('create')),
	array('label'=>'Manage BokinEvent', 'url'=>array('admin')),
);
?>

<h1>Bokin Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
