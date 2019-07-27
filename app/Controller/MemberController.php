<?php
class MemberController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->loadModel('Member');
		$this->loadModel('Hobby');
		$this->loadModel('Profile');
	}
	
	public function index()
	{
		$members = $this->Member->find('all', array('conditions'=>array('Member.is_active'=>'1')));
		$this->set('members', $members);
	}
}