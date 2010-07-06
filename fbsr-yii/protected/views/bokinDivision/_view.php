<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_id')); ?>:</b>
	<?php echo CHtml::encode($data->User_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OpenDate')); ?>:</b>
	<?php echo CHtml::encode($data->OpenDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CloseDate')); ?>:</b>
	<?php echo CHtml::encode($data->CloseDate); ?>
	<br />


</div>