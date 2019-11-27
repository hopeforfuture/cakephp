<?php
class AjaxController extends AppController
{
	public $components = array('RequestHandler');

	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index()
	{
		if($this->request->is('ajax')) {
			$data['msg'] = "Request received by ".$this->request->data['name'];
			echo json_encode($data);
			die;
		}
		
	}
}