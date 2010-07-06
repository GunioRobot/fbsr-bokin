<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'jos-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usertype'); ?>
		<?php echo $form->textField($model,'usertype',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'usertype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'block'); ?>
		<?php echo $form->textField($model,'block'); ?>
		<?php echo $form->error($model,'block'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sendEmail'); ?>
		<?php echo $form->textField($model,'sendEmail'); ?>
		<?php echo $form->error($model,'sendEmail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gid'); ?>
		<?php echo $form->textField($model,'gid'); ?>
		<?php echo $form->error($model,'gid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'registerDate'); ?>
		<?php echo $form->textField($model,'registerDate'); ?>
		<?php echo $form->error($model,'registerDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastvisitDate'); ?>
		<?php echo $form->textField($model,'lastvisitDate'); ?>
		<?php echo $form->error($model,'lastvisitDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activation'); ?>
		<?php echo $form->textField($model,'activation',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'activation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->