<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bokin-division-form',
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
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OpenDate'); ?>
		<?php echo $form->textField($model,'OpenDate'); ?>
		<?php echo $form->error($model,'OpenDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CloseDate'); ?>
		<?php echo $form->textField($model,'CloseDate'); ?>
		<?php echo $form->error($model,'CloseDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->