<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of expense
 *
 * @author Anwar
 */
class expense extends Controller {
    private $dir='expense';
    function __construct() {
        parent::Controller();
        common::is_logged();
        $this->load->model('mod_expense');
    }
    function index() {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        $this->load->library('grid');
        $gridObj = new grid();
        $gridColumn = array('SN', 'Expense Title', 'Description','Date','Amount','Pay Mood','Pay Details','Pay Effect','Inputed By');
        $gridColumnModel = array(
                array("name" => "sn",
                        "index" => "sn",
                        "width" => 30,
                        "sortable" => false,
                        "align" => "center",
                        "editable" => false
                ),
                array("name" => "exp_title",
                        "index" => "exp_title",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "exp_des",
                        "index" => "exp_des",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "exp_date",
                        "index" => "exp_date",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "exp_amount",
                        "index" => "exp_amount",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "right",
                        "editable" => true
                ),
                array("name" => "pay_mood",
                        "index" => "pay_mood",
                        "width" => 50,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "details_name",
                        "index" => "details_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "pay_effect",
                        "index" => "pay_effect",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "first_name",
                        "index" => "first_name",
                        "width" => 80,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                )
        );
        if($_POST['search']) {
            $gridObj->setGridOptions('Manage Expense', 880, 200, "exp_date", "asc", $gridColumn, $gridColumnModel, site_url("?c=expense&m=load_expense&exp_date={$_POST['exp_date']}"), true);
        }else {
            $gridObj->setGridOptions('Manage Expense', 880, 200, "exp_date", "asc", $gridColumn, $gridColumnModel, site_url('expense/load_expense'), true);
        }
        $data['grid_data'] = $gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Expense','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']=$this->dir;
        $data['page']='index';
        $data['page_title']='Manage Expense';
        $this->load->view('main',$data);
    }
    function load_expense(){
        $this->mod_expense->get_expense_grid();
    }
    function new_expense() {
        if(!common::is_admin_user()) {
            common::redirect();
        }

        if($_POST['save']) {
            $this->valid_expense();
            if($this->form_validation->run()) {
                $this->mod_expense->save_expense(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('expense');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Expense','url'=>site_url('expense')),
                array('title'=>'Add New Expense','url'=>'')
        );

        $data['dir']=$this->dir;

        $data['page']='new_expense'; //Don't Change
        $data['page_title']='Add New Expense';
        $this->load->view('main',$data);
    }
    function edit_expense($expense_id='') {
        if($_POST['update']) {
            $this->valid_expense();
            if($this->form_validation->run()) {
                $this->mod_expense->update_enquiry(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('expense');
            }
        }

        if($expense_id=='') {
            redirect('expense');
        }
        $data=sql::row('expense','expense_id='.$expense_id);
        $this->session->set_userdata('expense_id',$data['expense_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Expense','url'=>site_url('expense')),
                array('title'=>'Edit Expense','url'=>'')
        );

        $data['dir']=$this->dir;

        $data['page']='edit_expense'; //Don't Change
        $data['page_title']='Edit Expense';
        $this->load->view('main',$data);
    }
    function delete_expense($expense_id='') {
        if(!common::is_admin_user()) {
            common::redirect();
        }
        if($expense_id=='') {
            redirect('expense');
        }
        sql::delete('expense','expense_id='.$expense_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function valid_expense() {
        $this->form_validation->set_rules('exp_title', 'Expense', 'required');
        $this->form_validation->set_rules('exp_des', 'Expense Description', '');
        $this->form_validation->set_rules('exp_date', 'Expense Date', 'required');
        $this->form_validation->set_rules('exp_amount', 'Expense Amount', 'required|numeric');
        $this->form_validation->set_rules('pay_mood', 'Pay Mood', 'required');
        $this->form_validation->set_rules('pay_details_id', 'Payment Details', 'required');
    }
}
?>