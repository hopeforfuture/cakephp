<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'admin', 'action' => 'index'),
    'id' => 'adminlogin',
	'hiddenField'=>false
));
?>


<table>
	<thead>
		<tr>
			<td colspan="3" align="center"><strong>Administrator Login</strong></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Username</td>
			<td>:</td>
			<td>
				<?php echo $this->Form->input('Admin.admin_username', array('label'=>false, 'div'=>false, 'error'=>false,  'required'=>true)); ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<?php echo $this->Form->input('Admin.admin_password', array('label'=>false,'id'=>'password', 'div'=>false, 'error'=>false, 'type'=>'password', 'required'=>true)); ?>
			</td>
		</tr>
		<tr>
			<td colspan='3' align='center'><?php echo $this->Form->end('Sign In');  ?></td>
		</tr>
	</tbody>
	
</table>