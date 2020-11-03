<?php defined('BASEPATH') or exit('No direct script access allowed');


class Backend extends BackendController
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout,....
     */
    protected $data = array();

    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
    }


    public function index()
    {
        // Example
        //$this->load->view('backend/dashboard');
    }
}
