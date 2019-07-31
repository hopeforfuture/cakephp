<?php echo $this->Html->link(
    'Logout',
    array('controller' => 'member', 'action' => 'logout')
); ?>

<table>
	<tr>
		<td>Name</td>
		<td>:</td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td>:</td>
		<td><?php echo $email; ?></td>
	</tr>
	<!--<tr>
		<td>Adress</td>
		<td>:</td>
		<td><?php echo $address; ?></td>
	</tr>-->
</table>
