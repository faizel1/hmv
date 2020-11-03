
<?php
class Model extends CI_Model
{

      public function getdata($table){

      return $this->db->get($table)->result();   
      
      }       

public function winner(){

return $this->db->query("SELECT bidamount,userid,auctionid      
FROM   bidders b1
join   auction auc on auc.id=b1.auctionid
WHERE  bidamount=(SELECT max(bidamount) from bidders as b2
where  auc.closing_date=CURRENT_DATE and b1.auctionid=b2.auctionid ) ")->result();

}

      public function search($table,$column,$title){

         return $this->db->get_where($table, array($column => $title))->result();
      
      }

      public function searchn($table,$criteria,$limit="",$start=""){
         return $this->db->get_where($table, $criteria,$limit,$start)->result();

      }

      public function sort($table,$orderby="",$limit="",$start=""){

         $this->db->limit($limit, $start); 
         $this->db->order_by($orderby, "asc");
         return $this->db->get($table)->result();
         
      }   

      public function getonedata($id,$table){
         return $this->db->get_where($table, $id)->result();         
      }    
            
      public function adddata($data,$table){

         return $this->db->insert($table, $data); 
   
      }  
      public function deletedata($id,$table){
         return $this->db->delete($table,$id); 

      }

      public function updatedata($data,$id,$table){
 
         return $this->db->update($table, $data , $id);

      }


     





}







?>