<?php

/**
 * This is the model class for table "bokin_userprofile".
 */
class BokinUserprofile extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'bokin_userprofile':
	 * @var integer $id
	 * @var string $SSN
	 * @var string $ImageUrl
	 * @var integer $PhoneNumer
	 * @var integer $User_id
	 * @var integer $Unconfirmed
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return BokinUserprofile the static model class
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
		return 'bokin_userprofile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SSN, ImageUrl, PhoneNumer, User_id', 'required'),
			array('PhoneNumer, User_id, Unconfirmed', 'numerical', 'integerOnly'=>true),
			array('SSN, ImageUrl', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, SSN, ImageUrl, PhoneNumer, User_id, Unconfirmed', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'SSN' => 'Ssn',
			'ImageUrl' => 'Image Url',
			'PhoneNumer' => 'Phone Numer',
			'User_id' => 'User',
			'Unconfirmed' => 'Unconfirmed',
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

		$criteria->compare('SSN',$this->SSN,true);

		$criteria->compare('ImageUrl',$this->ImageUrl,true);

		$criteria->compare('PhoneNumer',$this->PhoneNumer);

		$criteria->compare('User_id',$this->User_id);

		$criteria->compare('Unconfirmed',$this->Unconfirmed);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}