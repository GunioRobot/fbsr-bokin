<?php
$this->breadcrumbs=array(
	'Jos Users',
);

$this->menu=array(
	array('label'=>'Create JosUsers', 'url'=>array('create')),
	array('label'=>'Manage JosUsers', 'url'=>array('admin')),
);
?>

<h1>Jos Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
