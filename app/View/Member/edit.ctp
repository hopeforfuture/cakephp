<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'member', 'action' => 'edit'),
    'id' => 'memberedit',
	'onsubmit'=>'formvalidate();return false',
	'type' => 'file'
));

$options = array(
    'label' => 'Save',
    'id'=>'btnSubmit'
);

//$hobby_check = array(1,3);

$member_hobbies = empty($this->request->data['Profile']['hobby']) ? array() : explode(",", $this->request->data['Profile']['hobby']);

?>
<table>
	<tr>
		<td colspan='3' align='center'>
		<?php echo $this->Html->link(
    'Back To Dashboard',
    array('controller' => 'member', 'action' => 'dashboard')
		); ?>
		</td>
	</tr>
	<?php
	if(isset($errors_member) || isset($errors_profile))
	{
		echo "<tr>";
		echo "<td colspan='3' align='center'>";
		
		if(!empty($errors_member))
		{
			foreach($errors_member as $error)
			{
				echo "<p style='color:red;font-weight:bold;'>".$error[0]."</p>";
			}
		}
		
		if(!empty($errors_profile))
		{
			foreach($errors_profile as $error)
			{
				echo "<p style='color:red;font-weight:bold;'>".$error[0]."</p>";
			}
		}
		
		echo "</td>";
		echo "</tr>";
	}
	?>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Member.name', array('label'=>false, 'div'=>false, 'error'=>false, 'required'=>true)); ?>
		</td>
	</tr>
	
	<tr>
		<td>Email</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Member.email', array('label'=>false, 'div'=>false, 'error'=>false, 'type'=>'email', 'required'=>true, 'readonly'=>true)); ?>
		</td>
	</tr>
	
	<tr>
		<td>Complete Address</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Profile.full_address', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'type'=>'textarea',
				'required'=>true
		));
		?>
		</td>
	</tr>
	
	<tr>
		<td>Hobby</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Profile.hobby', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'required'=>true,
				'hiddenField' => false,
				'multiple' => 'checkbox',
				'options'=>$hobbies,
				'class'=>'custom-class',
				'selected' => $member_hobbies
		));
		/*foreach($hobbies as $key=>$label)
		{
			$checkbox_id = "ProfileHobby".$key;
			if(in_array($key, $hobby_check))
			{
				$checked = true;
			}
			else
			{
				$checked = false;
			}
			echo $this->Form->checkbox('Profile.hobby', array('hiddenField' => false, 'value'=>$key, 'id'=>$checkbox_id, 'name'=>'data[Profile][hobby][]', 'checked'=>$checked));
			echo $this->Form->label($checkbox_id, $label, 'highlight');
		}*/
		?>
		</td>
	</tr>
	
	<tr>
		<td>Food Habit</td>
		<td>:</td>
		<td>
			<?php
			echo $this->Form->input('Profile.food_habit', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'empty'=>'---Select---',
				'required'=>true,
				'hiddenField' => false,
				'options'=>$food_habits,
				'class'=>'custom-class',
				//'selected' => 'NV'
		));
			?>
		</td>
	</tr>
	
	<tr>
		<td>Smoking Habit</td>
		<td>:</td>
		<td>
			<?php
			echo $this->Form->input('Profile.smoking_habit', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'empty'=>'---Select---',
				'required'=>true,
				'hiddenField' => false,
				'options'=>$smoking_habits,
				'class'=>'custom-class',
				//'selected' => 'NV'
		));
			?>
		</td>
	</tr>
	
	
	<tr>
		<td>Drinking Habit</td>
		<td>:</td>
		<td>
			<?php
			echo $this->Form->input('Profile.drinking_habit', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'empty'=>'---Select---',
				'required'=>true,
				'hiddenField' => false,
				'options'=>$drinking_habits,
				'class'=>'custom-class',
				//'selected' => 'NV'
		));
			?>
		</td>
	</tr>
	
	<tr>
		<td>Thumb Image</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Profile.profile_img', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'type'=>'file',
				'required'=>false
		));
		?><br/>
		<img src="<?php echo $this->webroot."avatar/".$this->request->data['Profile']['profile_img']; ?>" width="120" height="80" />
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'>
			<?php echo $this->Form->hidden('Profile.old_img', array('value'=>$this->request->data['Profile']['profile_img'])); ?>
			<?php echo $this->Form->end($options);  ?>
		</td>
	</tr>
</table>

<script>
	function formvalidate()
	{
		
		var checkbox_count = $(".custom-class").find(":checkbox:checked").length;
		var err_count = '';
		
		if(checkbox_count == 0)
		{
			err_count = 'Please select atleast one hobby.';
		}
		else
		{
			err_count = '';
		}
		
		if(err_count.length > 0)
		{
			$(".modal-body").html(err_count);
			$("#myModal").modal();
		}
		else
		{
			$("#memberedit").submit();
		}
	}
	
</script>