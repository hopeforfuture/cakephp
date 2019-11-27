<?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'posts', 'action' => 'add')
); ?>

<table>
	<thead>
		<tr>
			<td colspan="5" align="center"><h1>Blog Posts</h1></td>
		</tr>
		<tr>
			<th>SI No.</th>
			<th>Title</th>
			<th>Content</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$si_no = 1;
		if(empty($posts))
		{
		?>
			<tr>
				<td colspan="5" align="center" style="color:red; font-weight:bold;">No data found.</td>
			</tr>
		<?php
		}
		else
		{
			foreach($posts as $post)
			{
			?>
			<tr>
				<td><?php echo $si_no; ?></td>
				<td><?php echo strip_tags(ucfirst($post['Post']['title'])); ?></td>
				<td><?php echo strip_tags(ucfirst($post['Post']['content'])); ?></td>
				<td>
					<?php echo date('F j,Y H:i:s', strtotime($post['Post']['created'])); ?>
				</td>
				<td>
					<?php 
					echo $this->Html->link(
						'Edit|',
						array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
					); 
					echo $this->Html->link(
						'Delete',
						array('controller' => 'posts', 'action' => 'remove', $post['Post']['id']),
						array('confirm' => 'Confirm delete?', 'class'=>'post_del')
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
