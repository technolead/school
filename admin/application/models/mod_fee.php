<?php

class mod_fee extends Model {

    function mod_fee() {
        parent::Model();
    }

    /* mass class fee registration process */

    function register_class_fee() {
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $class_details = sql::row("class_map", "class_map_id=$class_map_id");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "month" => $_POST['month'],
            "section" => $_POST['section'],
            "monthly_fee" => $class_details['monthly_fee'],
            "register_date" => $_POST['register_date'],
            "user_id" => $user_id
        );
        $this->db->insert("class_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_class_fee() {
        $class_fee_register_id = $this->session->userdata('class_fee_register_id');
        $register_date = $this->session->userdata('register_date');
        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $fine = $_POST['fine_' . $student_id];

                    $privilege=$_POST["privilege_".$student_id];
                    if($privilege==0){
                        $fee=$_POST["monthly_fee_".$student_id];
                    }else{
                        if($_POST["fee_".$student_id]!=""){
                            $fee=$_POST["fee_".$student_id];
                        }else{
                            $fee=$_POST["monthly_fee_".$student_id];
                        }
                    }


                    $data = array(
                        "class_fee_register_id" => $class_fee_register_id,
                        "student_id" => $student_id,
                        "fee"=>$fee,
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? $register_date : '',
                        "fine" => $fine,
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_class_fee", $data);
                }
            }
        }

        return;
    }

    function update_mass_class_fee() {

        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $fine = $_POST['fine_' . $student_id];
                    $class_fee_id_index = "class_fee_id_" . $student_id;
                    $class_fee_id = $_POST[$class_fee_id_index];

                    $privilege=$_POST["privilege_".$student_id];
                    if($privilege==0){
                        $fee=$_POST["monthly_fee_".$student_id];
                    }else{
                        if($_POST["fee_".$student_id]!=""){
                            $fee=$_POST["fee_".$student_id];
                        }else{
                            $fee=$_POST["monthly_fee_".$student_id];
                        }
                    }


                    if ($class_fee_id != '') {
                        $class_row = sql::row("std_class_fee", "class_fee_id=$class_fee_id");
                        if ($class_row['is_paid'] == 0) {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "fine" => $fine,
                                "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                                "user_id" => $user_id
                            );
                        } else {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "fine" => $fine,
                                "paid_date" => ($is_paid == 1) ? $class_row['paid_date'] : '',
                                "user_id" => $user_id
                            );
                        }

                        $this->db->update("std_class_fee", $data, array("class_fee_id" => $class_fee_id));
                    } else {
                        $data = array(
                            "class_fee_register_id" => $this->session->userdata('class_fee_register_id'),
                            "student_id" => $student_id,
                            "fee"=>$fee,
                            "is_paid" => $is_paid,
                            "fine" => $fine,
                            "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                            "user_id" => $user_id
                        );
                        $this->db->insert("std_class_fee", $data);
                    }
                }
            }
        }

        return;
    }

    function get_class_fee_register_id($class_map_id) {
        $sql = $this->db->query("select * from class_fee_register where class_map_id=$class_map_id
                               and month='$_POST[month]' and section='$_POST[section]'");
        $register = $sql->row_array();
        return $register['class_fee_register_id'];
    }

    /* mass admission fee registration process */

    function register_admission_fee() {
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $class_details = sql::row("class_map", "class_map_id=$class_map_id");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "admission_fee" => $class_details['class_fee'],
            "register_date" => $_POST['register_date'],
            "user_id" => $user_id
        );
        $this->db->insert("admission_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_admission_fee() {
        $admission_fee_register_id = $this->session->userdata('admission_fee_register_id');
        $register_date = $this->session->userdata('register_date');
        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $privilege=$_POST["privilege_".$student_id];
                    if($privilege==0){
                        $fee=$_POST["admission_fee_".$student_id];
                    }else{
                        if($_POST["fee_".$student_id]!=""){
                            $fee=$_POST["fee_".$student_id];
                        }else{
                            $fee=$_POST["admission_fee_".$student_id];
                        }
                    }


                    $data = array(
                        "admission_fee_register_id" => $admission_fee_register_id,
                        "student_id" => $student_id,
                        "fee"=>$fee,
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? $register_date : '',
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_admission_fee", $data);
                }
            }
        }

        return;
    }

    function update_mass_admission_fee() {

        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $admission_fee_id_index = "admission_fee_id_" . $student_id;
                    $admission_fee_id = $_POST[$admission_fee_id_index];

                    $privilege=$_POST["privilege_".$student_id];
                    if($privilege==0){
                        $fee=$_POST["admission_fee_".$student_id];
                    }else{
                        if($_POST["fee_".$student_id]!=""){
                            $fee=$_POST["fee_".$student_id];
                        }else{
                            $fee=$_POST["admission_fee_".$student_id];
                        }
                    }


                    if ($admission_fee_id != '') {
                        $admission_row = sql::row("std_admission_fee", "admission_fee_id=$admission_fee_id");
                        if ($admission_row['is_paid'] == 0) {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                                "user_id" => $user_id
                            );
                        } else {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? $admission_row['paid_date'] : '',
                                "user_id" => $user_id
                            );
                        }
                        $this->db->update("std_admission_fee", $data, array("admission_fee_id" => $admission_fee_id));
                    } else {
                        $data = array(
                            "admission_fee_register_id" => $this->session->userdata('admission_fee_register_id'),
                            "student_id" => $student_id,
                            "fee"=>$fee,
                            "is_paid" => $is_paid,
                            "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                            "user_id" => $user_id
                        );
                        $this->db->insert("std_admission_fee", $data);
                    }
                }
            }
        }

        return;
    }

    function get_admission_fee_register_id($class_map_id) {
        $sql = $this->db->query("select * from admission_fee_register where class_map_id=$class_map_id");
        $register = $sql->row_array();
        return $register['admission_fee_register_id'];
    }

    /* mass exam fee registration process */

    function register_exam_fee() {
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);
        $exam_details = sql::row("exam", "exam_id=$_POST[exam_id]");
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "exam_id" => $_POST['exam_id'],
            "exam_fee" => $exam_details['exam_fee'],
            "register_date" => $_POST['register_date'],
            "user_id" => $user_id
        );
        $this->db->insert("exam_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_exam_fee() {
        $exam_fee_register_id = $this->session->userdata('exam_fee_register_id');
        $register_date = $this->session->userdata('register_date');
        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $data = array(
                        "exam_fee_register_id" => $exam_fee_register_id,
                        "student_id" => $student_id,
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? $register_date : '',
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_exam_fee", $data);
                }
            }
        }

        return;
    }

    function update_mass_exam_fee() {

        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $exam_fee_id_index = "exam_fee_id_" . $student_id;
                    $exam_fee_id = $_POST[$exam_fee_id_index];

                    if ($exam_fee_id != '') {
                        $exam_row = sql::row("std_exam_fee", "exam_fee_id=$exam_fee_id");
                        if ($exam_row['is_paid'] == 0) {
                            $data = array(
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                                "user_id" => $user_id
                            );
                        } else {
                            $data = array(
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? $exam_row['paid_date'] : '',
                                "user_id" => $user_id
                            );
                        }

                        $this->db->update("std_exam_fee", $data, array("exam_fee_id" => $exam_fee_id));
                    } else {
                        $data = array(
                            "exam_fee_register_id" => $this->session->userdata('exam_fee_register_id'),
                            "student_id" => $student_id,
                            "is_paid" => $is_paid,
                            "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                            "user_id" => $user_id
                        );
                        $this->db->insert("std_exam_fee", $data);
                    }
                }
            }
        }

        return;
    }

    function get_exam_fee_register_id($class_map_id, $exam_id) {
        $sql = $this->db->query("select * from exam_fee_register where class_map_id=$class_map_id and exam_id=$exam_id");
        $register = $sql->row_array();
        return $register['exam_fee_register_id'];
    }




    /* mass additional fee registration process */

    function register_additional_fee() {
        $class_map_id = common::get_class_map_id($_POST['session_id'], $_POST['class_id']);        
        $user_id = $this->session->userdata('user_id');
        $data = array(
            "class_map_id" => $class_map_id,
            "section"=>$_POST['section'],
            "description" => $_POST['description'],
            "register_date" => $_POST['register_date'],
            "user_id" => $user_id
        );
        $this->db->insert("additional_fee_register", $data);
        return $this->db->insert_id();
    }

    function save_mass_additional_fee() {
        $additional_fee_register_id = $this->session->userdata('additional_fee_register_id');
        $register_date = $this->session->userdata('register_date');
        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $fee=$_POST['fee_'.$student_id];
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $data = array(
                        "additional_fee_register_id" => $additional_fee_register_id,
                        "student_id" => $student_id,
                        "fee"=>$fee,
                        "is_paid" => $is_paid,
                        "paid_date" => ($is_paid == 1) ? $register_date : '',
                        "user_id" => $user_id
                    );
                    $this->db->insert("std_additional_fee", $data);
                }
            }
        }

        return;
    }

    function update_mass_additional_fee() {

        $user_id = $this->session->userdata('user_id');

        if (count($_POST['student_id']) > 0) {
            foreach ($_POST['student_id'] as $student_id) {
                if (common::student_is_delete($student_id) == false) {
                    $fee=$_POST['fee_'.$student_id];
                    $is_paid = $_POST['is_paid_' . $student_id];
                    $additional_fee_id_index = "additional_fee_id_" . $student_id;
                    $additional_fee_id = $_POST[$additional_fee_id_index];
                    if ($additional_fee_id != '') {
                        $additional_row = sql::row("std_additional_fee", "additional_fee_id=$additional_fee_id");
                        if ($additional_row['is_paid'] == 0) {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                                "user_id" => $user_id
                            );
                        } else {
                            $data = array(
                                "fee"=>$fee,
                                "is_paid" => $is_paid,
                                "paid_date" => ($is_paid == 1) ? $additional_row['paid_date'] : '',
                                "user_id" => $user_id
                            );
                        }
                        $this->db->update("std_additional_fee", $data, array("additional_fee_id" => $additional_fee_id));
                    } else {
                        $data = array(
                            "additional_fee_register_id" => $this->session->userdata('additional_fee_register_id'),
                            "student_id" => $student_id,
                            "fee"=>$fee,
                            "is_paid" => $is_paid,
                            "paid_date" => ($is_paid == 1) ? date('Y-m-d') : '',
                            "user_id" => $user_id
                        );
                        $this->db->insert("std_additional_fee", $data);
                    }
                }
            }
        }

        return;
    }

    function get_additional_fee_register_id($class_map_id) {
        $sql = $this->db->query("select * from additional_fee_register where class_map_id=$class_map_id");
        $register = $sql->row_array();
        return $register['additional_fee_register_id'];
    }

}
?>
