<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	
	public function authenticate()
	{
		$this->username = strtolower($this->username);
		$user = JosUsers::model()->find('lower(username)=:username', array(':username'=>$this->username));
		if($user===null) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} else {
			$db_secret=explode(':',$user->password);
			if (isset($db_secret[1])) {
				$salt=$db_secret[1];
				$salted=$this->password.$salt;
			} else {
				$salted=$this->password;
			}
			if($user->password!==md5($salted).":".$salt) {
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			} else {
	            $this->_id=$user->id;
	            $this->username=$user->username;
				$auth=Yii::app()->authManager;
				if ($user->usertype != 'Registered') {
                	if(!$auth->isAssigned('admin',$this->_id)) {
                		if($auth->assign('admin',$this->_id)) {
                    		Yii::app()->authManager->save();
						}
 					}
				}
    	        $this->errorCode=self::ERROR_NONE;
			}
		} 
		return !$this->errorCode;
	}
	
 	public function getId()
    {
        return $this->_id;
    }
	
}