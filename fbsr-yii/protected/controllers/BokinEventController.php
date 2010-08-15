<?php

class BokinEventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','loka','create','list'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','admin','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			//'model'=>$this->loadModel(),
			'model'=>BokinEvent::model()->findbyPk($_GET['id'])
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BokinEvent;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BokinEvent']))
		{
			$model->attributes=$_POST['BokinEvent'];
			if (Yii::app()->user->isGuest == false)
				$model->User_id = Yii::app()->user->id;
			if (!isset($_POST['BokinEvent']['CloseDate']) || $_POST['BokinEvent']['CloseDate'] == '') {
				$model->CloseDate = null;
			}
			if($model->save()) {
				try {
					$er=new BokinEventregistration;
					$er->User_id = $model->User_id;
					$er->Event_id = $model->id;
					$er->RegisteredDate = new CDbExpression('NOW()');
					$er->UnregisteredDate = null;
					$er->save();
				} catch (Exception $e) {
					Yii::log($e->getMessage(),'error','bokin');
				}
				$this->redirect(array('site/index'));
			}
		} else {
			$model->OpenDate = date('Y-m-d H:i');
		}

		$divisions = BokinDivision::model()->findAll();
		
		$this->render('create',array(
			'model'=>$model,
			'divisions'=>$divisions,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BokinEvent']))
		{
			$model->attributes=$_POST['BokinEvent'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$divisions = BokinDivision::model()->findAll();

		$this->render('update',array(
			'model'=>$model,
			'divisions'=>$divisions,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BokinEvent');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BokinEvent('search');
		if(isset($_GET['BokinEvent']))
			$model->attributes=$_GET['BokinEvent'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionList()
	{
		$dataProvider=new CActiveDataProvider('BokinEvent');
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionLoka() {
		$registrations = BokinEventregistration::model()->findAll('Event_id=:Event_id', array(':Event_id'=>$_GET['id']));
		if (isset($registrations))
			foreach($registrations as $registration) {
				$registration->UnregisteredDate = new CDbExpression('NOW()');
				$registration->save();
			}
		$model = $this->loadModel(); //->delete();
		$model->CloseDate = new CDbExpression('NOW()');
		$model->save();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('site/index'));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=BokinEvent::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bokin-event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
