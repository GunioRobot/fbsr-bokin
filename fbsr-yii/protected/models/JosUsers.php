<?php

class JosUsers extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'jos_users':
	 * @var integer $id
	 * @var string $name
	 * @var string $username
	 * @var string $email
	 * @var string $password
	 * @var string $usertype
	 * @var integer $block
	 * @var integer $sendEmail
	 * @var integer $gid
	 * @var string $registerDate
	 * @var string $lastvisitDate
	 * @var string $activation
	 * @var string $params
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return JosUsers the static model class
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
		return 'jos_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username, email', 'required'),
			array('name', 'length', 'max'=>50),
			array('username', 'length', 'max'=>25),
			array('email', 'length', 'max'=>100),
			//array('cb_gsm', 'integerOnly'=>true),
			//array('registerDate, lastvisitDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name,email', 'safe'),
			array('name, username, email', 'safe', 'on'=>'search'),
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
			'bokin_eventregistrations' => array(self::HAS_MANY, 'BokinEventregistration', 'User_id'),
			'jos_comprofilers' => array(self::HAS_ONE, 'JosComprofiler', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'name' => 'Name',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'usertype' => 'Usertype',
			'block' => 'Block',
			'sendEmail' => 'Send Email',
			'gid' => 'Gid',
			'registerDate' => 'Register Date',
			'lastvisitDate' => 'Lastvisit Date',
			'activation' => 'Activation',
			'params' => 'Params',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider('JosUsers', array(
			'criteria'=>$criteria,
		));
	}
}