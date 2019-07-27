<?php
class Business extends AppModel
{
	public $useTable = 'business_units';
	public $order = 'Business.id DESC';
	
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Name required.'
			)
		),
		
		'budget_m' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Budget Manager required.'
			)
		),
		
		'subbusiness_units_m' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Subbusiness Unit required.'
			)
		)
		
	);
}
?>