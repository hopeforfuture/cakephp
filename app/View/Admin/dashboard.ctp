<?php echo $this->Html->link(
    'Logout',
    array('controller' => 'admin', 'action' => 'logout')
); ?>

<table>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><?php echo $username; ?></td>
	</tr>
	
</table>
