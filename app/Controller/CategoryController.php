<?php
class CategoryController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	public $uses = array('Admin');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		if(!$this->Auth->user('admin_id'))
		{
			return $this->redirect(array('controller'=>'admin','action'=>'index'));
		}
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'Administrator Category Page');
		echo 'In administrator category page<br/>';
		print(AuthComponent::user('admin_id'));
		echo '<pre>';
		print_r($this->Auth->user());
		//print_r($this->Session->read());
		die;
	}
	
}
?>