<?php
class AjaxController extends AppController
{
	public $components = array('RequestHandler');

	public function index()
	{
		//$data = array('msg'=>'Request received');
		//echo json_encode($data);
		if($this->request->is('ajax')) {
			$data = array('msg'=>'Request received');
			echo json_encode($data);
			die;
		}
		
	}
}