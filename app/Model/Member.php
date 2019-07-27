<?php
class Member extends AppModel
{
	public $useTable = 'tblmembers';
	public $order = 'Member.id DESC';
	
	public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'dependent' => true,
			'foreignKey' => 'member_id'
        )
    );
	
	public $validate = array(
		'name' => array(
			'name-notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Name required.'
			)
		),
		
		'email' => array(
			'email-notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Email required.'
			),
			
			'email-true' => array(
				'rule'=> array('email', true),
				'message' => 'Please supply a valid email address.'
			)
		),
		
		'password' => array(
			'password-notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Password required.'
			),
			
			'password-length' => array(
				'rule'=>array('lengthBetween', 6, 15),
				'message'=>'Password length should between 6 and 15.'
			),
			
			'passwords-match' => array(
                 'rule' => array('matchPasswords'),
                 'message' => 'Your passwords do not match!'
             )
		)
		
	);
	
	public function matchPasswords($data)
	{
      if ($data['password']==$this->data['Member']['confirm_password'])
	  {
          return true;
      }

      $this->invalidate('confirm_password','Your passwords do not match!');

      return false;
	}
	
}
?>