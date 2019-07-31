<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'member', 'action' => 'add'),
    'id' => 'memberadd',
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
    'Login',
    array('controller' => 'member', 'action' => 'index')
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
			<?php echo $this->Form->input('Member.email', array('label'=>false, 'div'=>false, 'error'=>false, 'type'=>'email', 'required'=>true)); ?>
		</td>
	</tr>
	
	<tr>
		<td>Password</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Member.password', array('label'=>false,'id'=>'password', 'div'=>false, 'error'=>false, 'type'=>'password', 'required'=>true, 'value'=>'')); ?>
		</td>
	</tr>
	
	<tr>
		<td>Confirm Password</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Member.confirm_password', array('label'=>false, 'id'=>'conf-password', 'div'=>false, 'error'=>false, 'type'=>'password', 'required'=>true, 'value'=>'')); ?>
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
		?>
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'><?php echo $this->Form->end($options);  ?></td>
	</tr>
</table>

<script>
	function formvalidate()
	{
		/*var flag = false;*/
		var password = $("#password").val();
		var conf_password = $("#conf-password").val();
		var checkbox_count = $(".custom-class").find(":checkbox:checked").length;
		var err_password = '';
		var err_count = '';
		var err_msg = '';
		var separator = '<br/>';
		
		if(password != conf_password)
		{
			err_password = 'Password Mismatch Occur.' + separator;
		}
		else
		{
			err_password = '';
		}
		
		if(checkbox_count == 0)
		{
			err_count = 'Please select atleast one hobby.' + separator;
		}
		else
		{
			err_count = '';
		}
		
		err_msg = err_password + err_count;
		
		if(err_msg == '')
		{
			$("#memberadd").submit();
		}
		else
		{
			$(".modal-body").html(err_msg);
			$("#myModal").modal();
		}
		
	}
	
</script>