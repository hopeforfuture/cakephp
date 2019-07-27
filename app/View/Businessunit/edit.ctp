<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'businessunit', 'action' => 'edit', $this->request->data['Business']['id']),
    'id' => 'businessunitedit'
));
$business_unit_name = $this->request->data['Business']['name'];
$select_managers = empty($this->request->data['Business']['budget_m']) ? array() : explode(",", $this->request->data['Business']['budget_m']);
$select_units = empty($this->request->data['Business']['subbusiness_units_m']) ? array() : explode(",", $this->request->data['Business']['subbusiness_units_m']);
?>
<table>
	<tr>
		<td colspan='3' align='center'>
		<?php echo $this->Html->link(
    'Back To List',
    array('controller' => 'businessunit', 'action' => 'index')
		); ?>
		</td>
	</tr>
	
	<?php
	if(isset($errors))
	{
		echo "<tr>";
		echo "<td colspan='3' align='center'>";
		foreach($errors as $error)
		{
			echo "<p style='color:red;font-weight:bold;'>".$error[0]."</p>";
		}
		echo "</td>";
		echo "</tr>";
	}
	?>
	
	<tr>
		<td>Name</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Business.name', array('label'=>false, 'div'=>false, 'error'=>false, 'value'=>$business_unit_name)); ?>
		</td>
	</tr>
	
	<tr>
		<td>Budget Manager</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Business.budget_m', array(
    'options' => $managers,
    'empty' => 'Select Budget Manager',
	'multiple'=>true,
	'label'=>false,
	'div'=>false,
	'hiddenField' => false,
	'required'=>true,
	'error'=>false,
	'selected'=>$select_managers
		));
		?>
		</td>
	</tr>
	
	<tr>
		<td>Subbusiness Units</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Business.subbusiness_units_m', array(
    'options' => $units,
    'empty' => 'Select Subbusiness Unit',
	'multiple'=>true,
	'label'=>false,
	'div'=>false,
	'hiddenField' => false,
	'required'=>true,
	'error'=>false,
	'selected'=>$select_units
		));
		?>
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'><?php echo $this->Form->end('Save');  ?></td>
	</tr>
</table>