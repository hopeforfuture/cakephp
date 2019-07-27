<?php echo $this->Form->create('Post'); ?>
<table>
	<tr>
		<td colspan="3" align="center">
		<?php echo $this->Html->link(
    'Back To List',
    array('controller' => 'posts', 'action' => 'index')
); ?>
		</td>
	</tr>
	
	<?php
	$title_val = empty($this->request->data['Post']['title']) ? '' : $this->request->data['Post']['title'];
	$content_val = empty($this->request->data['Post']['content']) ? '' : $this->request->data['Post']['content'];
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
		<td>Title</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('title', array('label'=>false,  'maxlength'=>false, 'required'=>true, 'error'=>false)); ?>
		</td>
	</tr>
	<tr>
		<td>Body</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('content', array('label'=>false,  'rows'=>3, 'maxlength'=>false, 'required'=>true, 'error'=>false)); ?>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<?php
			echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->end('Save Post'); 
		?>
		</td>
	</tr>
</table>