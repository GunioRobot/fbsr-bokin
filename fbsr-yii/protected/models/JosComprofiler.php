<?php

/**
 * This is the model class for table "jos_comprofiler".
 */
class JosComprofiler extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'jos_comprofiler':
	 * @var integer $id
	 * @var integer $user_id
	 * @var string $firstname
	 * @var string $middlename
	 * @var string $lastname
	 * @var integer $hits
	 * @var string $message_last_sent
	 * @var integer $message_number_sent
	 * @var string $avatar
	 * @var integer $avatarapproved
	 * @var integer $approved
	 * @var integer $confirmed
	 * @var string $lastupdatedate
	 * @var string $registeripaddr
	 * @var string $cbactivation
	 * @var integer $banned
	 * @var string $banneddate
	 * @var string $unbanneddate
	 * @var integer $bannedby
	 * @var integer $unbannedby
	 * @var string $bannedreason
	 * @var integer $acceptedterms
	 * @var string $cb_pgenable
	 * @var string $cb_pgautopublish
	 * @var string $cb_pgautoapprove
	 * @var string $cb_pgshortgreeting
	 * @var string $cb_pgtotalquotasize
	 * @var string $cb_pgtotalquotaitems
	 * @var string $cb_pguploadsize
	 * @var string $cb_pgtotalitems
	 * @var string $cb_pgtotalsize
	 * @var string $cb_pglastupdate
	 * @var string $cb_pgaccessmode
	 * @var string $cb_pgdisplayformat
	 * @var string $cb_phpbbid
	 * @var string $cb_hopar
	 * @var string $cb_virkur
	 * @var string $cb_gsm
	 * @var string $cb_heimasimi
	 * @var string $cb_vinnusimi
	 * @var string $cb_netfang
	 * @var string $cb_heimili
	 * @var string $cb_postnumer
	 * @var string $cb_sveitarfelag
	 * @var string $cb_kennitala
	 * @var string $cb_bilprof
	 * @var string $cb_vinnuvelaprof
	 * @var string $cb_blodflokkur
	 * @var string $cb_land
	 * @var string $cb_heimilitvo
	 * @var string $cb_kyn
	 * @var integer $cb_latinn
	 * @var string $cb_inngenginn
	 * @var string $cb_fagnamskeid
	 * @var string $cb_kennslurettindi
	 * @var integer $cb_nylidi
	 * @var string $cb_postlisti
	 * @var string $cb_adalfundarbod
	 */
	const no_avatar= 'http://fbsr.is/components/com_comprofiler/plugin/language/default_language/images/tnnophoto.jpg';
	const pre_avatar='http://fbsr.is/images/comprofiler/';
	/**
	 * Returns the static model of the specified AR class.
	 * @return JosComprofiler the static model class
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
		return 'jos_comprofiler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id, hits, message_number_sent, avatarapproved, approved, confirmed, banned, bannedby, unbannedby, acceptedterms, cb_latinn, cb_nylidi', 'numerical', 'integerOnly'=>true),
			array('firstname, middlename, lastname', 'length', 'max'=>100),
			array('avatar, cb_pgenable, cb_pgautopublish, cb_pgautoapprove, cb_pgshortgreeting, cb_pgtotalquotasize, cb_pgtotalquotaitems, cb_pguploadsize, cb_pgtotalitems, cb_pgtotalsize, cb_pgaccessmode, cb_pgdisplayformat, cb_phpbbid, cb_virkur, cb_gsm, cb_heimasimi, cb_vinnusimi, cb_netfang, cb_heimili, cb_postnumer, cb_sveitarfelag, cb_kennitala, cb_blodflokkur, cb_land, cb_heimilitvo, cb_kyn, cb_postlisti, cb_adalfundarbod', 'length', 'max'=>255),
			array('registeripaddr, cbactivation', 'length', 'max'=>50),
			array('message_last_sent, lastupdatedate, banneddate, unbanneddate, bannedreason, cb_pglastupdate, cb_hopar, cb_bilprof, cb_vinnuvelaprof, cb_inngenginn, cb_fagnamskeid, cb_kennslurettindi', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, firstname, middlename, lastname, hits, message_last_sent, message_number_sent, avatar, avatarapproved, approved, confirmed, lastupdatedate, registeripaddr, cbactivation, banned, banneddate, unbanneddate, bannedby, unbannedby, bannedreason, acceptedterms, cb_pgenable, cb_pgautopublish, cb_pgautoapprove, cb_pgshortgreeting, cb_pgtotalquotasize, cb_pgtotalquotaitems, cb_pguploadsize, cb_pgtotalitems, cb_pgtotalsize, cb_pglastupdate, cb_pgaccessmode, cb_pgdisplayformat, cb_phpbbid, cb_hopar, cb_virkur, cb_gsm, cb_heimasimi, cb_vinnusimi, cb_netfang, cb_heimili, cb_postnumer, cb_sveitarfelag, cb_kennitala, cb_bilprof, cb_vinnuvelaprof, cb_blodflokkur, cb_land, cb_heimilitvo, cb_kyn, cb_latinn, cb_inngenginn, cb_fagnamskeid, cb_kennslurettindi, cb_nylidi, cb_postlisti, cb_adalfundarbod', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'hits' => 'Hits',
			'message_last_sent' => 'Message Last Sent',
			'message_number_sent' => 'Message Number Sent',
			'avatar' => 'Avatar',
			'avatarapproved' => 'Avatarapproved',
			'approved' => 'Approved',
			'confirmed' => 'Confirmed',
			'lastupdatedate' => 'Lastupdatedate',
			'registeripaddr' => 'Registeripaddr',
			'cbactivation' => 'Cbactivation',
			'banned' => 'Banned',
			'banneddate' => 'Banneddate',
			'unbanneddate' => 'Unbanneddate',
			'bannedby' => 'Bannedby',
			'unbannedby' => 'Unbannedby',
			'bannedreason' => 'Bannedreason',
			'acceptedterms' => 'Acceptedterms',
			'cb_pgenable' => 'Cb Pgenable',
			'cb_pgautopublish' => 'Cb Pgautopublish',
			'cb_pgautoapprove' => 'Cb Pgautoapprove',
			'cb_pgshortgreeting' => 'Cb Pgshortgreeting',
			'cb_pgtotalquotasize' => 'Cb Pgtotalquotasize',
			'cb_pgtotalquotaitems' => 'Cb Pgtotalquotaitems',
			'cb_pguploadsize' => 'Cb Pguploadsize',
			'cb_pgtotalitems' => 'Cb Pgtotalitems',
			'cb_pgtotalsize' => 'Cb Pgtotalsize',
			'cb_pglastupdate' => 'Cb Pglastupdate',
			'cb_pgaccessmode' => 'Cb Pgaccessmode',
			'cb_pgdisplayformat' => 'Cb Pgdisplayformat',
			'cb_phpbbid' => 'Cb Phpbbid',
			'cb_hopar' => 'Cb Hopar',
			'cb_virkur' => 'Cb Virkur',
			'cb_gsm' => 'Cb Gsm',
			'cb_heimasimi' => 'Cb Heimasimi',
			'cb_vinnusimi' => 'Cb Vinnusimi',
			'cb_netfang' => 'Cb Netfang',
			'cb_heimili' => 'Cb Heimili',
			'cb_postnumer' => 'Cb Postnumer',
			'cb_sveitarfelag' => 'Cb Sveitarfelag',
			'cb_kennitala' => 'Cb Kennitala',
			'cb_bilprof' => 'Cb Bilprof',
			'cb_vinnuvelaprof' => 'Cb Vinnuvelaprof',
			'cb_blodflokkur' => 'Cb Blodflokkur',
			'cb_land' => 'Cb Land',
			'cb_heimilitvo' => 'Cb Heimilitvo',
			'cb_kyn' => 'Cb Kyn',
			'cb_latinn' => 'Cb Latinn',
			'cb_inngenginn' => 'Cb Inngenginn',
			'cb_fagnamskeid' => 'Cb Fagnamskeid',
			'cb_kennslurettindi' => 'Cb Kennslurettindi',
			'cb_nylidi' => 'Cb Nylidi',
			'cb_postlisti' => 'Cb Postlisti',
			'cb_adalfundarbod' => 'Cb Adalfundarbod',
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

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('firstname',$this->firstname,true);

		$criteria->compare('middlename',$this->middlename,true);

		$criteria->compare('lastname',$this->lastname,true);

		$criteria->compare('hits',$this->hits);

		$criteria->compare('message_last_sent',$this->message_last_sent,true);

		$criteria->compare('message_number_sent',$this->message_number_sent);

		$criteria->compare('avatar',$this->avatar,true);

		$criteria->compare('avatarapproved',$this->avatarapproved);

		$criteria->compare('approved',$this->approved);

		$criteria->compare('confirmed',$this->confirmed);

		$criteria->compare('lastupdatedate',$this->lastupdatedate,true);

		$criteria->compare('registeripaddr',$this->registeripaddr,true);

		$criteria->compare('cbactivation',$this->cbactivation,true);

		$criteria->compare('banned',$this->banned);

		$criteria->compare('banneddate',$this->banneddate,true);

		$criteria->compare('unbanneddate',$this->unbanneddate,true);

		$criteria->compare('bannedby',$this->bannedby);

		$criteria->compare('unbannedby',$this->unbannedby);

		$criteria->compare('bannedreason',$this->bannedreason,true);

		$criteria->compare('acceptedterms',$this->acceptedterms);

		$criteria->compare('cb_pgenable',$this->cb_pgenable,true);

		$criteria->compare('cb_pgautopublish',$this->cb_pgautopublish,true);

		$criteria->compare('cb_pgautoapprove',$this->cb_pgautoapprove,true);

		$criteria->compare('cb_pgshortgreeting',$this->cb_pgshortgreeting,true);

		$criteria->compare('cb_pgtotalquotasize',$this->cb_pgtotalquotasize,true);

		$criteria->compare('cb_pgtotalquotaitems',$this->cb_pgtotalquotaitems,true);

		$criteria->compare('cb_pguploadsize',$this->cb_pguploadsize,true);

		$criteria->compare('cb_pgtotalitems',$this->cb_pgtotalitems,true);

		$criteria->compare('cb_pgtotalsize',$this->cb_pgtotalsize,true);

		$criteria->compare('cb_pglastupdate',$this->cb_pglastupdate,true);

		$criteria->compare('cb_pgaccessmode',$this->cb_pgaccessmode,true);

		$criteria->compare('cb_pgdisplayformat',$this->cb_pgdisplayformat,true);

		$criteria->compare('cb_phpbbid',$this->cb_phpbbid,true);

		$criteria->compare('cb_hopar',$this->cb_hopar,true);

		$criteria->compare('cb_virkur',$this->cb_virkur,true);

		$criteria->compare('cb_gsm',$this->cb_gsm,true);

		$criteria->compare('cb_heimasimi',$this->cb_heimasimi,true);

		$criteria->compare('cb_vinnusimi',$this->cb_vinnusimi,true);

		$criteria->compare('cb_netfang',$this->cb_netfang,true);

		$criteria->compare('cb_heimili',$this->cb_heimili,true);

		$criteria->compare('cb_postnumer',$this->cb_postnumer,true);

		$criteria->compare('cb_sveitarfelag',$this->cb_sveitarfelag,true);

		$criteria->compare('cb_kennitala',$this->cb_kennitala,true);

		$criteria->compare('cb_bilprof',$this->cb_bilprof,true);

		$criteria->compare('cb_vinnuvelaprof',$this->cb_vinnuvelaprof,true);

		$criteria->compare('cb_blodflokkur',$this->cb_blodflokkur,true);

		$criteria->compare('cb_land',$this->cb_land,true);

		$criteria->compare('cb_heimilitvo',$this->cb_heimilitvo,true);

		$criteria->compare('cb_kyn',$this->cb_kyn,true);

		$criteria->compare('cb_latinn',$this->cb_latinn);

		$criteria->compare('cb_inngenginn',$this->cb_inngenginn,true);

		$criteria->compare('cb_fagnamskeid',$this->cb_fagnamskeid,true);

		$criteria->compare('cb_kennslurettindi',$this->cb_kennslurettindi,true);

		$criteria->compare('cb_nylidi',$this->cb_nylidi);

		$criteria->compare('cb_postlisti',$this->cb_postlisti,true);

		$criteria->compare('cb_adalfundarbod',$this->cb_adalfundarbod,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}