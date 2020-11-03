<?php defined('BASEPATH') or exit('No direct script access allowed');


class Bid extends BackendController
{
    //
    public $CI;

    protected $data = array();

    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
        $this->load->view('header');
        $this->load->library('session');
        $this->load->model('model');
    }



    public function index($order="")
    {
        $this->load->library('bootpag');
        $this->bootpag->whereto('bid_c/index');


        //if(!isset($_SESSION['username']))
        //redirect('Validation_c2');
        
        //$order=$this->input->get('id');


        // $_POST['aucid']; is from homepage hidden input

        if ($this->input->post('search')) {
            $_SESSION['pos']=$this->input->post();
            unset($_SESSION['pos']['search']);
        
            foreach ($_SESSION['pos'] as $key=>$value) {
                if ($value) {
                    $data[$key]=$value;
                }

                $bid['data']=$this->model->searchn("bidders", $data, 4, $this->uri->segment(3));
            }
        }

        if (!($this->input->post('search')) or $this->input->post('showall')) {
            $bid['data']=$this->model->sort("bidders", $order, 4, $this->uri->segment(3));
        }
        $aa=$_POST['aucid'];

        $this->load->view('bid/dispbid', $bid, $aa);
    }


    public function newbid()
    {
        $x=0;
        $this->load->view('bid/insbid');

        if (isset($_POST['save'])) {
            $data=array(
                'auctionid'=>$_POST['auctionid'],
                'userid'=>$_POST['userid'],
                'bidamount'=>$_POST['bidamount'],
                
            );
            $bid['data']=$this->model->adddata($data, 'bidders');

            if ($bid!=null) {
                $this->session->set_flashdata('alert', "You have inserted a bid successfully");
                $x++;
            }
        }
        

        if ($x==1) {
            redirect('index.php/bid');
        }
    }
    public function updatebid($id)
    {
        $x=0;
        $array=array("bidid"=>$id);
    
        $pos['dat']=$this->model->getonedata($array, 'bidders');
        $this->load->view('bid/updbid', $pos);


        if (isset($_POST['update'])) {
            $data=array(
            'auctionid'=>$_POST['auctionid'],
            'userid'=>$_POST['userid'],
            'bidamount'=>$_POST['bidamount'],
            
        );
        
            $bid['data']=$this->model->updatedata($data, $array, 'bidders');
            if ($bid!=null) {
                $this->session->set_flashdata('alert', "You have updated bid number $id successfully");
                $x++;
                ;
            }
        }

        if ($x==1) {
            redirect('index.php/bid');
        }
    }

    public function deletebid($id)
    {
        $array=array("bidid"=>$id);

    
        $this->model->deletedata($array, 'bidders');
        $bid['data']=$this->model->sort('bidders');
        //	if($bid!=null)
        //	$this->session->set_flashdata('alert', "You have deleted bid number $id successfully");

        redirect('index.php/bid');
    }
}
