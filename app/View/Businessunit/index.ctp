<?php echo $this->Html->link(
    'Add Business Unit',
    array('controller' => 'businessunit', 'action' => 'add')
); ?>

<table>
	<thead>
		<tr>
			<td colspan="6" align="center"><h1>Business Unit List</h1></td>
		</tr>
		<tr>
			<th>SI No.</th>
			<th>Name</th>
			<th>Budget Managers</th>
			<th>Subbusiness Units</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		if(empty($businessunits))
		{
			echo "<tr><td colspan='6' align='center'><h1>No data found.</h1></td></tr>";
		}
		else
		{
			$si_no = 1;
			
			foreach($businessunits as $bu)
			{
			?>
				<tr>
					<td><?php echo $si_no; ?></td>
					<td><?php echo $bu['name']; ?></td>
					<td><?php echo $bu['manager']; ?></td>
					<td><?php echo $bu['sub_unit']; ?></td>
					<td><?php echo $bu['created']; ?></td>
					<td>
					<?php 
					echo $this->Html->link(
						'Edit|',
						'/business/unit/edit/'.$bu['id']
					); 
					echo $this->Html->link(
						'Delete',
						'/business/unit/remove/'.$bu['id'],
						array('confirm' => 'Confirm delete?')
					);

					?>
					</td>
				</tr>
			<?php
				$si_no++;
			}
		}
		?>
	</tbody>
	
</table>