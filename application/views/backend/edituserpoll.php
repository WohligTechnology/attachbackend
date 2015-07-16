<section class="panel">
	<header class="panel-heading">
		User Poll Details
	</header>
	<div class="panel-body">
		<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edituserpollsubmit");?>' enctype='multipart/form-data'>
			<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Image</label>
				<div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value='<?php echo set_value(' image ',$before->image);?>'>
					<?php if($before->image == "")
						 { }
						 else
						 { ?>
							<img src="<?php echo base_url('uploads')."/".$before->image; ?>" width="140px" height="140px">
						<?php }
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Title</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="title" value='<?php echo set_value(' title ',$before->title);?>'>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Video</label>
				<div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="video" value='<?php echo set_value(' video ',$before->video);?>'>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">User</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "user",$user,set_value( 'user',$before->user),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Status</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Should Have Comment</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "shouldhavecomment",$shouldhavecomment,set_value( 'shouldhavecomment',$before->shouldhavecomment),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Time stamp</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="timestamp" value='<?php echo set_value(' timestamp ',$before->timestamp);?>'>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Content</label>
				<div class="col-sm-8">
					<textarea name="content" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'content',$before->content);?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Creation Date</label>
				<div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="creationdate" value='<?php echo set_value(' creationdate ',$before->creationdate);?>'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Modification Date</label>
				<div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="modificationdate" value='<?php echo set_value(' modificationdate ',$before->modificationdate);?>'>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
				<div class="col-sm-4">
					<button type="submit" class="btn btn-primary">Save</button>
					<a href='<?php echo site_url("site/viewpage"); ?>' class='btn btn-secondary'>Cancel</a>
				</div>
			</div>
		</form>
	</div>
</section>