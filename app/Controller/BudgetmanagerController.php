<?php
class BudgetmanagerController extends AppController
{
	public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
    public $uses = array('Budget');
	
	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow();
	}
	
	public function index()
	{
		$budgets = $this->Budget->find('all');
		$this->set('budgetmanagers', $budgets);
	}
	
	public function add()
	{
		if($this->request->is('post'))
		{
			foreach($this->request->data['Budget'] as $key=>$val)
			{
				$this->request->data['Budget'][$key] = trim($val);
			}
			$this->request->data['Budget']['created'] = date('Y-m-d H:i:s', time());
			$this->Budget->create();
			if($this->Budget->save($this->request->data))
			{
				$this->Flash->success(__('Your budget manager has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
	
	public function edit($id = null)
	{
		if (!$id) 
		{
			throw new NotFoundException(__('Invalid budget manager'));
		}

		$budget = $this->Budget->findById($id);
		
		if (!$budget) 
		{
			throw new NotFoundException(__('Invalid budget'));
		}
		
		if ($this->request->is(array('post', 'put'))) 
		{
			foreach($this->request->data['Budget'] as $key=>$val)
			{
				$this->request->data['Budget'][$key] = trim($val);
			}
			
			$this->Budget->set($this->request->data);
			
			if ($this->Budget->validates())
			{
				$this->Budget->id = $id;
			
				if ($this->Budget->save($this->request->data)) 
				{
					$this->Flash->success(__('Your budget manager has been updated.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			
			else
			{
				// didn't validate logic
				$errors = $this->Budget->validationErrors;
				$this->request->data['Budget']['id'] = $id;
				$this->set('errors', $errors);
			}
			
		}

		if (!$this->request->data) 
		{
			$this->request->data = $budget;
		}
	}
	
	public function remove($id)
	{
		if($this->request->is('get'))
		{
			if($this->Budget->delete($id))
			{
				$this->Flash->success(
					__('The budget manager with id: %s has been deleted.', h($id))
				);
			}
			else
			{
				$this->Flash->error(
					__('The budget manager with id: %s could not be deleted.', h($id))
				);
			}
			
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>