<?php echo $this->Html->link(
    'Sign Up',
    array('controller' => 'member', 'action' => 'add')
); ?>
<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'member', 'action' => 'index'),
    'id' => 'memberlogin',
	'hiddenField'=>false
));
?>


<table>

	<tbody>
		<tr>
			<td>Email Address</td>
			<td>:</td>
			<td>
				<?php echo $this->Form->input('Member.email', array('label'=>false, 'div'=>false, 'error'=>false, 'type'=>'email', 'required'=>true)); ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:</td>
			<td>
				<?php echo $this->Form->input('Member.password', array('label'=>false,'id'=>'password', 'div'=>false, 'error'=>false, 'type'=>'password', 'required'=>true)); ?>
			</td>
		</tr>
		<tr>
			<td colspan='3' align='center'><?php echo $this->Form->end('Sign In');  ?></td>
		</tr>
	</tbody>
	
</table>