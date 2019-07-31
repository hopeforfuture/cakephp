<?php
class AdminController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	public $uses = array('Admin');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		
		$this->Auth->loginAction = array(
			'controller' => 'admin',
			'action' => 'index'
		);
		
		$this->Auth->loginRedirect = array(
			'controller' => 'admin',
			'action' => 'dashboard'
		);
		
		$this->Auth->logoutRedirect = array(
			'controller' => 'admin',
			'action' => 'index'
		);
		
		$this->Auth->authorize = array('Controller');
		
		$this->Auth->authenticate = array(
			'Form' => array(
			
				'userModel' => 'Admin',
				
				'passwordHasher' => array(
					'className' => 'Simple',
					'hashType' => 'md5'
				),
					
				'fields'=>array(
					'username'=>'admin_username',
					'password'=>'admin_password'
				)
				
			)
		);
		
		$this->Auth->allow('index');
		
	}
	
	public function index()
	{
		$this->set('title_for_layout', 'Administrator Login');
		if($this->Auth->user('admin_username'))
		{
			return $this->redirect($this->Auth->redirectUrl());
		}
		if($this->request->is('post'))
		{
			if($this->Auth->login())
			{
				return $this->redirect($this->Auth->redirectUrl());
			}
			
			$this->Flash->error(
				__('Username or password is incorrect')
			);
		}
		$this->render('login');
	}
	
	public function dashboard()
	{
		$this->set('title_for_layout', 'Administrator Dashboard');
		
		$id = $this->Auth->user('admin_id');
		if(empty($id))
		{
			return $this->redirect(array('action' => 'index'));
		}
		
		$name = $this->Auth->user('admin_name');
		$username = $this->Auth->user('admin_username');
		$this->set('id', $id);
		$this->set('name', $name);
		$this->set('username', $username);
	}
	
	public function logout() 
	{
		return $this->redirect($this->Auth->logout());
	}
}
?>