<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sel extends MY_Controller
{
    public $data;
    public $auction;

    public function __construct()
    {
        parent::__construct();
    
        $this->load->view('header');
        $this->load->library('session');
        $this->load->model('model');
    }

    public function index($order="")
    {
        //if(!isset($_SESSION['username']))
        //redirect('Validation_c2');

        //$order=$this->input->get('id');
    
        //echo $row=count($this->model->sort("auction"));

        $this->load->library('bootpag');
        $this->bootpag->whereto('auction_c/index');
    

        //filtering
        if ($this->input->post('search')) {
            $_SESSION['pos']=$this->input->post();
            unset($_SESSION['pos']['search']);

            foreach ($_SESSION['pos'] as $key=>$value) {
                if ($value) {
                    $data[$key]=$value;
                }

                $auction['data']=$this->model->searchn("auction", $data);
            }
        }
        

        if (!($this->input->post('search')) or $this->input->post('showall')) {
            $auction['data']=$this->model->sort("auction", $order, 3, $this->uri->segment(3));
        }
    
    
        $this->load->view('auction/dispauction', $auction);
    }



    public function newauc()
    {
        $this->load->view('auction/insauction');
        
        $picture['name']=$this->imageUpload();
        if ($this->input->post('save')) {
            $data=array(
                'auction_type'=>$_POST['auctiontype'],
                'auction_detail'=>$_POST['auctiondetail'],
                'auction_address'=>$_POST['auctionaddress'],
                'picture'=>$picture['name'],
                'status'=>$_POST['status'],
                'closing_date'=>$_POST['closingdate'],
            );
            $auction['data']=$this->model->adddata($data, 'auction');
        }
        

        $auction['data']=$this->model->getdata('auction', "", 2, $this->uri->segment(3));
        $this->index();
    }
    public function updateauc($id)
    {
        $array=array("id"=>$id);

        $pos['dat']=$this->model->getonedata($array, 'auction');
        echo count($pos)['dat'];
        if (count($pos['dat'])>0) {
            foreach ($pos['dat'] as $dat) {
                $arr=$dat->id;
                $status=$dat->status;
            }
        }

        if ($status=="Not-Active") {
            $this->session->set_flashdata('alert', 'Whoops  You cant update, This Auction is expired');
        } else {
            $this->load->view('auction/updauction', $pos);
            $picture['name']=$this->imageUpload();
    
            // the id that passed using url
            $array=array("id"=>$id);

            if ($this->input->post('update')) {
                $data=array(
            'auction_type'=>$_POST['auctiontype'],
            'auction_detail'=>$_POST['auctiondetail'],
            'auction_address'=>$_POST['auctionaddress'],
            'picture'=>$picture['name'],
            'status'=>$_POST['status'],
            'closing_date'=>$_POST['closingdate'],
        );
                $auction['data']=$this->model->updatedata($data, $array, 'auction');
                $this->session->set_flashdata('alert', 'You have updated successfully');
            }
        }

        $auction['data']=$this->model->sort('auction', "", 2, $this->uri->segment(3));
        $this->index();
    }

    public function deleteauc($id)
    {
        $array=array("id"=>$id);
    
        $this->model->deletedata($array, 'auction');
        $auction['data']=$this->model->getdata('auction');
        $this->session->set_flashdata('alert', "You have deleted auction $id successfully");

        $this->index();
    }


    public function imageUpload()
    {
        $config['upload_path'] = 'upload/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name']=$_FILES['picture']['name'];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('picture')) {
            $uploaddata=$this->upload->data();
            $picture['name']=$uploaddata['file_name'];
        } else {
            $picture['name']='';
        }

        return $picture['name'];
    }
}
