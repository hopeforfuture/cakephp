<?php
class BlogsController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
		$this->loadModel('Blog');
	}
	
	public function index()
	{
		$blogs = $this->Blog->find('all');
		$this->set('blogs', $blogs);
	}
	
	public function add()
	{
		if($this->request->is('post'))
		{
			$tmp_name = '';
			foreach($this->request->data['Blog'] as $key=>$val)
			{
				if(is_array($val))
				{
					$this->request->data['Blog'][$key] = $val['name'];
					$tmp_name = $val['tmp_name'];
				}
				else
				{
					$this->request->data['Blog'][$key] = trim($val);
				}
			}
			
			$this->Blog->set($this->request->data);
			
			if($this->Blog->validates())
			{
				$upload_dir = WWW_ROOT."uploads";
				
				$fileinfo = pathinfo($this->request->data['Blog']['thumb']);
				
				$upload_filename = time().".".$fileinfo['extension'];
				
				$upload_path = $upload_dir.DS.$upload_filename;
				
				if(move_uploaded_file($tmp_name, $upload_path))
				{
					$this->request->data['Blog']['thumb'] = $upload_filename;
				}
				$this->request->data['Blog']['created'] = date('Y-m-d H:i:s', time());
				$this->Blog->create();
				$this->Blog->save($this->request->data);
				$this->Flash->success(__('Your blog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			else
			{
				$errors = $this->Blog->validationErrors;
				$this->set('errors', $errors);
			}
			
		}
	}
	
	public function edit($id = null)
	{
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid blog'));
		}
		
		$blog = $this->Blog->findById($id);
		
		
		if (!$blog) 
		{
			throw new NotFoundException(__('Invalid blog'));
		}
		
		$upload_dir = WWW_ROOT."uploads";
		
		if ($this->request->is(array('post', 'put')))
		{
			/* Used as form validate flag */
			$flag = false;
			$this->Blog->id = $id;
			$tmp_name = '';
			
			foreach($this->request->data['Blog'] as $key=>$val)
			{
				/* This is for file field */
				if(is_array($val))
				{
					/* If new file is uploaded then store new file name in array */
					if(!empty($val['tmp_name']))
					{
						$this->request->data['Blog'][$key] = trim($val['name']);
						$tmp_name = trim($val['tmp_name']);
					}
					/* Otherwise remove the field from array since this is file field and posted as array of values */
					else
					{
						unset($this->request->data['Blog'][$key]);
					}
					
				}
				else
				{
					$this->request->data['Blog'][$key] = trim($val);
				}
			}
			
			$this->Blog->set($this->request->data);
			
			/* Check if file is uploaded or not */
			if(empty($tmp_name))
			{
				if ($this->Blog->validates(array('fieldList' => array('title', 'content'))))
				{
					$flag = true;
				}
			}
			else
			{
				if ($this->Blog->validates())
				{
					$flag = true;
				}
			}
			
			/* If form is validated */
			if($flag)
			{
				/* A new file is uploaded. So we will upload the new file and delete the existing one. */
				if(!empty($tmp_name))
				{
					$old_img_path = $upload_dir.DS.$blog['Blog']['thumb'];
					
					@unlink($old_img_path);
					
					$fileinfo = pathinfo($this->request->data['Blog']['thumb']);
				
					$upload_filename = time().".".$fileinfo['extension'];
				
					$upload_path = $upload_dir.DS.$upload_filename;
				
					if(move_uploaded_file($tmp_name, $upload_path))
					{
						$this->request->data['Blog']['thumb'] = $upload_filename;
					}
				}
				
				if ($this->Blog->save($this->request->data)) 
				{
					$this->Flash->success(__('Your blog has been updated.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			
			else
			{
				// didn't validate logic
				$errors = $this->Blog->validationErrors;
				$this->request->data['Blog']['id'] = $id;
				$this->request->data['Blog']['thumb'] = $blog['Blog']['thumb'];
				$this->set('errors', $errors);
			}
			
		}
		
		if (!$this->request->data) 
		{
			$this->request->data = $blog;
		}
	}
	
	
	public function remove($id = null)
	{
		if($this->request->is('get'))
		{
			$blog = $this->Blog->findById($id);
			
			$upload_dir = WWW_ROOT."uploads";
			
			$blog_img_path = $upload_dir.DS.$blog['Blog']['thumb'];
			
			@unlink($blog_img_path);
			
			if($this->Blog->delete($id))
			{
				$this->Flash->success(
					__('The blog has been deleted.')
				);
			}
			else
			{
				$this->Flash->error(
					__('The blog can not be deleted.')
				);
			}
			
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>