<?php
class Post extends AppModel
{
	public $useTable = 'posts';
	public $order = 'Post.id DESC';
	
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
		
	);
}
?>