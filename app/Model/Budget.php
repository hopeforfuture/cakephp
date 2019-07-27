<?php
class Budget extends AppModel
{
	public $useTable = 'budget_managers';
	public $order = 'Budget.id DESC';
	
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Name required.'
			)
		)
		
	);
}
?>