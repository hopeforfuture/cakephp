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
		$this->Auth->allow(array('add', 'index'));
	}
	
	public function gethobbies()
	{
		$hobbies = $this->Hobby->find('all');
		$hobbyarr = array();
		
		if(!empty($hobbies))
		{
			foreach($hobbies as $hobby)
			{
				$id = $hobby['Hobby']['id'];
				$name = $hobby['Hobby']['hobby_name'];
				$hobbyarr[$id] = $name;
			}
		}
		
		
		return $hobbyarr;
	}
	
	public function index()
	{
		/*$members = $this->Member->find('all', array('conditions'=>array('Member.is_active'=>'1')));
		$this->set('members', $members);*/
		if($this->Auth->user('id'))
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
	
	public function add()
	{
		if($this->Auth->user('id'))
		{
			return $this->redirect($this->Auth->redirectUrl());
		}
		
		$food_habits = array('V'=>'Vegeterian', 'NV'=>'Non Vegeterian', 'E'=>'Eggiterian');
		$smoking_habits = array('NS'=>'Non Smoker', 'RS'=>'Regular Smoker', 'OS'=>'Occational Smoker');
		$drinking_habits = array('ND'=>'Non Drinker', 'RD'=>'Regular Drinker', 'SD'=>'Social Drinker');
		$hobbies = $this->gethobbies();
		
		if($this->request->is('post'))
		{
			$tmp_name = '';
			
			foreach($this->request->data['Member'] as $key=>$val)
			{
				if($key == 'confirm_password')
				{
					unset($this->request->data['Member'][$key]);
				}
				else
				{
					$this->request->data['Member'][$key] = trim($val);
				}
			}
			
			foreach($this->request->data['Profile'] as $key=>$val)
			{
				if(is_array($val))
				{
					if($key == 'hobby')
					{
						$this->request->data['Profile'][$key] = implode(",",$val);
					}
					elseif($key == 'profile_img')
					{
						if(!empty($val['tmp_name']))
						{
							$tmp_name = $val['tmp_name'];
							$this->request->data['Profile'][$key] = trim($val['name']);
						}
						else
						{
							unset($this->request->data['Profile'][$key]);
						}
					}
				}
				else
				{
					$this->request->data['Profile'][$key] = trim($val);
				}
			}
			
			$profile_fields = array('full_address', 'hobby', 'food_habit', 'smoking_habit', 'drinking_habit');
			
			if(!empty($tmp_name))
			{
				array_push($profile_fields, 'profile_img');
			}
			
			$this->Member->set($this->request->data);
			$this->Profile->set($this->request->data);
			
			$flag_member =  $this->Member->validates();
			$flag_profile = $this->Profile->validates(array('fieldList'=>$profile_fields));
			
			if($flag_member && $flag_profile)
			{
				$created = date('Y-m-d H:i:s', time());
				$this->request->data['Member']['created'] = $created;
				
				$upload_filename = '';
				
				if(!empty($tmp_name))
				{
					$upload_dir = WWW_ROOT."avatar";
				
					$fileinfo = pathinfo($this->request->data['Profile']['profile_img']);
					
					$upload_filename = time().".".$fileinfo['extension'];
					
					$upload_path = $upload_dir.DS.$upload_filename;
					
					if(move_uploaded_file($tmp_name, $upload_path))
					{
						$this->request->data['Profile']['profile_img'] = $upload_filename;
					}
				}
				
				$this->Member->clear();
				$this->Profile->clear();
				
				try
				{
					$this->Member->create();
					$this->Member->save($this->request->data);
					$this->request->data['Profile']['member_id'] = $this->Member->id;
					$this->Member->Profile->save($this->request->data);
					
				}catch(Exception $ex)
				{
					var_dump($ex);
					die;
				}
				
				$this->request->data['Member'] = array_merge(
					$this->request->data['Member'],
					array('id' => $this->Member->id)
				);
				unset($this->request->data['Member']['password']);
				$this->Auth->login($this->request->data['Member']);
				
				$this->Flash->success(__('Your profile has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			else
			{
				$errors_member = $this->Member->validationErrors;
				$errors_profile = $this->Profile->validationErrors;
				$this->set('errors_member', $errors_member);
				$this->set('errors_profile', $errors_profile);
				
			}
			
		}
		
		$this->set('food_habits', $food_habits);
		$this->set('smoking_habits', $smoking_habits);
		$this->set('drinking_habits', $drinking_habits);
		$this->set('hobbies', $hobbies);
	}
	
	public function dashboard()
	{
		$id = $this->Auth->user('id');
		if(empty($id))
		{
			return $this->redirect(array('action'=>'index'));
		}
		$name = $this->Auth->user('name');
		$email = $this->Auth->user('email');
		$full_address = $this->Auth->user('full_address');
		$this->set('name', $name);
		$this->set('email', $email);
		$this->set('address', $full_address);
	}
	
	public function logout() 
	{
		return $this->redirect($this->Auth->logout());
	}
}
?> 