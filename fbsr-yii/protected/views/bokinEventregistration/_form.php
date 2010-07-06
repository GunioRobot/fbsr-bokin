<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bokin-eventregistration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
		<?php echo $form->error($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Event_id'); ?>
		<?php echo $form->textField($model,'Event_id'); ?>
		<?php echo $form->error($model,'Event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RegisteredDate'); ?>
		<?php echo $form->textField($model,'RegisteredDate'); ?>
		<?php echo $form->error($model,'RegisteredDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UnregisteredDate'); ?>
		<?php echo $form->textField($model,'UnregisteredDate'); ?>
		<?php echo $form->error($model,'UnregisteredDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->