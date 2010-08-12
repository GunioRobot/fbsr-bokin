<?php

class SiteController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new BokinEventregistration('register');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BokinEventregistration']))
		{
			$model->attributes=$_POST['BokinEventregistration'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$events = BokinEvent::model()->active()->findAll();
		$dataProvider = array();
		foreach($events as $event) {
			$dataProvider[]=new CActiveDataProvider('BokinEventregistration',array(
    			'criteria'=>array(
					'condition'=>'Event_id=:Event_id and UnregisteredDate is null',
					'params'=> array(':Event_id'=>$event->id),
					'with'=>array('user.jos_comprofilers'),
    				'order'=>'cb_nylidi ASC',
				)));
		}
		
		$this->render('index',array(
			'model'=>$model,
			'events'=>$events,
			'dataProvider'=>$dataProvider
		));	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionTop10()
	{
/*		$model=new BokinEventregistration('register');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BokinEventregistration']))
		{
			$model->attributes=$_POST['BokinEventregistration'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$events = BokinEvent::model()->active()->findAll();
		$dataProvider = array();
		foreach($events as $event) {
			$dataProvider[]=new CActiveDataProvider('BokinEventregistration',array(
    			'criteria'=>array(
					'condition'=>'Event_id=:Event_id and UnregisteredDate is null',
					'params'=> array(':Event_id'=>$event->id),
					'with'=>array('user.jos_comprofilers'),
    				'order'=>'cb_nylidi ASC',
				)));
		}
		*/
		$sql='select ju.name, sum(ifnull(UnRegisteredDate - RegisteredDate, now()-RegisteredDate))/3600 as delta from bokin_eventregistration ber, jos_users ju where ber.user_id=ju.id and registereddate > now()- INTERVAL 7 day group by user_id order by delta desc;';
		$command= Yii::app()->db->createCommand($sql);
		$top_7days=$command->query();
		$sql='select ju.name, sum(ifnull(UnRegisteredDate - RegisteredDate, now()-RegisteredDate))/3600 as delta from bokin_eventregistration ber, jos_users ju where ber.user_id=ju.id and registereddate > now()- INTERVAL 30 day group by user_id order by delta desc;';
		$command= Yii::app()->db->createCommand($sql);
		$top_30days=$command->query();
		$this->render('top10',array(
			'top30'=>$top_30days,
			'top7'=>$top_7days,
			//'dataProvider'=>$dataProvider
		));	
		
	}
		
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() 	{
		$assigned_roles = Yii::app()->authManager->getRoles(Yii::app()->user->id); //obtains all assigned roles for this user id
       	if(!empty($assigned_roles)) {//checks that there are assigned roles
           	$auth=Yii::app()->authManager; //initializes the authManager
       		foreach($assigned_roles as $n=>$role){
				if($auth->revoke($n,Yii::app()->user->id)) //remove each assigned role for this user
                	Yii::app()->authManager->save(); //again always save the result
			}
		}
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
    //Action
    public function actionUserLookup()
    {
       if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
       {
            /* q is the default GET variable name that is used by
            / the autocomplete widget to pass in user input
            */
          $name = $_GET['q']; 
                    // this was set with the "max" attribute of the CAutoComplete widget
          $limit = min($_GET['limit'], 50); 
          $criteria = new CDbCriteria;
          $criteria->condition = "name LIKE :sterm";
          $criteria->params = array(":sterm"=>"%$name%");
          $criteria->limit = $limit;
          $userArray = JosUsers::model()->findAll($criteria);
          $returnVal = '';
          foreach($userArray as $userAccount)
          {
             $returnVal .= $userAccount->getAttribute('name').'|'
                                         .$userAccount->getAttribute('id')."\n";
          }
          echo $returnVal;
       }
    }
}