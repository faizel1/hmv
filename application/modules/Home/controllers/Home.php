<?php defined('BASEPATH') or exit('No direct script access allowed');


class Home extends BackendController
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout,....
     */
    protected $data = array();





    public function __construct(){

parent::__construct();
$this->load->view('header');

$this->load->model('model');
//setting and checking the winner
$sql=$this->model->winner();
if(count($sql)>0){ 
    echo "there are ". count($sql)." auctions which ends today";

foreach($sql as $dat){
    $arr=$dat->auctionid;
    $winner=$dat->userid;
}

$array=array("id"=>$arr);
$data=array(
"status"=>"Not-Active",
"auction_winner"=>$winner,

    );

  $this->model->updatedata($data,$array,"auction");

  
     
   
    }else {
  //  echo  "there is no auction which ends today";
     }



}

public function index(){
    
   // if(!isset($_SESSION['username']))
//	redirect('Validation_c2');
   

$result['data']=$this->model->getdata('auction');
$this->load->view('home/disphome',$result);

}







}


?>