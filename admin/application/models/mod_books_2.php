<?php 
class mod_books extends Model {
    function __construct() {
        parent::Model();
    }

    function get_all_books() {
        $sql=$this->db->query("select b.*,c.category_name,concat(u.first_name,' ',u.last_name) as user_name from books as b
                                join books_category as c on b.category_id=c.books_category_id
                                join user as u on b.user_id=u.user_id where 1=1");
        return $sql->result_array();
    }
    function filter_books() {
        $con='';
        if($_POST['isbn']!='') {
            $con.=" and b.isbn = '{$_POST['isbn']}'";
        }
        if($_POST['serial_name']!='') {
            $con.=" and b.serial_name like '%{$_POST['serial_name']}%'";
        }
        if($_POST['book_name']!='') {
            $con.=" and b.book_name like '%{$_POST['book_name']}%'";
        }
        if($_POST['author']!='') {
            $con.=" and b.author like '%{$_POST['author']}%'";
        }
        if($_POST['category_id']!='') {
            $con.=" and b.category_id = '{$_POST['category_id']}'";
        }

        $sql=$this->db->query("select b.*,c.category_name,concat(u.first_name,' ',u.last_name) as user_name from books as b
                                join books_category as c on b.category_id=c.books_category_id
                                join user as u on b.user_id=u.user_id where 1=1 $con");
        return $sql->result_array();
    }
    function get_books_details($id) {
        $sql=$this->db->query("select b.*,c.category_name,u.user_name from books as b
                                join books_category as c on b.category_id=c.books_category_id
                                join user as u on b.user_id=u.user_id where books_id = $id");
        return $sql->row_array();
    }

    function save_books() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into books set
                isbn={$this->db->escape($_POST['isbn'])},
                serial_no={$this->db->escape($_POST['serial_no'])},
                category_id={$this->db->escape($_POST['category_id'])},
                book_name={$this->db->escape($_POST['book_name'])},
                author={$this->db->escape($_POST['author'])},
                edition={$this->db->escape($_POST['edition'])},
                publication={$this->db->escape($_POST['publication'])},
                book_price={$this->db->escape($_POST['book_price'])},
                no_of_copies={$this->db->escape($_POST['no_of_copies'])},
                available_copies={$this->db->escape($_POST['available_copies'])},
                shelf_no={$this->db->escape($_POST['shelf_no'])},
                rack_no={$this->db->escape($_POST['rack_no'])},
                user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function update_books() {
        $books_id=$this->session->userdata('books_id');
        $sql="update books set
                isbn={$this->db->escape($_POST['isbn'])},
                serial_no={$this->db->escape($_POST['serial_no'])},
                category_id={$this->db->escape($_POST['category_id'])},
                book_name={$this->db->escape($_POST['book_name'])},
                author={$this->db->escape($_POST['author'])},
                edition={$this->db->escape($_POST['edition'])},
                publication={$this->db->escape($_POST['publication'])},
                book_price={$this->db->escape($_POST['book_price'])},
                no_of_copies={$this->db->escape($_POST['no_of_copies'])},
                available_copies={$this->db->escape($_POST['available_copies'])},
                shelf_no={$this->db->escape($_POST['shelf_no'])},
                rack_no={$this->db->escape($_POST['rack_no'])}
                where books_id=$books_id";
        return $this->db->query($sql);
    }
    function delete_books($books_id) {
        $sql="delete from books where books_id=$books_id";
        return $this->db->query($sql);
    }
    function get_books_category() {
        $sql=$this->db->query("select * from books_category where parent_id=0");
        return $sql->result_array();
    }
    function category_options($sel='') {
        $parent_cat=$this->get_books_category();
        $opt.="<option value=''>Select Category</option>";
        if(count($parent_cat)>0) {
            foreach($parent_cat as $cat) {
                if($cat['books_category_id']==$sel) {
                    $opt.="<option value='$cat[books_category_id]' selected='selected'>$cat[category_name]</option>";
                }else {
                    $opt.="<option value='$cat[books_category_id]'>$cat[category_name]</option>";
                }
                $opt.=$this->sub_category_options($cat[books_category_id],$sel);
            }
        }
        return $opt;
    }
    function sub_category_options($category_id='',$sel='') {
        $sql=$this->db->query("select * from books_category where parent_id='$category_id'");
        $categories=$sql->result_array();
        if(count($categories)>0) {
            foreach($categories as $cat) {
                if($cat['books_category_id']==$sel) {
                    $opt.="<option value='$cat[books_category_id]' selected='selected' class='pad_0_30'>&raquo; $cat[category_name]</option>";
                }else {
                    $opt.="<option value='$cat[books_category_id]' class='pad_0_20'>&raquo; $cat[category_name]</option>";
                }
            }
        }
        return $opt;
    }
    function parent_category_options($sel='') {
        $category_id=$this->session->userdata('books_category_id');
        $sql=$this->db->query("select * from books_category where parent_id=0 and books_category_id!='$category_id'");
        $categories=$sql->result_array();
        $opt.="<option value='0'>As a Parent Category</option>";
        if(count($categories)>0) {
            foreach($categories as $cat) {
                if($cat['books_category_id']==$sel) {
                    $opt.="<option value='$cat[books_category_id]' selected='selected'>$cat[category_name]</option>";
                }else {
                    $opt.="<option value='$cat[books_category_id]'>$cat[category_name]</option>";
                }
            }
        }
        return $opt;
    }
    function sub_category_list($category_id='') {
        $sql=$this->db->query("select * from books_category where parent_id='$category_id'");
        $categories=$sql->result_array();
        if(count($categories)>0) {
            $inc=1;
            foreach($categories as $row) {
                $sub.='<tr class="sub_cat">
					<td class="pad_0_30">&raquo; '.$row['category_name'].'</td>
					<td>'.word_limiter($row['des'],5).'</td>
					<td class="view_links">
						<a href="'.site_url('books/books_category_status/'.$row['books_category_id'].'/'.$row['status']).'" title="'.common::status($row['status']).'" class="'.$row['status'].'" ></a>
						<a href="'.site_url('books/edit_books_category/'.$row['books_category_id']).'" title="Change" class="edit_link"></a>
						<a href="'.site_url('books/delete_books_category/'.$row['books_category_id']).'" title="Delete" class="delete_link" onclick="javascript: return confirm("Are you sure you want to delete?");"></a>
					</td>
				</tr>';
                $inc++;
            }
        }
        return $sub;
    }
    function get_books_category_details($id) {
        $sql=$this->db->query("select * from books_category where books_category_id = $id");
        return $sql->row_array();
    }

    function save_books_category() {
        $sql="insert into books_category set
				parent_id={$this->db->escape($_POST['parent_id'])},
				category_name={$this->db->escape($_POST['category_name'])},
				des={$this->db->escape($_POST['des'])}";
        return $this->db->query($sql);
    }
    function update_books_category() {
        $books_category_id=$this->session->userdata('books_category_id');
        $sql="update books_category set
				parent_id={$this->db->escape($_POST['parent_id'])},
				category_name={$this->db->escape($_POST['category_name'])},
				des={$this->db->escape($_POST['des'])}
				where books_category_id=$books_category_id";
        return $this->db->query($sql);
    }
    function delete_books_category($books_category_id) {
        $sql="delete from books_category where books_category_id=$books_category_id";
        return $this->db->query($sql);
    }
    function get_user_type_options($sel='') {
        $arr=array('Student','Admin Staffs','Academic Staffs','Guest');
        $opt="<option value=''>Select User Type</option>";
        foreach($arr as $val) {
            if($sel==$val) {
                $opt.="<option value='$val' selected='selected'>$val</option>";
            }else {
                $opt.="<option value='$val'>$val</option>";
            }
        }
        return $opt;
    }

    function get_per_days_options($sel='') {
        $opt="<option value=''>----Select----</option>";
        for($i=1;$i<8;$i++) {
            if($sel==$i.' DAY') {
                $opt.="<option value='$i' selected='selected'>$i DAY</option>";
            }else {
                $opt.="<option value='$i'>$i DAY</option>";
            }
        }
        return $opt;
    }
    function get_library_fines() {
        $sql=$this->db->query("select f.*,concat(u.first_name,' ',u.last_name) as user_name from library_fine as f
								join user as u on f.user_id=u.user_id where 1=1");
        return $sql->result_array();
    }
    function save_library_fines() {
        $user_id=$this->session->userdata('user_id');
        $sql="insert into library_fine set
				user_type={$this->db->escape($_POST['user_type'])},
				days_permitted={$this->db->escape($_POST['days_permitted'])},
				fine_per_day={$this->db->escape($_POST['fine_per_day'])},
				user_id=$user_id";
        return $this->db->query($sql);
    }
    function update_library_fine() {
        $fine_id=$this->session->userdata('fine_id');
        $sql="update library_fine set
				user_type={$this->db->escape($_POST['user_type'])},
				days_permitted={$this->db->escape($_POST['days_permitted'])},
				fine_per_day={$this->db->escape($_POST['fine_per_day'])}
				where fine_id=$fine_id";
        return $this->db->query($sql);
    }
    function get_book_list() {
        $search=$_POST['search'];
        $data.="<ul class='width_160'>";
        if($search!='') {
            $sql="select serial_no,book_name from books where serial_no like '$search%'";
            $res=$this->db->query($sql);
            $djs=$res->result_array();

            foreach($djs as $row) {
                $data.="<li title='".$row['serial_no']."' rel='{$row['book_name']}'>".$row['serial_no'].'</li>';
            }
        }else {
            $data.='<li>Enter Serial No</li>';
        }
        $data.='</ul>';
        return $data;
    }
    function get_issued_books() {
        $sql=$this->db->query("select i.*,b.serial_no,b.book_name,concat(u.first_name,' ',u.last_name) as borrower_name from book_issued as i
                                join books as b on b.books_id=i.books_id
                                join user as u on u.user_name=i.user_name
                                where 1=1");
        return $sql->result_array();
    }
    function filter_issued_books() {
        $con='';
        if($_POST['isbn']!='') {
            $con.=" and b.isbn = '{$_POST['isbn']}'";
        }
        if($_POST['serial_name']!='') {
            $con.=" and b.serial_name like '%{$_POST['serial_name']}%'";
        }
        if($_POST['book_name']!='') {
            $con.=" and b.book_name like '%{$_POST['book_name']}%'";
        }
        if($_POST['author']!='') {
            $con.=" and b.author like '%{$_POST['author']}%'";
        }
        if($_POST['name']!='') {
            $con.=" and u.last_name like '%{$_POST['name']}%'";
        }
        if($_POST['user_name']!='') {
            $con.=" and u.user_name like '%{$_POST['user_name']}%'";
        }
        if($_POST['from_date']!='') {
            $con.=" and i.issue_date BETWEEN '{$_POST['from_date']}' AND '{$_POST['to_date']}'";
        }
        $sql=$this->db->query("select i.*,b.serial_no,b.book_name,concat(u.first_name,' ',u.last_name) as borrower_name from book_issued as i
                                join books as b on b.books_id=i.books_id
                                join user as u on u.user_name=i.user_name
                                where 1=1 $con");
        return $sql->result_array();
    }
    function save_book_issued() {
        $user_id=$this->session->userdata('user_id');
        $book_info=sql::row('books',"serial_no='{$_POST['serial_no']}'",'books_id');
        $books_id=$book_info['books_id'];
        $sql="insert into book_issued set
				user_type={$this->db->escape($_POST['user_type'])},
				user_name={$this->db->escape($_POST['user_name'])},
				books_id={$this->db->escape($books_id)},
				issue_date={$this->db->escape($_POST['issue_date'])},
				expiry_date={$this->db->escape($_POST['expiry_date'])},
				user_id={$this->db->escape($user_id)}";
        return $this->db->query($sql);
    }
    function get_issued_details($issued_id='') {
        $sql=$this->db->query("select i.*,b.serial_no,b.book_name,concat(u.first_name,' ',u.last_name) as borrower_name from book_issued as i
								join books as b on b.books_id=i.books_id
								join user as u on u.user_name=i.user_name
								where issued_id='$issued_id'");
        return $sql->row_array();
    }
    function update_book_issued() {
        $issued_id=$this->session->userdata('issued_id');
        $book_info=sql::row('books',"serial_no='{$_POST['serial_no']}'",'books_id');
        $books_id=$book_info['books_id'];
        $sql="update book_issued set
				user_type={$this->db->escape($_POST['user_type'])},
				user_name={$this->db->escape($_POST['user_name'])},
				books_id={$this->db->escape($books_id)},
				issue_date={$this->db->escape($_POST['issue_date'])},
				expiry_date={$this->db->escape($_POST['expiry_date'])}
				where issued_id=$issued_id";
        return $this->db->query($sql);
    }
    function receive_book() {
        $issued_id=$this->session->userdata('issued_id');
        $book_info=sql::row('books',"serial_no='{$_POST['serial_no']}'",'books_id');
        $books_id=$book_info['books_id'];
        $sql="update book_issued set
				user_type={$this->db->escape($_POST['user_type'])},
				user_name={$this->db->escape($_POST['user_name'])},
				books_id={$this->db->escape($books_id)},
				issue_date={$this->db->escape($_POST['issue_date'])},
				expiry_date={$this->db->escape($_POST['expiry_date'])},
				return_date={$this->db->escape($_POST['return_date'])},
				fine_amount={$this->db->escape($_POST['fine_amount'])},
				paid_amount={$this->db->escape($_POST['paid_amount'])}
				where issued_id=$issued_id";
        return $this->db->query($sql);
    }
}?>