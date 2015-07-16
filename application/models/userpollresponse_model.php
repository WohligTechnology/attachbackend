<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userpollresponse_model extends CI_Model
{
public function create($userpolloption,$userpoll,$user,$timestamp,$creationdate,$modificationdate)
{
$data=array("userpolloption" => $userpolloption,"userpoll" => $userpoll,"user" => $user,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$query=$this->db->insert( "attach_userpollresponse", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("attach_userpollresponse")->row();
return $query;
}
function getsingleuserpollresponse($id){
$this->db->where("id",$id);
$query=$this->db->get("attach_userpollresponse")->row();
return $query;
}
public function edit($id,$userpolloption,$userpoll,$user,$timestamp,$creationdate,$modificationdate)
{
$data=array("userpolloption" => $userpolloption,"userpoll" => $userpoll,"user" => $user,"timestamp" => $timestamp,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$this->db->where( "id", $id );
$query=$this->db->update( "attach_userpollresponse", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `attach_userpollresponse` WHERE `id`='$id'");
return $query;
}
}
?>
