<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userpollfavourites_model extends CI_Model
{
public function create($user,$userpoll,$timestamp,$creationdate,$modificationdate)
{
$data=array("user" => $user,"userpoll" => $userpoll,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$query=$this->db->insert( "attach_userpollfavourites", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("attach_userpollfavourites")->row();
return $query;
}
function getsingleuserpollfavourites($id){
$this->db->where("id",$id);
$query=$this->db->get("attach_userpollfavourites")->row();
return $query;
}
public function edit($id,$user,$userpoll,$timestamp,$creationdate,$modificationdate)
{
$data=array("user" => $user,"userpoll" => $userpoll,"timestamp" => $timestamp,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$this->db->where( "id", $id );
$query=$this->db->update( "attach_userpollfavourites", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `attach_userpollfavourites` WHERE `id`='$id'");
return $query;
}
}
?>
