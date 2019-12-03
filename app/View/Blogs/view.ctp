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
			  <p id="cmntmsg" style="color: red;font-weight: bold;visibility: hidden;">Comment saved successfully.</p>
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

<div id="commentsection">
	<img src="<?php echo $this->webroot.'img/loading.png'; ?>" class="load" style="visibility: hidden;" />
	<table class="blogcomments">
		<?php
		if(!empty($blog['Comment']))
		{
			foreach($blog['Comment'] as $comment) {
			?>
				<tr>
					<td>
						<?php echo $comment['name']." says:<br/>"; ?>
						<?php echo htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8'); ?><br/>
						<?php echo date('F j,Y H:i:s', strtotime($comment['created_at'])); ?>
					</td>
				</tr>
			<?php
			}
		}
		?>
	</table>
</div>


 <script type="text/javascript">

 	function isEmail(email) {
	  	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  	return regex.test(email);
	}

	function loadcomments() {
		$("#commentModal .close").click();
		$("#commentsection .load").css('visibility','visible');

		var targeturl = "/cakephp/loadcomments";

		$.ajax({
			type: "POST",
			url: targeturl,
			data: {blog_id:$("#blog_id").val()},
			dataType: "json",
			success: function(data) {
				var comments = data.comments;
				var output = "";
				$.each(comments, function(i, item){
					output+="<tr>";
					output+="<td>"
					output+=item.name+" says: <br/>";
					output+=item.comment+"<br/>" + item.created_at;
					output+="</td>"
					output+="</tr>";
				});

				console.log(output);

				$("#commentsection .load").css('visibility','hidden');
				$("#commentsection .blogcomments").html(output);
			}
		});
	}

  	$(document).ready(function(){

	  	  $("body").on("click", "#addcomment", function(){

	  	  	  $("#commentModal .form-control").each(function() {
	  	  	  	   $(this).val('');
	  	  	  	   $("#cmntmsg").css("visibility", "hidden");

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

	  	  	  //if form is validated then call ajax
	  	  	  if (flag) {
	  	  	  	  var targeturl = "/cakephp/comment/save";

	  	  	  	  $.ajax({
	  	  	  	  	 type: "POST",
	  	  	  	  	 url: targeturl,
	  	  	  	  	 data: {u_name:name, u_email: email, u_comment:comment, blog_id:$("#blog_id").val()},
	  	  	  	  	 dataType: "json",
	  	  	  	  	 success: function(response) {
	  	  	  	  	 	if(response.status) {
	  	  	  	  	 		$("#name").val('');
	  	  	  	  	 		$("#email").val('');
	  	  	  	  	 		$("#comment").val('');
	  	  	  	  	 		$("#cmntmsg").css("visibility", "visible");
	  	  	  	  	 		setTimeout(loadcomments, 3000);
	  	  	  	  	 	}
	  	  	  	  	 }
	  	  	  	  });
	  	  	  }

	  	  });
  		
  	});
 </script>