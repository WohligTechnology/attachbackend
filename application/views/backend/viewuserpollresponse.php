<div class="row" style="padding:1% 0">
<div class="col-md-12">
<a class="btn btn-primary pull-right"  href="<?php echo site_url("site/createuserpollresponse"); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel">
<!--
<header class="panel-heading">
User Poll Response Details
</header>
-->
<div class="drawchintantable">
<?php $this->chintantable->createsearch("<b>User Poll Response List</b>");?>
<table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="userpolloption">User Poll Option</th>
<th data-field="userpoll">User Poll</th>
<th data-field="user">User</th>
<th data-field="timestamp">Time stamp</th>
<th data-field="action">Action</th>
<!--
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
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.userpolloption + "</td><td>" + resultrow.userpoll + "</td><td>" + resultrow.user + "</td><td>" + resultrow.timestamp + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/edituserpollresponse?id=');?>"+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deleteuserpollresponse?id='); ?>"+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
</div>
