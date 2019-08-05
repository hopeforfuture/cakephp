<?php echo $this->Html->link(
    'Logout',
    array('controller' => 'member', 'action' => 'logout')
); ?>&nbsp;
<?php echo $this->Html->link(
    'Edit',
    array('controller' => 'member', 'action' => 'edit')
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
	<tr>
		<td>Adress</td>
		<td>:</td>
		<td><?php echo $address; ?></td>
	</tr>
	<tr>
		<td>Hobby</td>
		<td>:</td>
		<td><?php echo $hobby; ?></td>
	</tr>
	<tr>
		<td>Food Habit</td>
		<td>:</td>
		<td><?php echo $food_habit; ?></td>
	</tr>
	<tr>
		<td>Smoking Habit</td>
		<td>:</td>
		<td><?php echo $smoking_habit; ?></td>
	</tr>
	<tr>
		<td>Drinking Habit</td>
		<td>:</td>
		<td><?php echo $drinking_habit; ?></td>
	</tr>
	<tr>
		<td>Profile Image</td>
		<td>:</td>
		<td><img src="<?php echo $this->webroot."avatar/".$avatar; ?>" width="120" height="80" alt="No image available" /> </td>
	</tr>
</table>
