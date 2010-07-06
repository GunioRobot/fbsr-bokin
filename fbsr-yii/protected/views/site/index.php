<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bokin-eventregistration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row_buttons">
		<?php echo $form->labelEx($model,'User_id'); ?>
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
 
             'methodChain'=>".result(function(event,item){\$(\"#BokinEventregistration_User_id\").val(item[1]);})",
             ));    ?>
    	<?php echo $form->hiddenField($model,'User_id'); ?>
	
		<?php echo $form->error($model,'User_id'); ?>

		<?php echo $form->labelEx($model,'Event_id'); ?>
	
		<?php echo $form->dropDownList($model,'Event_id',CHtml::listData($events,'id','Name')); ?>
		<?php echo $form->error($model,'Event_id'); ?>

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Skrá' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php foreach($events as $i=>$event) {
	echo '<div class="view">';
	echo '<b>'.$event->division->Name.' - '.$event->Name.'</b>';
	echo CHtml::link(CHtml::image(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview/delete.png','Loka atburði og skrá alla út'),array('bokinEvent/loka','id'=>$event->id),array('title'=>'Loka atburði og skrá alla út'));
	echo '<br />';
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'bokin-eventregistration-grid',
		'dataProvider'=>$dataProvider[$i],
		'hideHeader'=>true,
		'enablePagination'=>false,
		'emptyText'=>'',
		'showTableOnEmpty'=>false,
		'summaryText'=>'{count} skráðir',
		'columns'=>array(
			array(
            	'name'=>'user.jos_comprofilers.avatar',
				'type'=>'html',
            	'value'=>'($data->user->jos_comprofilers->avatar== null) ? CHtml::image(JosComprofiler::no_avatar,"", array("height"=>40)) : CHtml::image(JosComprofiler::pre_avatar.$data->user->jos_comprofilers->avatar,"",array("height"=>40))',
        	),
			'user.name',
			'user.jos_comprofilers.cb_gsm',
  			array(
	            'name'=>'user.jos_comprofilers.cb_gsm',
            	'value'=>'($data->user->jos_comprofilers->cb_nylidi == "1") ? "Nýliði" : ""',
        	),
			'RegisteredDate',
			array(
            'class'=>'CButtonColumn',
			'template' => '{delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/bokinEventregistration/skra_ut", array("id" => $data->id))',
			'deleteButtonLabel'=>'Skrá út'
//                        'template' => '{delete} {postview}',
//                        'buttons' => array(
//                            'postview' => array(
//                    'label'=>'...',     // text label of the button
//                    'url'=>'...',       // the PHP expression for generating the URL of the button
//                    'imageUrl'=>Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview/delete.png',  // image URL of the button. If not set or false, a text link is used
//                    'options'=>array(), // HTML options for the button tag
//                    'click'=>'...',     // a JS function to be invoked when the button is clicked
          
//				),),
			),
		),
	));
	echo '</div>'; 
}?> 