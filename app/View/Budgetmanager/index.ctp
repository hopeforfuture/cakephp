<?php echo $this->Html->link(
    'Add Budget Manager',
    array('controller' => 'budgetmanager', 'action' => 'add')
); ?>

<table>
	<thead>
		<tr>
			<td colspan="4" align="center"><h1>Budget Managers List</h1></td>
		</tr>
		<tr>
			<th>SI No.</th>
			<th>Name</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		if(empty($budgetmanagers))
		{
			echo "<tr><td colspan='4' align='center'><h1>No data found.</h1></td></tr>";
		}
		else
		{
			$si_no = 1;
			
			foreach($budgetmanagers as $bm)
			{
			?>
				<tr>
					<td><?php echo $si_no; ?></td>
					<td><?php echo strip_tags($bm['Budget']['name']); ?></td>
					<td><?php echo date('F j,Y H:i:s', strtotime($bm['Budget']['created'])); ?></td>
					<td>
					<?php 
					echo $this->Html->link(
						'Edit|',
						'/budget/manager/edit/'.$bm['Budget']['id']
					); 
					echo $this->Html->link(
						'Delete',
						'/budget/manager/remove/'.$bm['Budget']['id'],
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