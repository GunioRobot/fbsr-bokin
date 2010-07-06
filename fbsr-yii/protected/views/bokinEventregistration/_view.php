<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_id')); ?>:</b>
	<?php echo CHtml::encode($data->User_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Event_id')); ?>:</b>
	<?php echo CHtml::encode($data->Event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RegisteredDate')); ?>:</b>
	<?php echo CHtml::encode($data->RegisteredDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UnregisteredDate')); ?>:</b>
	<?php echo CHtml::encode($data->UnregisteredDate); ?>
	<br />


</div>