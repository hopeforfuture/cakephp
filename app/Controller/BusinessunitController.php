<?php
class BusinessunitController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->loadModel('Business');
		$this->loadModel('Subbusiness');
		$this->loadModel('Budget');
	}
	
	public function getsubbusinessunits($business_sub_units=array())
	{
		$subbusiness = array();
		$sql_sub_business = '';
		$subbusiness_in_business = $this->Business->find('all',array('fields'=>array('Business.subbusiness_units_m')));
		$flag = false;
		if(!empty($subbusiness_in_business))
		{
			if(!empty($business_sub_units))
			{
				$flag = true;
			}
			foreach($subbusiness_in_business as $sib)
			{
				$subbusiness_arr = explode(",", $sib['Business']['subbusiness_units_m']);
				foreach($subbusiness_arr as $sa)
				{
					if($flag)
					{
						if(in_array($sa, $business_sub_units))
						{
							continue;
						}
					}
					array_push($subbusiness, $sa);
				}
			}
		}
		
		if(empty($subbusiness))
		{
			$result = $this->Subbusiness->find('all', array('fields'=>array('Subbusiness.id', 'Subbusiness.name')));
		}
		else
		{
			$cond = array(
				"NOT" => array(
					"Subbusiness.id" => $subbusiness
				)
			);
			
			$result = $this->Subbusiness->find('all', array(
													  'fields'=>array('Subbusiness.id', 'Subbusiness.name'),
													  'conditions'=>$cond
													  )
											  );
		}
		
		$subbusiness_arr = array();
		
		if(!empty($result))
		{
			foreach($result as $res)
			{
				$subbusiness_arr[$res['Subbusiness']['id']] = $res['Subbusiness']['name'];
			}
		}
		
		return $subbusiness_arr;
	}
	
	public function getbudgetmanagers()
	{
		$budget_managers = array();
		$results = $this->Budget->find('all', array('fields'=>array('Budget.id', 'Budget.name')));
		if(!empty($results))
		{
			foreach($results as $result)
			{
				$budget_managers[$result['Budget']['id']] = $result['Budget']['name'];
			}
		}
		
		return $budget_managers;
	}
	
	
	public function index()
	{
		$business_units = array();
		$sub_units = array();
		$managers = $this->getbudgetmanagers();
		$sub_business_units = $this->Subbusiness->find('all', array('fields'=>array('Subbusiness.id', 'Subbusiness.name')));
		foreach($sub_business_units as $sbu)
		{
			$sub_units[$sbu['Subbusiness']['id']] = $sbu['Subbusiness']['name'];
		}
		$results = $this->Business->find('all');
		if(!empty($results))
		{
			foreach($results as $result)
			{
				$business_unit_id = $result['Business']['id'];
				$business_unit_name = strip_tags($result['Business']['name']);
				$budget_managers_id = explode(",", $result['Business']['budget_m']);
				$sub_units_id = explode(",",$result['Business']['subbusiness_units_m']);
				$created = date('F j, Y H:i:s', strtotime($result['Business']['created']));
				
				foreach($budget_managers_id as $bm)
				{
					$budget_managers_name[] = $managers[$bm];
				}
				foreach($sub_units_id as $su)
				{
					$sub_units_name[] = $sub_units[$su];
				}
				
				$business_units[] = array('id'=>$business_unit_id, 'name'=>$business_unit_name, 'manager'=>implode(",", $budget_managers_name),
				                          'sub_unit'=>implode(",", $sub_units_name), 'created'=>$created);
										  
				$budget_managers_name = array();
				$sub_units_name = array();
			}
			

		}
		$this->set('businessunits', $business_units);
	}
	
	public function add()
	{
		$budget_managers = $this->getbudgetmanagers();
		$sub_units = $this->getsubbusinessunits();
		
		if($this->request->is('post'))
		{
			foreach($this->request->data['Business'] as $key=>$val)
			{
				
				if(is_array($val))
				{
					$this->request->data['Business'][$key] = implode(",", $val);
				}
				else
				{
					$this->request->data['Business'][$key] = trim($val);
				}
				
			}
			
			$this->Business->set($this->request->data);
			
			if($this->Business->validates())
			{
				$this->request->data['Business']['created'] = date('Y-m-d H:i:s', time());
				$this->Business->create();
				$this->Business->save($this->request->data);
				$this->Flash->success(__('Your business unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			else
			{
				$errors = $this->Business->validationErrors;
				$this->set('errors', $errors);
			}
		}
		
		$this->set('managers', $budget_managers);
		$this->set('units', $sub_units);
	}
	
	public function edit($id = null)
	{
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid business unit'));
		}

		$business = $this->Business->findById($id);
		
		/* Array of subbusiness units in business unit */
		$business_sub_units = explode(",", $business['Business']['subbusiness_units_m']);
		
		if (!$business) 
		{
			throw new NotFoundException(__('Invalid business unit'));
		}
		
		$budget_managers = $this->getbudgetmanagers();
		$sub_units = $this->getsubbusinessunits($business_sub_units);
		
		if ($this->request->is(array('post', 'put'))) 
		{
			foreach($this->request->data['Business'] as $key=>$val)
			{
				if(is_array($val))
				{
					$this->request->data['Business'][$key] = implode(",", $val);
				}
				else
				{
					$this->request->data['Business'][$key] = trim($val);
				}
			}
			
			$this->Business->set($this->request->data);
			
			if ($this->Business->validates())
			{
				$this->Business->id = $id;
			
				if ($this->Business->save($this->request->data)) 
				{
					$this->Flash->success(__('Your business unit has been updated.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			
			else
			{
				// didn't validate logic
				$errors = $this->Business->validationErrors;
				$this->request->data['Business']['id'] = $id;
				$this->set('managers', $budget_managers);
				$this->set('units', $sub_units);
				$this->set('errors', $errors);
			}
			
		}

		if (!$this->request->data) 
		{
			$this->request->data = $business;
			$this->set('managers', $budget_managers);
			$this->set('units', $sub_units);
		}
	}
	
	public function remove($id = null)
	{
		if($this->request->is('get'))
		{
			if($this->Business->delete($id))
			{
				$this->Flash->success(
					__('The business unit has been deleted.')
				);
			}
			else
			{
				$this->Flash->error(
					__('The business unit can not be deleted.')
				);
			}
			
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>