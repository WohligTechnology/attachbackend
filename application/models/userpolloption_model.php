<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userpolloption_model extends CI_Model
{
public function create($image,$order,$userpoll,$timestamp,$text,$creationdate,$modificationdate)
{
$data=array("image" => $image,"order" => $order,"userpoll" => $userpoll,"text" => $text,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$query=$this->db->insert( "attach_userpolloption", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("attach_userpolloption")->row();
return $query;
}
function getsingleuserpolloption($id){
$this->db->where("id",$id);
$query=$this->db->get("attach_userpolloption")->row();
return $query;
}
public function edit($id,$image,$order,$userpoll,$timestamp,$text,$creationdate,$modificationdate)
{
$data=array("image" => $image,"order" => $order,"userpoll" => $userpoll,"timestamp" => $timestamp,"text" => $text,"creationdate" => $creationdate,"modificationdate" => $modificationdate);
$this->db->where( "id", $id );
$query=$this->db->update( "attach_userpolloption", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `attach_userpolloption` WHERE `id`='$id'");
return $query;
}
public function getuserpolloptiondropdown()
	{
		$query=$this->db->query("SELECT * FROM `attach_userpolloption`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->text;
		}
		
		return $return;
	}
}
?>
