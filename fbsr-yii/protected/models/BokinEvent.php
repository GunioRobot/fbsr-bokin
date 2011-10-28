<?php

class BokinEvent extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'bokin_event':
	 * @var integer $id
	 * @var integer $Division_id
	 * @var string $Name
	 * @var string $OpenDate
	 * @var string $CloseDate
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return BokinEvent the static model class
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
		return 'bokin_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('User_id, Division_id, Name, OpenDate', 'required'),
			array('Division_id', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>200),
			array('Name, User_id, Division_id, OpenDate, CloseDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, Division_id, Name, OpenDate, CloseDate', 'safe', 'on'=>'search'),
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
			'division' => array(self::BELONGS_TO, 'BokinDivision', 'Division_id'),
			//'event' => array(self::BELONGS_TO, 'BokinEvent', 'Event_id'),
			'user' => array(self::BELONGS_TO, 'JosUsers', 'User_id'),
			'bokin_eventregistrations' => array(self::HAS_MANY, 'BokinEventregistration', 'Event_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'User_id' => 'User',
			'Division_id' => 'Division',
			'Name' => 'Name',
			'OpenDate' => 'Open Date',
			'CloseDate' => 'Close Date',
		);
	}

	public function scopes() {
		return array(
    	'active'=>array(
          'condition'=>'CloseDate is null or CloseDate > now()',
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

		$criteria->compare('Division_id',$this->Division_id);

		$criteria->compare('Name',$this->Name,true);

		$criteria->compare('OpenDate',$this->OpenDate,true);

		$criteria->compare('CloseDate',$this->CloseDate,true);

		return new CActiveDataProvider('BokinEvent', array(
			'criteria'=>$criteria,
		));
	}
}