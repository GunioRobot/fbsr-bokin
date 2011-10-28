<?php
$this->breadcrumbs=array(
	'Bokin Events',
);

$this->menu=array(
	array('label'=>'Create BokinEvent', 'url'=>array('create')),
	array('label'=>'Manage BokinEvent', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bokin-event-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
//		'id',
		'user.name',
		'division.Name',
		'Name',
		'OpenDate',
		array(
		'name'=>'',
		'type'=> 'html',
		'value'=>'test '.CHtml::link('test'),
		)
//		'CloseDate',
/*		array(
			'class'=>'CButtonColumn',
		),
*/
	),
)); ?>
