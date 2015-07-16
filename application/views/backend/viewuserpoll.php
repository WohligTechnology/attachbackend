<div class="row" style="padding:1% 0">
<div class="col-md-12">
<a class="btn btn-primary pull-right"  href="<?php echo site_url("site/createuserpoll"); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel">
<!--
<header class="panel-heading">
User Poll Details
</header>
-->
<div class="drawchintantable">
<?php $this->chintantable->createsearch("<b>User Poll List</b>");?>
<table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th data-field="id">ID</th>
<!--<th data-field="image">Image</th>-->
<th data-field="title">Title</th>
<!--<th data-field="video">Video</th>-->
<th data-field="user">User</th>
<th data-field="status">Status</th>
<th data-field="shouldhavecomment">Should Have Comment</th>
<th data-field="timestamp">Time stamp</th>
<th data-field="action">Actions</th>
<!--
<th data-field="content">Content</th>
<th data-field="creationdate">Creation Date</th>
<th data-field="modificationdate">Modification Date</th>
-->
</tr>
</thead>
<tbody>
</tbody>
</table>
<?php $this->chintantable->createpagination();?>
</div>
</section>
<script>
function drawtable(resultrow) {
	if(resultrow.shouldhavecomment=="0"){
	resultrow.shouldhavecomment="Yes";
	}
	if(resultrow.shouldhavecomment=="1"){
	resultrow.shouldhavecomment="No";
	}
	if(resultrow.status=="1"){
	resultrow.status="Active";
	}
	if(resultrow.status=="2"){
	resultrow.status="Inactive";
	}
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.title + "</td><td>" + resultrow.user + "</td><td>" + resultrow.status + "</td><td>" + resultrow.shouldhavecomment + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/edituserpoll?id=');?>"+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deleteuserpoll?id='); ?>"+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
</div>
