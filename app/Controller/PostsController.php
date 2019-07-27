<?php
class PostsController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		//$this->loadModel('Post');
	}
	
	public function index()
	{
		$posts = $this->Post->find('all');
		$this->set('posts', $posts);
	}
	
	public function add()
	{
		if($this->request->is('post'))
		{
			foreach($this->request->data['Post'] as $key=>$val)
			{
				$this->request->data['Post'][$key] = trim($val);
			}
			$this->Post->set($this->request->data);
			
			if ($this->Post->validates()) 
			{
				$this->request->data['Post']['created'] = date('Y-m-d H:i:s', time());
				$this->Post->create();
				if($this->Post->save($this->request->data))
				{
					$this->Flash->success(__('Your post has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
			} 
			else 
			{
				// didn't validate logic
				$errors = $this->Post->validationErrors;
				$this->set('errors', $errors);
				//$this->Flash->error(__('Unable to add your post.'));
			}
			
		}
	}
	
	public function edit($id = null)
	{
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		
		if (!$post) 
		{
			throw new NotFoundException(__('Invalid post'));
		}

		if ($this->request->is(array('post', 'put'))) 
		{
			foreach($this->request->data['Post'] as $key=>$val)
			{
				$this->request->data['Post'][$key] = trim($val);
			}
			
			$this->Post->set($this->request->data);
			
			if ($this->Post->validates())
			{
				$this->Post->id = $id;
			
				if ($this->Post->save($this->request->data)) 
				{
					$this->Flash->success(__('Your post has been updated.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			
			else
			{
				// didn't validate logic
				$errors = $this->Post->validationErrors;
				$this->set('errors', $errors);
			}
			
		}

		if (!$this->request->data) 
		{
			$this->request->data = $post;
		}
	}
	
	public function remove($id)
	{
		if($this->request->is('get'))
		{
			if($this->Post->delete($id))
			{
				$this->Flash->success(
					__('The post with id: %s has been deleted.', h($id))
				);
			}
			else
			{
				$this->Flash->error(
					__('The post with id: %s could not be deleted.', h($id))
				);
			}
			
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>