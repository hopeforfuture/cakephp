<?php
class Blog extends AppModel
{
	public $useTable = 'tblblog';
	public $order = 'Blog.id DESC';
	
	public $validate = array(
		'title' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Title required.'
			)
		),
		
		'content' => array(
			'notBlank' => array(
				'rule'=>'notBlank',
				'required'=>true,
				'allowEmpty'=>false,
				'message'=>'Content required.'
			)
		),
		
		'thumb' => array(
			'rule' => array(
				'extension',
				array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image.'
			
		)
		
	);
}
?>