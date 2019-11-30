<?php echo $this->Html->link(
    'Back',
    array('controller' => 'blogs', 'action' => 'index')
); 

echo $this->Html->link(
    'Add Comment',
    'Javascript:void(0);',
    array('class' => 'btn btn-info', 'id'=>'addcomment')
);

?>

<!-- Blog view start -->
<table>
	<tr>
		<td>Blog title</td>
		<td>:</td>
		<td>
			<?php echo $blog['Blog']['title']; ?>
		</td>
	</tr>
	<tr>
		<td valign="top">Blog content</td>
		<td>:</td>
		<td valign="top">
			<?php echo $blog['Blog']['content']; ?>
		</td>
	</tr>
	<tr>
		<td>Blog image</td>
		<td>:</td>
		<td>
			<img src="<?php echo $this->webroot.'uploads/'.$blog['Blog']['thumb']; ?>" width="120" height="80" alt="No image available">
		</td>
	</tr>
</table>
<!-- Blog view end -->

<!-- Modal start -->
<div class="modal fade" id="commentModal" role="dialog">
   <div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">

			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Add Comment</h4>
			</div>

			<div class="modal-body">

				<!-- Start add comment -->
			  	<table>

			  	   <tr>
				  		<td>Name</td>
				  		<td>:</td>
				  		<td>
				  			<?php echo $this->Form->text('name', array('name'=>'data[Comment][name]', 'value'=>'', 'required'=>true, 'class'=>'form-control')); ?>
				  		</td>
			  	   </tr>

			  	   <tr>
				  		<td>Email Address</td>
				  		<td>:</td>
				  		<td>
				  			<?php echo $this->Form->text('email', array('name'=>'data[Comment][email]', 'value'=>'', 'type'=>'email', 'required'=>true, 'class'=>'form-control')); ?>
				  		</td>
			  	   </tr>

			  	   <tr>
			  	   	  <td>Your comment</td>
			  	   	  <td>:</td>
			  	   	  <td>
			  	   	  	   <?php echo $this->Form->textarea('comment', array('name'=>'data[Comment][comment]', 'required'=>true, 'class'=>'form-control', 'value'=>'', 'rows'=>'5', 'cols'=>'10')); ?>
			  	   	  </td>
			  	   </tr>

			  	   <tr>
			  	   	  <td colspan="3" align="center" style="padding-left: 210px;">
			  	   	  	<?php echo $this->Form->hidden('blog_id', array('name'=>'data[Comment][blog_id]', 'value'=>$blog['Blog']['id'])); ?>
			  	   	  	<?php echo $this->Form->button('Save', array('type'=>'button', 'id'=>'btnSave', 'class'=>'btn btn-info')); ?>
			  	   	  </td>
			  	   </tr>

			  	</table>
			  	<!-- End add comment -->

			</div>

			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>

		  </div>
	</div>
</div>
<!-- Modal end -->

 <script type="text/javascript">
  	$(document).ready(function(){

  	  $("body").on("click", "#addcomment", function(){
  	  	  $("#commentModal .form-control").val('');
  	  	  $("#commentModal").modal();
  	  });
  		
  	});
 </script>