<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'blogs', 'action' => 'add'),
    'id' => 'blogadd',
	'type' => 'file'
));

?>
<table>
	<tr>
		<td colspan='3' align='center'>
		<?php echo $this->Html->link(
    'Back To List',
    array('controller' => 'blogs', 'action' => 'index')
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
		<td>Title</td>
		<td>:</td>
		<td>
			<?php echo $this->Form->input('Blog.title', array('label'=>false, 'div'=>false, 'error'=>false)); ?>
		</td>
	</tr>
	
	<tr>
		<td>Content</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Blog.content', array(
				'label'=>false,
				'div'=>false,
				'required'=>true,
				'error'=>false,
			));
		?>
		</td>
	</tr>
	
	<tr>
		<td>Thumb Image</td>
		<td>:</td>
		<td>
		<?php
			echo $this->Form->input('Blog.thumb', array(
				'label'=>false,
				'div'=>false,
				'error'=>false,
				'type'=>'file'
		));
		?>
		</td>
	</tr>
	
	<tr>
		<td colspan='3' align='center'><?php echo $this->Form->end('Save');  ?></td>
	</tr>
</table>