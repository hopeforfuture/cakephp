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
				  		<!--<td><span id="errname" class="errmsg" style="font-weight: bold;color: red;display: none;">Name Requred</span></td>-->
			  	   </tr>

			  	   <tr>
				  		<td>Email Address</td>
				  		<td>:</td>
				  		<td>
				  			<?php echo $this->Form->text('email', array('name'=>'data[Comment][email]', 'value'=>'', 'type'=>'email', 'required'=>true, 'class'=>'form-control')); ?>
				  		</td>
				  		<!--<td><span id="erremail" class="errmsg" style="font-weight: bold;color: red;display: none;">Valid email Requred</span></td>-->
			  	   </tr>

			  	   <tr>
			  	   	  <td>Your comment</td>
			  	   	  <td>:</td>
			  	   	  <td>
			  	   	  	   <?php echo $this->Form->textarea('comment', array('name'=>'data[Comment][comment]', 'required'=>true, 'class'=>'form-control', 'value'=>'', 'rows'=>'5', 'cols'=>'10')); ?>
			  	   	  </td>
			  	   	  <!--<td><span id="errcomment" class="errmsg" style="font-weight: bold;color: red;display: none;">Comment Requred</span></td>-->
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

 	function isEmail(email) {
	  	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  	return regex.test(email);
	}

  	$(document).ready(function(){

	  	  $("body").on("click", "#addcomment", function(){

	  	  	  $("#commentModal .form-control").each(function() {
	  	  	  	   $(this).val('');
	  	  	  	   if($(this).hasClass('errmsg')) {
	  	  	  	   	  $(this).removeClass('errmsg');
	  	  	  	   }
	  	  	  	   if($(this).attr('title')) {
	  	  	  	   	  $(this).removeAttr('title');
	  	  	  	   }
	  	  	  });

	  	  	  $("#commentModal").modal();
	  	  });

	  	  $("body").on("click", "#btnSave", function(){
	  	  	  var name = $.trim($("#name").val());
	  	  	  var email = $.trim($("#email").val());
	  	  	  var comment = $.trim($("#comment").val());
	  	  	  var blog_id = $.trim($("#blog_id").val());
	  	  	  var flag = true;

	  	  	  if(name == '') {
	  	  	  
	  	  	  	 $("#name").attr('title', 'Required');
	  	  	  	 $("#name").addClass("errmsg");
	  	  	  	 flag = false;
	  	  	  }
	  	  	  else {
	  	  	  	  $("#name").removeAttr('title');
	  	  	  	  $("#name").removeClass("errmsg");
	  	  	  }

	  	  	  if (email == '') {
	  	  	  	 $("#email").attr('title', 'Required');
	  	  	  	 $("#email").addClass("errmsg");
	  	  	  	 flag = false;
	  	  	  }
	  	  	  else if(!isEmail(email)) {
	  	  	  	 $("#email").attr('title', 'Invalid email');
	  	  	  	 $("#email").addClass("errmsg");
	  	  	  	 flag = false;
	  	  	  }
	  	  	  else {
	  	  	  	  $("#email").removeAttr('title');
	  	  	  	  $("#email").removeClass("errmsg");
	  	  	  }

	  	  	  if(comment == '') {
	  	  	  	 $("#comment").attr('title', 'Required');
	  	  	  	 $("#comment").addClass("errmsg");
	  	  	  	 flag = false;
	  	  	  }
	  	  	  else {
	  	  	  	  $("#comment").removeAttr('title');
	  	  	  	  $("#comment").removeClass("errmsg");
	  	  	  }

	  	  });
  		
  	});
 </script>