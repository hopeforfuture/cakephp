<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
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
				'rule' => 'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Email required.'
			),
			
			'email-true' => array(
				'rule' => array('email', true),
				'message' => 'Please supply a valid email address.'
			),
			
			'email-unique' => array(
				'rule' => 'isUnique',
				'message' => 'This email has already been taken.',
				'on'=>'create'
			)
		),
		
		'password' => array(
			'password-notBlank' => array(
				'rule' => 'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Password required.'
			),
			
			'password-length' => array(
				'rule' => array('lengthBetween', 6, 15),
				'message'=>'Password length should between 6 and 15.'
			)
			
		)
		
	);
	
	public function beforeSave($options = array()) 
	{
        if (!empty($this->data[$this->alias]['password'])) 
		{
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
	
	
}
?>