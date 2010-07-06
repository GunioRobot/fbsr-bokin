<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Event_id'); ?>
		<?php echo $form->textField($model,'Event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RegisteredDate'); ?>
		<?php echo $form->textField($model,'RegisteredDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UnregisteredDate'); ?>
		<?php echo $form->textField($model,'UnregisteredDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->