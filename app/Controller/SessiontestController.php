<?php
class SessiontestController extends AppController
{
	
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash', 'Session');
 	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function setSession()
	{
		$data = array(
			'name'=>'Manojit Nandi',
			'email'=>'mnbl87@gmail.com',
			'phone'=>'9230459769'
		);

		$this->Session->write('User.info', $data);
		return $this->redirect(array('action' => 'getSession'));
	}

	public function getSession()
	{
		$userinfo = $this->Session->consume('User.info');
		$userinfokeys = is_array($userinfo)?array_keys($userinfo):[];
		$inserteddata = array();
		if(!empty($userinfokeys)) {
			foreach ($userinfokeys as $key) {
				$inserteddata['User'][$key] = $userinfo[$key];
			}
		}
		echo "<pre>";
		print_r($inserteddata);
		die;
	}
}