<?php

class BokinEventregistration extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'bokin_eventregistration':
	 * @var integer $id
	 * @var integer $User_id
	 * @var integer $Event_id
	 * @var string $RegisteredDate
	 * @var string $UnregisteredDate
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return BokinEventregistration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bokin_eventregistration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_id','required','message'=>'Notandi fannst ekki í fbsr.is notendalista, skráðu þig sem nilla til að byrja með'),
			array('Event_id', 'required'),
			array('User_id, Event_id', 'numerical', 'integerOnly'=>true),
			array('User_id, Event_id', 'safe'),
			array('User_id', 'not_already_registered','on'=>'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, User_id, Event_id, RegisteredDate, UnregisteredDate', 'safe', 'on'=>'search'),
		);
	}


	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'RegisteredDate',
				'updateAttribute' => null, //'update_time_attribute',
			)
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'event' => array(self::BELONGS_TO, 'BokinEvent', 'Event_id'),
			'user' => array(self::BELONGS_TO, 'JosUsers', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'User_id' => 'Nafn',
			'Event_id' => 'Atburður',
			'RegisteredDate' => 'Registered Date',
			'UnregisteredDate' => 'Unregistered Date',
		);
	}

	/**
	 * Checks that user is not already registered on active event
	 * This is the 'not_already_registered' validator as declared in rules().
	 */
	public function not_already_registered($attribute,$params) {
		$registration=BokinEventregistration::model()->find(array(
		        'condition'=>'UnregisteredDate is null AND User_id = :User_id',
        		'params'=>array(':User_id'=>$this->User_id),
				));
		
		if($registration)
			$this->addError('User_id','Þegar skráður á atburð');
	}
	
	public function scopes() {
		return array(
    	'active'=>array(
          'condition'=>'UnregisteredDate is null',
    		),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('User_id',$this->User_id);

		$criteria->compare('Event_id',$this->Event_id);

		$criteria->compare('RegisteredDate',$this->RegisteredDate,true);

		$criteria->compare('UnregisteredDate',$this->UnregisteredDate,true);

		return new CActiveDataProvider('BokinEventregistration', array(
			'criteria'=>$criteria,
		));
	}
}