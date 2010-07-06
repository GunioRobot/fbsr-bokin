<?php

class BokinDivision extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'bokin_division':
	 * @var integer $id
	 * @var string $Name
	 * @var string $OpenDate
	 * @var string $CloseDate
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return BokinDivision the static model class
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
		return 'bokin_division';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, OpenDate', 'required'),
			array('Name', 'length', 'max'=>200),
			array('CloseDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, Name, OpenDate, CloseDate', 'safe', 'on'=>'search'),
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
			'bokin_events' => array(self::HAS_MANY, 'BokinEvent', 'Division_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'Name' => 'Name',
			'OpenDate' => 'Open Date',
			'CloseDate' => 'Close Date',
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

		$criteria->compare('Name',$this->Name,true);

		$criteria->compare('OpenDate',$this->OpenDate,true);

		$criteria->compare('CloseDate',$this->CloseDate,true);

		return new CActiveDataProvider('BokinDivision', array(
			'criteria'=>$criteria,
		));
	}
}