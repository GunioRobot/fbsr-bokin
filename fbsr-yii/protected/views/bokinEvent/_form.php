<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bokin-event-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php //echo var_dump(Yii::app()->user); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'User_id'); ?>
		<?php if (Yii::app()->user->isGuest): ?>
		<?php //echo $form->labelEx($model,'User_id'); ?>
		<?php //echo $form->hiddenField($model,'User_id'); ?>
		<?php echo $form->labelEx($model,'User_id'); ?>
		<?php echo $form->error($model,'User_id'); ?>
		<?php $this->widget('CAutoComplete',
          array(
                         //name of the html field that will be generated
             'name'=>'User_name', 
                         //replace controller/action with real ids
             'url'=>array('site/userLookup'), 
             'max'=>10, //specifies the max number of items to display
 
                         //specifies the number of chars that must be entered 
                         //before autocomplete initiates a lookup
             'minChars'=>2, 
             'delay'=>100, //number of milliseconds before lookup occurs
             'matchCase'=>false, //match case when performing a lookup?
 
                         //any additional html attributes that go inside of 
                         //the input field can be defined here
             'htmlOptions'=>array('size'=>'40'), 
 
             'methodChain'=>".result(function(event,item){\$(\"#BokinEvent_User_id\").val(item[1]);})",
             ));    ?>
             <?php endif; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Division_id'); ?>
		<?php //echo $form->textField($model,'Division_id'); ?>
		<?php echo $form->dropDownList($model,'Division_id',CHtml::listData($divisions,'id','Name')); ?>
		<?php echo $form->error($model,'Division_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OpenDate'); ?>
		<?php echo $form->textField($model,'OpenDate'); ?>
		<?php echo CHtml::image("images/calander.jpg","calendar",
array("id"=>"d_button","class"=>"pointer")); ?>
    &nbsp;
    <?php $this->widget('application.extensions.calendar.SCalendar', array(
        'inputField'=>'BokinEvent_OpenDate',
        'ifFormat'=>'%Y-%m-%d %H:%M',
        'showsTime'=>true,
    	'button'=>'d_button',
    ));
    ?>
		
		<?php echo $form->error($model,'OpenDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CloseDate'); ?>
		<?php echo $form->textField($model,'CloseDate'); ?>
		<?php echo CHtml::image("images/calander.jpg","calendar",
array("id"=>"c_button","class"=>"pointer")); ?>
    &nbsp;
    <?php $this->widget('application.extensions.calendar.SCalendar',
        array(
        'button'=>'c_button',
        'inputField'=>'BokinEvent_CloseDate',
        'ifFormat'=>'%Y-%m-%d %H:%M',
        'showsTime'=>true,
    ));
    ?>
		<?php echo $form->error($model,'CloseDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->