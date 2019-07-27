<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'budgetmanager', 'action' => 'edit', $this->request->data['Budget']['id']),
    'id' => 'budgetmanageredit'
));
$name = $this->request->data['Budget']['name'];
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
	
	<?php
	if(isset($errors))
	{
	?>
	   <tr>
		  <td colspan="3" align="center">
			<?php
			foreach($errors as $error)
			{
				echo "<p style='color:red;font-weight:bold;'>".$error[0]."</p>";
			}
			?>
		  </td>
	   </tr>
	<?php
	}
	?>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Budget.name', array('label'=>false, 'div'=>false, 'value'=>$name, 'error'=>false)); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'><?php echo $this->Form->end('Save');  ?></td>
	</tr>
</table>