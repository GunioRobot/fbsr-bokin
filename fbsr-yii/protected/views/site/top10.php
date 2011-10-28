<?php $this->pageTitle=Yii::app()->name; ?>

<?php
echo '<h3>Heitustu meðlimir síðustu 7 daga</h3>';
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'top_7days',
		'dataProvider'=>$dp7,
		'columns'=>array(
				'i',
				'name',
				'delta_str'
				)
			));
echo '<h3>Heitustu meðlimir síðustu 30 daga</h3>';
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'top_30days',
		'dataProvider'=>$dp30,
		'columns'=>array(
				'i',
				'name',
				'delta_str'
				)
			));
echo '<h3>Heitustu meðlimir síðustu 365 daga</h3>';
$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'top_365days',
		'dataProvider'=>$dp365,
		'columns'=>array(
				'i',
				'name',
				'delta_str'
				)
			));
?>