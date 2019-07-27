<?php
class Profile extends AppModel
{
	public $useTable = 'tblprofile';
	
	public $belongsTo = array(
        'Member' => array(
            'className' => 'Member',
            'foreignKey' => 'member_id'
        )
    );
	
	
	public $validate = array(
		'full_address' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Full address required.'
			)
		),
		
		'hobby' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Hobby required.'
			)
		),
		
		'food_habit' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Food habit required.'
			)
		),
		
		'smoking_habit' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Smoking habit required.'
			)
		),
		
		'drinking_habit' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Drinking habit required.'
			)
		),
		
		'profile_img' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image.'
			
		)
	);
}
?>