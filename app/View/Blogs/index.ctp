<?php echo $this->Html->link(
    'Add Blog',
    array('controller' => 'blogs', 'action' => 'add')
); ?>

<table>
	<thead>
		<tr>
			<td colspan="6" align="center"><h1>Blog List</h1></td>
		</tr>
		<tr>
			<th>SI No.</th>
			<th>Title</th>
			<th>Content</th>
			<th>Thumb</th>
			<th>Created</th>
			<th>Action</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		if(empty($blogs))
		{
			echo "<tr><td colspan='6' align='center'><h1>No data found.</h1></td></tr>";
		}
		else
		{
			$si_no = 1;
			
			foreach($blogs as $blog)
			{
			?>
				<tr>
					<td><?php echo $si_no; ?></td>
					<td><?php echo strip_tags($blog['Blog']['title']); ?></td>
					<td><?php echo strip_tags($blog['Blog']['content']); ?></td>
					<td>
						<img src="<?php echo $this->webroot."uploads/".$blog['Blog']['thumb']; ?>" width="120" height="80" alt="No image available" />
					</td>
					<td><?php echo date('F j,Y H:i:s', strtotime($blog['Blog']['created'])); ?></td>
					<td>
					<?php 
					echo $this->Html->link(
						'Edit|',
						'/blogs/edit/'.$blog['Blog']['id']
					); 
					echo $this->Html->link(
						'Delete',
						'/blogs/remove/'.$blog['Blog']['id'],
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

<input type="hidden" id="baseurl" value="<?php echo  Router::url('/', true); ?>" />

<script type="text/javascript">
	$(document).ready(function(){

		var targeturl =  "/cakephp/getdata";

		$.ajax({
			type: "post",
			url: targeturl,
			data: {name:'Manojit',email:'test@gmail.com'},
			dataType: "json",
			success: function(data) {
				console.log(data.msg);
			}
		});

	})
</script>