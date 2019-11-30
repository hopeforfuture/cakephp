<?php
class Hobby extends AppModel
{
	public $useTable = 'tblhobby';
	public $order = 'Hobby.hobby_name ASC';

	public function gethobbies()
	{
		$hobbies = $this->find('all');
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
	
}
?>