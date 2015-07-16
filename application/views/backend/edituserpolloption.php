<section class="panel">
	<header class="panel-heading">
		User Poll Option Details
	</header>
	<div class="panel-body">
		<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edituserpolloptionsubmit");?>' enctype='multipart/form-data'>
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
				<label class="col-sm-2 control-label" for="normal-field">Order</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$before->order);?>'>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">User Poll</label>
				<div class="col-sm-4">
					<?php echo form_dropdown( "userpoll",$userpoll,set_value( 'userpoll',$before->userpoll),"class='chzn-select form-control'");?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="normal-field">Time stamp</label>
				<div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="timestamp" value='<?php echo set_value(' timestamp ',$before->timestamp);?>'>
				</div>
			</div>
			<div class=" form-group">
				<label class="col-sm-2 control-label" for="normal-field">Text</label>
				<div class="col-sm-8">
					<textarea name="text" id="" cols="20" rows="10" class="form-control tinymce"><?php echo set_value( 'text',$before->text);?></textarea>
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