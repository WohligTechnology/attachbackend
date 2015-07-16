<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userfollow_model extends CI_Model
{
public function create($user,$userfollowed,$timestamp,$creationdate,$modificationdate)
{
$data=array("user" => $user,"userfollowed" => $userfollowed,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$query=$this->db->insert( "attach_userfollow", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("attach_userfollow")->row();
return $query;
}
function getsingleuserfollow($id){
$this->db->where("id",$id);
$query=$this->db->get("attach_userfollow")->row();
return $query;
}
public function edit($id,$user,$userfollowed,$timestamp,$creationdate,$modificationdate)
{
$data=array("user" => $user,"userfollowed" => $userfollowed,"timestamp" => $timestamp,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$this->db->where( "id", $id );
$query=$this->db->update( "attach_userfollow", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `attach_userfollow` WHERE `id`='$id'");
return $query;
}
}
?>
