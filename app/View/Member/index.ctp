<?php echo $this->Html->link(
    'Add Member',
    array('controller' => 'member', 'action' => 'add')
); ?>

<table>
	<thead>
		<tr>
			<td colspan="6" align="center"><h1>Member List</h1></td>
		</tr>
		<tr>
			<th>SI No.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Profile Image</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		if(empty($members))
		{
			echo "<tr><td colspan='6' align='center'><h1>No data found.</h1></td></tr>";
		}
		else
		{
			$si_no = 1;
			
			foreach($members as $member)
			{
				$src = empty($member['Profile']['profile_img']) ? 'avatar.png' : $member['Profile']['profile_img'];
			?>
				<tr>
					<td><?php echo $si_no; ?></td>
					<td><?php echo strip_tags($member['Member']['name']); ?></td>
					<td><?php echo $member['Member']['email']; ?></td>
					<td>
						<img src="<?php echo $this->webroot."avatar/".$src; ?>" width="120" height="80" alt="No image available" />
					</td>
					<td><?php echo date('F j,Y H:i:s', strtotime($member['Member']['created'])); ?></td>
					<td>
					<?php
					echo $this->Html->link(
						'View|',
						'/member/view/'.$member['Member']['id']
					); 
					echo $this->Html->link(
						'Edit|',
						'/member/edit/'.$member['Member']['id']
					); 
					echo $this->Html->link(
						'Delete',
						'/member/remove/'.$member['Member']['id'],
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