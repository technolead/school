<?php 
/**
 * Description of letter
 *
 * @author anwar
 */
class books extends Controller {
    function __construct() {
        parent::Controller();
        $this->load->model('mod_books');
        common::is_logged();
    }
    function index() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array('ISBN','Serial No','Book Name','Category Name','Author','Edition','Shelf No.','Rack No.', "Status");
        $gridColumnModel = array(
                array("name" => "isbn",
                        "index" => "isbn",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "serial_no",
                        "index" => "serial_no",
                        "width" => 60,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                 array("name" => "book_name",
                        "index" => "book_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "category_name",
                        "index" => "category_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "author",
                        "index" => "author",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                 array("name" => "edition",
                        "index" => "edition",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                 array("name" => "shelf_no",
                        "index" => "shelf_no",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                 array("name" => "rack_no",
                        "index" => "rack_no",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 40,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        if($_POST['apply_filter']){
            $gridObj->setGridOptions("Manage Books", 880, 250, "book_name", "asc", $gridColumn, $gridColumnModel, site_url('?c=books&m=load_books&searchField='.$_POST['searchField'].'&searchValue='.$_POST['searchValue'].'&cid='.$_POST['category_id']), true);
        }else{
            $gridObj->setGridOptions("Manage Books", 880, 250, "book_name", "asc", $gridColumn, $gridColumnModel, site_url('books/load_books'), true);
        }
        $data['grid_data']=$gridObj->getGrid();

        $data['nav_array']=array(
                array('title'=>'Manage Books','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='books';
        $data['page']='index';
        $data['page_title']='Manage Books';
        $this->load->view('main',$data);
    }
    function load_books() {
        $this->mod_books->get_books_grid();
    }
    function valid_filter() {
        $this->form_validation->set_rules('isbn', 'ISBN', '');
        $this->form_validation->set_rules('serial_no', 'Last Name', '');
        $this->form_validation->set_rules('book_name', 'Book Name', '');
        $this->form_validation->set_rules('author', 'Author', '');
        $this->form_validation->set_rules('category_id', 'Category', '');
    }
    function details($books_id='') {
        if($books_id=='') {
            redirect('books');
        }
        $data=$this->mod_books->get_books_details($books_id);
        $data['nav_array']=array(
                array('title'=>'Manage Books','url'=>site_url('books')),
                array('title'=>$data['book_name'],'url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='books';
        $data['page']='details';
        $data['page_title']='Manage Books';
        $this->load->view('main',$data);
    }
    function new_book() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_book')) {
                $this->mod_books->save_books(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('books');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Books','url'=>site_url('books')),
                array('title'=>'Add New Book','url'=>'')
        );
        $data['dir']='books';
        $data['page']='book_form';
        $data['action']='books/new_book';
        $data['page_title']='Add New book';
        $this->load->view('main',$data);
    }
    function edit_book($book_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_book')) {
                $this->mod_books->update_books(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('books');
            }
        }
        if($book_id=='') {
            redirect('books');
        }
        $data=$this->mod_books->get_books_details($book_id); //Don't Change
        $this->session->set_userdata('books_id',$data['books_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Books','url'=>site_url('books')),
                array('title'=>'Edit book','url'=>'')
        );
        $data['dir']='books';
        $data['page']='book_form';
        $data['action']='books/edit_book/'.$book_id;
        $data['page_title']='Edit Book';
        $this->load->view('main',$data);
    }
    function delete_books($book_id='') {
        if($book_id=='') {
            common::redirect();
        }
        $this->mod_books->delete_books($book_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function books_status($status='enabled',$book_id='') {
        if($book_id=='') {
            common::redirect();
        }
        common::change_status('books','books_id='.$book_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }
    function category() {
        $this->load->library('grid');
        $gridObj=new grid();
        $gridColumn = array("Category Name",'Description', "Status");
        $gridColumnModel = array(
                array("name" => "category_name",
                        "index" => "category_name",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => false
                ),
                array("name" => "des",
                        "index" => "des",
                        "width" => 100,
                        "sortable" => true,
                        "align" => "left",
                        "editable" => true
                ),
                array("name" => "status",
                        "index" => "status",
                        "width" => 35,
                        "sortable" => true,
                        "align" => "center",
                        "editable" => true
                )
        );
        $gridObj->setGridOptions("Manage Books Category", 750, 250, "category_name", "asc", $gridColumn, $gridColumnModel, site_url('books/load_category'), true);
        $data['grid_data']=$gridObj->getGrid();
        $data['nav_array']=array(
                array('title'=>'Manage Books Category','url'=>'')
        );
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='books';
        $data['page']='category';
        $data['page_title']='Manage Books Category';
        //$data['rows']=$this->mod_books->get_books_category(); //Don't Change
        $this->load->view('main',$data);
    }
    function load_category() {
        $this->mod_books->get_category_grid();
    }
    function new_books_category() {
        if($_POST['save']) {
            if($this->form_validation->run('valid_books_category')) {
                $this->mod_books->save_books_category(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Added!!!');
                redirect('books/category');
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Books Category','url'=>site_url('books/category')),
                array('title'=>'Add New Books Category','url'=>'')
        );
        $data['dir']='books';
        $data['page']='category_form';
        $data['action']='books/new_books_category';
        $data['page_title']='Add New Books Category';
        $this->load->view('main',$data);
    }
    function edit_books_category($category_id='') {
        if($_POST['save']) {
            if($this->form_validation->run('valid_books_category')) {
                $this->mod_books->update_books_category(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('books/category');
            }
        }
        if($category_id=='') {
            redirect('books/category');
        }
        $data=$this->mod_books->get_books_category_details($category_id); //Don't Change
        $this->session->set_userdata('books_category_id',$data['books_category_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Books Category','url'=>site_url('books/category')),
                array('title'=>'Edit Books Category','url'=>'')
        );
        $data['dir']='books';
        $data['action']='books/edit_books_category/'.$category_id;
        $data['page']='category_form'; //Don't Change
        $data['page_title']='Edit Books Category';
        $this->load->view('main',$data);
    }
    function delete_books_category($category_id='') {
        if($category_id=='') {
            common::redirect();
        }
        $this->mod_books->delete_books_category($category_id); //Don't Change
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function books_category_status($status='enabled',$category_id='') {
        if($category_id=='') {
            common::redirect();
        }
        common::change_status('books_category','books_category_id='.$category_id,$status);
        $this->session->set_flashdata('msg','Status Updated!!!');
        common::redirect();
    }

    function library_fines() {
        if($_POST['save']) {
            if($this->form_validation->run('library_fines')) {
                if($this->mod_books->save_library_fines()) {
                    $this->session->set_flashdata('msg','Library Fine added Successfully!!!');
                    common::redirect();
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Library Fines','url'=>'')
        );
        $data['rows']=$this->mod_books->get_library_fines();
        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='books';
        $data['page']='library_fines'; //Don't Change
        $data['page_title']='Library Fines';
        $this->load->view('main',$data);
    }
    function delete_library_fine($fine_id='') {
        if($fine_id=='') {
            common::redirect();
        }
        sql::delete('library_fine','fine_id='.$fine_id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function edit_library_fine($fine_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('library_fines')) {
                $this->mod_books->update_library_fine(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('books/library_fines');
            }
        }
        if($fine_id=='') {
            redirect('books/library_fines');
        }
        $data=sql::row('library_fine','fine_id='.$fine_id);
        $this->session->set_userdata('fine_id',$data['fine_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Library Fines','url'=>site_url('books/library_fines')),
                array('title'=>'Edit Library','url'=>'')
        );
        $data['dir']='books';
        $data['page']='edit_library_fine'; //Don't Change
        $data['page_title']='Edit Library Fine';
        $this->load->view('main',$data);
    }
    function issued_books() {
        $this->load->library('pagination');
        $start=$this->uri->segment(3);
        if($start=='') {
            $start=0;
        }
        $config['uri_segment'] = 3;
        $config['base_url'] = site_url('books/issued_books/');

        $config['per_page'] = 20;
        $config['next_link'] = "Next &raquo;";
        $config['prev_link'] = "&laquo; Previous";

        if($_POST['apply_filter']) {
            $this->valid_issue_filter();
            if($this->form_validation->run()) {
                $config['total_rows'] = count($this->mod_books->filter_issued_books());
                $data['rows']=$this->mod_books->filter_issued_books();
            }
        }else {
            $config['total_rows'] = count($this->mod_books->get_issued_books());
            $data['rows']=$this->mod_books->get_issued_books();
        }
        $this->pagination->initialize($config);
        $data['pagination_links']=$this->pagination->create_links();

        if(count($data['rows'])>0) {
            $data['start']=$start+1;
        }else {
            $data['start']=$start;
        }

        $data['end']=$start+count($data['rows']);
        $data['total']=$config['total_rows'];

        $data['nav_array']=array(
                array('title'=>'Manage Issued Books','url'=>'')
        );

        $data['msg']=$this->session->flashdata('msg');
        $data['dir']='books';
        $data['page']='issued_books'; //Don't Change
        $data['page_title']='Issued Books';
        $this->load->view('main',$data);
    }
    function valid_issue_filter() {
        $this->form_validation->set_rules('isbn', 'ISBN', '');
        $this->form_validation->set_rules('serial_no', 'Serial No', '');
        $this->form_validation->set_rules('book_name', 'Book Name', '');
        $this->form_validation->set_rules('user_name', 'ID', '');
        $this->form_validation->set_rules('name', 'Name', '');
        $this->form_validation->set_rules('from_date', 'From', '');
        $this->form_validation->set_rules('to_date', 'From', '');
    }
    function nw_issue_book() {
        if($_POST['save']) {
            if($this->form_validation->run('issue_book')) {
                if($this->mod_books->save_book_issued()) {
                    $this->session->set_flashdata('msg','Book Issued Successfully!!!');
                    redirect('books/issued_books');
                }
            }
        }
        $data['nav_array']=array(
                array('title'=>'Manage Issued Books','url'=>site_url('books/issued_books')),
                array('title'=>'New Issue a Book','url'=>'')
        );
        $data['dir']='books';
        $data['page']='nw_issue_book'; //Don't Change
        $data['page_title']='Issue a Book';
        $this->load->view('main',$data);
    }
    function edit_issued_book($issued_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('issue_book')) {
                $this->mod_books->update_book_issued(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('books/issued_books');
            }
        }
        if($issued_id=='') {
            redirect('books/library_fines');
        }
        $data=$this->mod_books->get_issued_details($issued_id);
        $this->session->set_userdata('issued_id',$data['issued_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Issued Books','url'=>site_url('books/issued_books')),
                array('title'=>'Edit Issue a Book','url'=>'')
        );
        $data['dir']='books';
        $data['page']='edit_issued_book'; //Don't Change
        $data['page_title']='Edit Issue a Book';
        $this->load->view('main',$data);
    }
    function receive_book($issued_id='') {
        if($_POST['update']) {
            if($this->form_validation->run('receive_issue_book')) {
                $this->mod_books->receive_book(); //Don't Change
                $this->session->set_flashdata('msg','Successfully Updated!!!');
                redirect('books/issued_books');
            }
        }
        if($issued_id=='') {
            redirect('books/library_fines');
        }
        $data=$this->mod_books->get_issued_details($issued_id);
        $this->session->set_userdata('issued_id',$data['issued_id']); //Don't Change
        $data['nav_array']=array(
                array('title'=>'Manage Issued Books','url'=>site_url('books/issued_books')),
                array('title'=>'Receive Issued Book','url'=>'')
        );
        $data['dir']='books';
        $data['page']='receive_book'; //Don't Change
        $data['page_title']='Receive Issued Book';
        $this->load->view('main',$data);
    }
    function delete_issued_book($issued_id='') {
        if($issued_id=='') {
            common::redirect();
        }
        sql::delete('book_issued','issued_id='.$issued_id);
        $this->session->set_flashdata('msg','Successfully Deleted!!!');
        common::redirect();
    }
    function get_expiry_date() {
        $sql=$this->db->query("select DATE_ADD(CURDATE(), INTERVAL f.days_permitted DAY) as expiry_date from library_fine as f where user_type like '{$_POST['user_type']}' order by date desc");
        $data=$sql->row_array();
        echo $data['expiry_date'];
    }
    function get_book_list() {
        $data=$this->mod_books->get_book_list();
        echo $data;
    }

    function is_valid_id() {
        if($_POST['user_type']=='Student') {
            if(sql::count('student',"user_name={$this->db->escape($_POST['user_name'])}")>0) {
                return TRUE;
            }else {
                $this->form_validation->set_message('is_valid_id','Sorry, Invalid Student ID!');
                return FALSE;
            }
        }else if($_POST['user_type']=='Admin Staffs'||$_POST['user_type']=='Academic Staffs') {
            if(sql::count('staffs',"user_name='{$_POST['user_name']}'")>0) {
                return TRUE;
            }else {
                $this->form_validation->set_message('is_valid_id','Sorry, Invalid Staff ID!');
                return FALSE;
            }
        }else {
            $this->form_validation->set_message('is_valid_id','Sorry, Invalid ID!');
            return FALSE;
        }
    }
    function is_valid_book() {
        if(sql::count('books',"serial_no='{$_POST['serial_no']}'")>0) {
            return TRUE;
        }else {
            $this->form_validation->set_message('is_valid_book','Sorry, Invalid Book Serical!');
            return FALSE;
        }
    }
}?>