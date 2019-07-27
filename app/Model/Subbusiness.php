<?php
class Subbusiness extends AppModel
{
	public $useTable = 'subbusiness_units';
	public $order = 'Subbusiness.id DESC';
	
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