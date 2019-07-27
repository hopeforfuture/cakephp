<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'budgetmanager', 'action' => 'add'),
    'id' => 'budgetmanageradd'
));
?>
<table>
	<tr>
		<td colspan='3' align='center'>
		<?php echo $this->Html->link(
    'Back To List',
    array('controller' => 'budgetmanager', 'action' => 'index')
		); ?>
		</td>
	</tr>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Budget.name', array('label'=>false, 'div'=>false)); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'><?php echo $this->Form->end('Save');  ?></td>
	</tr>
</table>