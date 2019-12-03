<?php
class AjaxController extends AppController
{
	public $components = array('RequestHandler');
	public $uses = array('Comment','Blog');

	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index() {
		if($this->request->is('ajax')) {
			$data['msg'] = "Request received by ".$this->request->data['name'];
			echo json_encode($data);
			die;
		}
		
	}

	public function savecomment() {
		if($this->request->is('ajax')) {
			$postdata = $this->request->data;

			$commentdata['Comment'] = array(
				'name'=>$postdata['u_name'],
				'email'=>$postdata['u_email'],
				'comment'=>$postdata['u_comment'],
				'blog_id'=>$postdata['blog_id'],
				'created_at'=>date('Y-m-d H:i:s', time())
			);

			$this->Comment->create();
			$this->Comment->save($commentdata);

			echo json_encode(array('status'=>true));
			die;

		}
	}

	public function loadcomments() {
		if ($this->request->is('ajax')) {
			$blog_id = $this->request->data['blog_id'];
			$bloginfo = $this->Blog->findById($blog_id);
			$data = array();
			

			if(!empty($bloginfo['Comment'])) {
				$comments = $bloginfo['Comment'];
				foreach($comments as $comment) {
					$comment['created_at'] = date('F j,Y H:i:s', strtotime($comment['created_at']));
					$comment['comment'] = htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8');
					$data[] = $comment;
				}
			}

			echo json_encode(array('comments'=>$data));
			die;
		}
	}
}