<?php

$config = array(
    'valid_login' => array(
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
    'valid_change_password' => array(
        array('field' => 'old_password', 'label' => 'Old Password', 'rules' => 'required|callback_is_valid_user_password'),
        array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[new_password]')
    ),
    'valid_user' => array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required|alpha_dash|callback_user_name_check'),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
        array('field' => 'designation', 'label' => 'Designation', 'rules' => 'required')
    ),
    'valid_permission' => array(
        array('field' => 'user[]', 'label' => 'User', 'rules' => ''),
        array('field' => 'institution[]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'branch[]', 'label' => 'Branch', 'rules' => ''),
        array('field' => 'ts_config[]', 'label' => 'Configuration', 'rules' => ''),
        array('field' => 'class[]', 'label' => 'class', 'rules' => ''),
        array('field' => 'module[]', 'label' => 'Models', 'rules' => ''),
        array('field' => 'level[]', 'label' => 'level', 'rules' => ''),
        array('field' => 'semester[]', 'label' => 'semester', 'rules' => ''),
        array('field' => 'student[]', 'label' => 'Student', 'rules' => ''),
        array('field' => 'std_account[]', 'label' => 'Student Account', 'rules' => ''),
        array('field' => 'staffs[]', 'label' => 'Staffs', 'rules' => ''),
        array('field' => 'staff_account[]', 'label' => 'Staff Account', 'rules' => ''),
        array('field' => 'agents[]', 'label' => 'Agents', 'rules' => '')
    ),
    'valid_institution_type' => array(
        array('field' => 'institution_type', 'label' => 'Type Name', 'rules' => 'required|alpha'),
    ),
    'valid_type' => array(
        array('field' => 'type_name', 'label' => 'Type Name', 'rules' => 'required'),
        array('field' => 'type_for', 'label' => 'Type For', 'rules' => 'required')
    ),
    'valid_pay_details' => array(
        array('field' => 'details_name', 'label' => 'Details Name', 'rules' => 'required'),
        array('field' => 'pay_details_for', 'label' => 'Payment Details For', 'rules' => 'required'),
        array('field' => 'pay_effect', 'label' => 'Payment Effect', 'rules' => 'required')
    ),
    'valid_status' => array(
        array('field' => 'status_name', 'label' => 'Status Name', 'rules' => 'required'),
        array('field' => 'status_for', 'label' => 'Status For', 'rules' => 'required')
    ),

    'valid_report_status' => array(
        array('field' => 'report_status', 'label' => 'Status Name', 'rules' => 'required'),
        array('field' => 'mark', 'label' => 'Status Mark', 'rules' => 'required|numeric')
    ),

    'valid_country' => array(
        array('field' => 'country_name', 'label' => 'Country Name', 'rules' => 'required'),
        array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'required')
    ),
    'valid_branch' => array(
        array('field' => 'branch_name', 'label' => 'Branch Name', 'rules' => 'required')
    ),
    'valid_awarding_body' => array(
        array('field' => 'awarding_body_name', 'label' => 'Awarding Body Name', 'rules' => 'required'),
        array('field' => 'des', 'label' => 'Description', 'rules' => '')
    ),
    'valid_specialization' => array(
        array('field' => 'specialization_name', 'label' => 'Specialization', 'rules' => 'required'),
        array('field' => 'des', 'label' => 'Description', 'rules' => '')
    ),
    'valid_class' => array(
        array('field' => 'class_code', 'label' => 'Class Code', 'rules' => 'required'),
        array('field' => 'class_name', 'label' => 'Class Name', 'rules' => 'required')
    ),
    'valid_exam' => array(
        array('field' => 'exam_name', 'label' => 'Exam Name', 'rules' => 'required'),
        array('field' => 'exam_fee', 'label' => 'Exam Fee', 'rules' => 'required|numeric')
    ),
    'valid_levels' => array(
        array('field' => 'level_code', 'label' => 'Level Code', 'rules' => 'required'),
        array('field' => 'level_name', 'label' => 'Level Name', 'rules' => 'required')
    ),
    'valid_module' => array(
        array('field' => 'module_code', 'label' => 'Module Code', 'rules' => 'required'),
        array('field' => 'module_name', 'label' => 'Module Name', 'rules' => 'required'),
        array('field' => 'marks', 'label' => 'Marks', 'rules' => 'required'),
        array('field' => 'module_type', 'label' => 'Module Type', 'rules' => 'required')
    ),
    'valid_session' => array(
        array('field' => 'session_name', 'label' => 'Session Name', 'rules' => 'required')
    ),
    'class_map' => array(
        
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class Name', 'rules' => 'required|callback_is_mapping_exist'),
        array('field' => 'class_duration', 'label' => 'Class Duration', 'rules' => 'required'),
        array('field' => 'start_date', 'label' => 'Start Date', 'rules' => 'required'),
        array('field' => 'end_date', 'label' => 'End Date', 'rules' => 'required'),
        array('field' => 'class_fee', 'label' => 'Admission Fee', 'rules' => 'required|numeric'),
        array('field' => 'monthly_fee', 'label' => 'Monthly Fee', 'rules' => 'required|numeric'),
        array('field' => 'staff_id', 'label' => 'Class Teacher', 'rules' => 'required'),
        array('field' => 'exam_id', 'label' => 'Exam', 'rules' => '')
    ),
    'level_map' => array(
        array('field' => 'awarding_body_id', 'label' => 'Awarding Body', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'class Name', 'rules' => 'required'),
        array('field' => 'specialization_id', 'label' => 'Specialization', 'rules' => 'required'),
        array('field' => 'levels_id', 'label' => 'Level', 'rules' => 'required'),
        array('field' => 'level_duration', 'label' => 'Level Duration', 'rules' => 'required'),
        array('field' => 'level_fee', 'label' => 'Level Fee', 'rules' => 'required')
    ),
    'module_map' => array(
        
        array('field' => 'class_id', 'label' => 'Class Name', 'rules' => 'required'),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => 'required')
    ),
    'module_distribution' => array(
        array('field' => 'staffs_id', 'label' => 'Staffs', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'class Name', 'rules' => 'required'),
        array('field' => 'specialization_id', 'label' => 'Specialization', 'rules' => ''),
        array('field' => 'awarding_body_id', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => 'required')
    ),
    'session_map' => array(
        array('field' => 'awarding_body_id', 'label' => 'Awarding Body', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class Name', 'rules' => 'required'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'session_duration', 'label' => 'Session Duration', 'rules' => 'required'),
        array('field' => 'start_date', 'label' => 'Start Date', 'rules' => 'required'),
        array('field' => 'end_date', 'label' => 'End Date', 'rules' => 'required')
    ),
    'agent_basic' => array(
        array('field' => 'user_name', 'label' => 'Agent ID', 'rules' => 'required|alpha_dash'),
        array('field' => 'title', 'label' => 'Title', 'rules' => ''),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required'),
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'date_of_birth', 'label' => 'Date of Birth', 'rules' => 'required'),
        array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'required'),
        array('field' => 'company_name', 'label' => 'Company Name', 'rules' => ''),
        array('field' => 'address_1', 'label' => 'Address 1', 'rules' => ''),
        array('field' => 'address_2', 'label' => 'Address 2', 'rules' => ''),
        array('field' => 'telephone_1', 'label' => 'Telephone 1', 'rules' => ''),
        array('field' => 'telephone_2', 'label' => 'Telephone 2', 'rules' => ''),
        array('field' => 'mobile_1', 'label' => 'Mobile 1', 'rules' => ''),
        array('field' => 'mobile_2', 'label' => 'Mobile 2', 'rules' => ''),
        array('field' => 'fax', 'label' => 'Fax', 'rules' => ''),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
        array('field' => 'agent_type', 'label' => 'Agent Type', 'rules' => ''),
        array('field' => 'agent_status', 'label' => 'Agent Status', 'rules' => 'required'),
        array('field' => 'status_change', 'label' => 'Status Change Date', 'rules' => '')
    ),
    'agent_contact' => array(
        array('field' => 'admission_date', 'label' => 'Admission Date', 'rules' => 'required'),
        array('field' => 'contact_duration', 'label' => 'Contact Duration', 'rules' => 'required'),
        array('field' => 'start_date', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'end_date', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'salary_commission', 'label' => 'salary_commission', 'rules' => 'required'),
        array('field' => 'total_days_per_week', 'label' => 'total_days_per_week', 'rules' => 'required'),
        array('field' => 'total_hours_per_week', 'label' => 'total_hours_per_week', 'rules' => 'required'),
        array('field' => 'salary_type', 'label' => 'salary_type', 'rules' => 'required'),
        array('field' => 'gross_pay', 'label' => 'gross_pay', 'rules' => 'required'),
        array('field' => 'net_pay', 'label' => 'net_pay', 'rules' => 'required'),
        array('field' => 'ni_number', 'label' => 'ni_number', 'rules' => 'required'),
        array('field' => 'reg_fee', 'label' => 'reg_fee', 'rules' => 'required'),
        array('field' => 'min_deposit', 'label' => 'min_deposit', 'rules' => 'required'),
        array('field' => 'int_commission', 'label' => 'int_commission', 'rules' => 'required'),
        array('field' => 'local_commission', 'label' => 'local_commission', 'rules' => 'required'),
        array('field' => 'int_comm_reg_fee', 'label' => 'int_comm_reg_fee', 'rules' => 'required'),
        array('field' => 'local_comm_reg_fee', 'label' => 'local_comm_reg_fee', 'rules' => 'required'),
        array('field' => 'int_comm_tuition_fee', 'label' => 'int_comm_tuition_fee', 'rules' => 'required'),
        array('field' => 'local_comm_tuition_fee', 'label' => 'local_comm_tuition_fee', 'rules' => 'required'),
        array('field' => 'fixed_amt_per_student', 'label' => 'fixed_amt_per_student', 'rules' => 'required'),
        array('field' => 'contact_comment', 'label' => 'Contact Comment', 'rules' => '')
    ),
    'valid_letters_type' => array(
        array('field' => 'title', 'label' => 'Title', 'rules' => 'required')
    ),
    'valid_letters' => array(
        array('field' => 'letters_type_id', 'label' => 'Letter Type', 'rules' => 'required'),
        array('field' => 'letter_title', 'label' => 'Letter  Title', 'rules' => 'required'),
        array('field' => 'des', 'label' => 'Description', 'rules' => 'required')
    ),

    'valid_official_letters' => array(

        array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        array('field' => 'letter_insert_type', 'label' => 'Insert Type', 'rules' => 'required'),
        array('field' => 'letter_url', 'label' => 'Upload Letter', 'rules' => ''),
        array('field' => 'description', 'label' => 'Description', 'rules' => ''),
        array('field' => 'issue_date', 'label' => 'Issue Date', 'rules' => 'required')
    ),

    'staff_department' => array(
        array('field' => 'name', 'label' => 'Department Name', 'rules' => 'required')
    ),
    'staff_training' => array(
        array('field' => 'training_title', 'label' => 'Training Title', 'rules' => 'required'),
        array('field' => 'increment', 'label' => 'Increment Amount', 'rules' => 'required|numeric')
    ),
    'staff_basic' => array(
        array('field' => 'user_name', 'label' => 'Staff ID', 'rules' => 'required|alpha_dash'),
        array('field' => 'title', 'label' => 'Title', 'rules' => ''),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required'),
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'date_of_birth', 'label' => 'Date of Birth', 'rules' => 'required'),
        array('field' => 'present_address', 'label' => 'Present Address', 'rules' => 'required'),
        array('field' => 'permanent_address', 'label' => 'Permanent Address', 'rules' => ''),
        array('field' => 'telephone', 'label' => 'Telephone', 'rules' => ''),
        array('field' => 'mobile', 'label' => 'Mobile', 'rules' => ''),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
        array('field' => 'department_id', 'label' => 'Department', 'rules' => 'required'),
        array('field' => 'designation_id', 'label' => 'Designation', 'rules' => 'required'),
        array('field' => 'mpo_listed', 'label' => 'MPO Listed', 'rules' => 'required'),
        array('field' => 'staff_status', 'label' => 'Staff Status', 'rules' => 'required'),
        array('field' => 'status_change_date', 'label' => 'Status Change Date', 'rules' => ''),
        array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'required'),
        array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'required'),
        array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'required'),
        array('field' => 'qualifications[0]', 'label' => 'Qualification', 'rules' => ''),
        array('field' => 'qualifications[1]', 'label' => 'Qualification', 'rules' => ''),
        array('field' => 'qualifications[2]', 'label' => 'Qualification', 'rules' => ''),
        array('field' => 'qualifications[3]', 'label' => 'Qualification', 'rules' => ''),
        array('field' => 'qualifications[4]', 'label' => 'Qualification', 'rules' => ''),
        array('field' => 'awarding_body[0]', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'awarding_body[1]', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'awarding_body[2]', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'awarding_body[3]', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'awarding_body[4]', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'year[0]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'year[1]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'year[2]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'year[3]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'year[4]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'grade[0]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'grade[1]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'grade[2]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'grade[3]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'grade[4]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'ielts_score', 'label' => 'IELTS Score', 'rules' => ''),
        array('field' => 'qualification_verification', 'label' => 'Comments', 'rules' => '')
    ),
    'staff_contract' => array(
        array('field' => 'admission_date', 'label' => 'Admission Date', 'rules' => 'required'),
        array('field' => 'employ_type', 'label' => 'Employment Type', 'rules' => 'required'),
        array('field' => 'employ_nature', 'label' => 'Employment Nature', 'rules' => 'required'),
        array('field' => 'employ_duration', 'label' => 'Employment Duration', 'rules' => ''),
        array('field' => 'start_date', 'label' => 'Start Date', 'rules' => ''),
        array('field' => 'end_date', 'label' => 'End Date', 'rules' => ''),
        array('field' => 'days_per_week', 'label' => 'Days Per Week', 'rules' => ''),
        array('field' => 'hours_per_week', 'label' => 'Total Hours Per Week', 'rules' => ''),
        array('field' => 'salary_type', 'label' => 'Salary Type', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Amount', 'rules' => 'required'),
        array('field' => 'ni_number', 'label' => 'NI Number', 'rules' => 'required'),
        array('field' => 'contract_comment', 'label' => 'Contract Comment', 'rules' => 'required'),
        array('field' => 'day[0]', 'label' => 'Day', 'rules' => ''),
        array('field' => 'day[1]', 'label' => 'Day', 'rules' => ''),
        array('field' => 'day[2]', 'label' => 'Day', 'rules' => ''),
        array('field' => 'day[3]', 'label' => 'Day', 'rules' => ''),
        array('field' => 'day[4]', 'label' => 'Day', 'rules' => ''),
        array('field' => 'institution_id[0]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'institution_id[1]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'institution_id[2]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'institution_id[3]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'institution_id[4]', 'label' => 'Institution', 'rules' => ''),
        array('field' => 'from_time[0]', 'label' => 'From', 'rules' => ''),
        array('field' => 'from_time[1]', 'label' => 'From', 'rules' => ''),
        array('field' => 'from_time[2]', 'label' => 'From', 'rules' => ''),
        array('field' => 'from_time[3]', 'label' => 'From', 'rules' => ''),
        array('field' => 'from_time[4]', 'label' => 'From', 'rules' => ''),
        array('field' => 'to_time[0]', 'label' => 'To', 'rules' => ''),
        array('field' => 'to_time[1]', 'label' => 'To', 'rules' => ''),
        array('field' => 'to_time[2]', 'label' => 'To', 'rules' => ''),
        array('field' => 'to_time[3]', 'label' => 'To', 'rules' => ''),
        array('field' => 'to_time[4]', 'label' => 'To', 'rules' => ''),
        array('field' => 'shift[0]', 'label' => 'Shift', 'rules' => ''),
        array('field' => 'shift[1]', 'label' => 'Shift', 'rules' => ''),
        array('field' => 'shift[2]', 'label' => 'Shift', 'rules' => ''),
        array('field' => 'shift[3]', 'label' => 'Shift', 'rules' => ''),
        array('field' => 'shift[4]', 'label' => 'Shift', 'rules' => '')
    ),
    'student_basic' => array(
        array('field' => 'user_name', 'label' => 'Student ID', 'rules' => 'required|alpha_dash|callback_user_name_check'),
        array('field' => 'title', 'label' => 'Title', 'rules' => ''),
        array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required'),
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'date_of_birth', 'label' => 'Date of Birth', 'rules' => 'required'),
        array('field' => 'present_address', 'label' => 'Present Address', 'rules' => 'required'),
        array('field' => 'permanent_address', 'label' => 'Permanent Address', 'rules' => ''),
        array('field' => 'nationality', 'label' => 'Nationality', 'rules' => 'required'),
        array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'required'),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'valid_email'),
        array('field' => 'father_name', 'label' => 'Father\'s Name', 'rules' => 'required'),
        array('field' => 'mother_name', 'label' => 'Mother\'s Name', 'rules' => 'required'),
        array('field' => 'parent_address', 'label' => 'Parent Address', 'rules' => 'required'),
        array('field' => 'parent_phone', 'label' => 'Parent Phone', 'rules' => 'required'),
        array('field' => 'admission_date', 'label' => 'Admission Date', 'rules' => 'required'),
        array('field' => 'student_status', 'label' => 'Student Status', 'rules' => 'required'),
        array('field' => 'std_status_date', 'label' => 'Status Change Date', 'rules' => ''),
        array('field' => 'branch_id', 'label' => 'Branch', 'rules' => 'required'),        
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'class_start_date', 'label' => 'Start Date', 'rules' => 'required'),
        array('field' => 'class_end_date', 'label' => 'End Date', 'rules' => 'required'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),        
        array('field' => 'privilege', 'label' => 'Privilege', 'rules' => 'required')
    ),
    'reg_class' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'class_duration', 'label' => 'Duration', 'rules' => ''),
        array('field' => 'class_start_date', 'label' => 'Start Date', 'rules' => 'required'),        
        array('field' => 'class_end_date', 'label' => 'End Date', 'rules' => 'required'),
        array('field' => 'class_status', 'label' => 'Class Status', 'rules' => 'required'),
        array('field' => 'class_status_date', 'label' => 'Class Status Date', 'rules' => ''),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'class_comment', 'label' => 'Comment', 'rules' => '')
    ),
    'reg_level' => array(
        array('field' => 'class_id', 'label' => 'class', 'rules' => 'required'),
        array('field' => 'awarding_body_id', 'label' => 'Awarding Body', 'rules' => 'required'),
        array('field' => 'specialization_id', 'label' => 'Specialization', 'rules' => 'required'),
        array('field' => 'levels_id', 'label' => 'Level', 'rules' => 'required'),
        array('field' => 'level_duration', 'label' => 'Duration', 'rules' => 'required'),
        array('field' => 'level_start_date', 'label' => 'Start Date', 'rules' => 'required'),
        array('field' => 'level_end_date', 'label' => 'End Date', 'rules' => 'required'),
        array('field' => 'level_status', 'label' => 'Level Status', 'rules' => 'required'),
        array('field' => 'level_status_date', 'label' => 'Level Status Date', 'rules' => ''),
        array('field' => 'level_comment', 'label' => 'Comment', 'rules' => '')
    ),
    'reg_session' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'ses_start_date', 'label' => 'Start Date', 'rules' => ''),
        array('field' => 'sem_end_date', 'label' => 'End Date', 'rules' => ''),
        array('field' => 'session_duration', 'label' => 'Session Duration', 'rules' => ''),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'awarding_body_id', 'label' => 'Awarding Body', 'rules' => ''),
        array('field' => 'session_status', 'label' => 'Session Status', 'rules' => 'required'),
        array('field' => 'session_status_date', 'label' => 'Session Status Date', 'rules' => ''),
        array('field' => 'staffs_id', 'label' => 'Personal Tutor', 'rules' => 'required'),
        array('field' => 'module_id[0]', 'label' => 'Module', 'rules' => ''),
        array('field' => 'module_id[1]', 'label' => 'Module', 'rules' => ''),
        array('field' => 'module_id[2]', 'label' => 'Module', 'rules' => ''),
        array('field' => 'module_id[3]', 'label' => 'Module', 'rules' => ''),
        array('field' => 'module_id[4]', 'label' => 'Module', 'rules' => ''),
        array('field' => 'level_name[0]', 'label' => 'Level Name', 'rules' => ''),
        array('field' => 'level_name[1]', 'label' => 'Level Name', 'rules' => ''),
        array('field' => 'level_name[2]', 'label' => 'Level name', 'rules' => ''),
        array('field' => 'level_name[3]', 'label' => 'Level Name', 'rules' => ''),
        array('field' => 'level_name[4]', 'label' => 'Level Name', 'rules' => ''),
        array('field' => 'module_status[0]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_status[1]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_status[2]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_status[3]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_status[4]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'attempt[0]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'attempt[1]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'attempt[2]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'attempt[3]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'attempt[4]', 'label' => 'Year', 'rules' => ''),
        array('field' => 'module_comment[0]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_comment[1]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_comment[2]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_comment[3]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'module_comment[4]', 'label' => 'Grade', 'rules' => '')
    ),
    'valid_notice' => array(
        array('field' => 'notice_title', 'label' => 'Notice Title', 'rules' => 'required'),
        array('field' => 'des', 'label' => 'Description', 'rules' => 'required'),
        array('field' => 'posted_to', 'label' => 'Posted To', 'rules' => 'required'),
        array('field' => 'notice_type', 'label' => 'Notice Type', 'rules' => 'required'),
        array('field' => 'priority', 'label' => 'Priority', 'rules' => 'required'),
        array('field' => 'valid_until', 'label' => 'Valid Until', 'rules' => 'required'),
        array('field' => 'posted_date', 'label' => 'Posted Date', 'rules' => 'required'),
    ),
    'module_result' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'exam_id', 'label' => 'Exam', 'rules' => 'required'),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'exam_date', 'label' => 'Exam Date', 'rules' => 'required|callback_is_result_exist')
    ),
    'generate_result' => array(        
        array('field' => 'marks[]', 'label' => 'Marks', 'rules' => ''),
        array('field' => 'grade[]', 'label' => 'Grade', 'rules' => ''),
        array('field' => 'attempt[]', 'label' => 'attempt', 'rules' => ''),
        array('field' => 'notes[]', 'label' => 'Notes', 'rules' => ''),
        array('field' => 'result_status[]', 'label' => 'Result Status', 'rules' => '')
    ),
    'edit_result' => array(
        array('field' => 'marks', 'label' => 'Marks', 'rules' => 'required'),
        array('field' => 'grade', 'label' => 'Grade', 'rules' => 'required'),
        array('field' => 'attempt', 'label' => 'attempt', 'rules' => 'required'),
        array('field' => 'notes', 'label' => 'Notes', 'rules' => ''),
        array('field' => 'result_status', 'label' => 'Result Status', 'rules' => 'required')
    ),

    /* tutorial result */
    'tutorial_result' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'exam_id', 'label' => 'Exam', 'rules' => 'required'),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'tutorial_date', 'label' => 'Tutorial Date', 'rules' => 'required'),
        array('field' => 'description', 'label' => 'Title/Description', 'rules' => 'required|callback_is_cross_limit'),
        array('field' => 'total_marks', 'label' => 'Total Marks', 'rules' => 'required|numeric'),
    ),
    'generate_tutorial_result' => array(
        array('field' => 'obtained_marks[]', 'label' => 'Obtained Marks', 'rules' => '')
        
    ),
    'edit_tutorial_result' => array(
        array('field' => 'obtained_marks', 'label' => 'Obtained Marks', 'rules' => 'required')
    ),


    'student_grades' => array(
        array('field' => 'user_name', 'label' => 'Student', 'rules' => 'required|callback_is_valid_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required|callback_is_have_reg_class')
    ),
    'valid_report' => array(
        array('field' => 'user_name', 'label' => 'Student', 'rules' => 'required|callback_is_valid_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_registered_student'),
        array('field' => 'exam_id', 'label' => 'Exam', 'rules' => 'required|callback_is_add_report'),
    ),
    'is_valid_student' => array(
        array('field' => 'user_name', 'label' => 'Student', 'rules' => 'required|callback_is_valid_student'),
    ),
    'valid_books_category' => array(
        array('field' => 'category_name', 'label' => 'Category Name', 'rules' => 'required'),
        array('field' => 'des', 'label' => 'Description', 'rules' => ''),
    ),
    'valid_book' => array(
        array('field' => 'isbn', 'label' => 'ISBN', 'rules' => 'required'),
        array('field' => 'serial_no', 'label' => 'Serial No', 'rules' => 'required'),
        array('field' => 'category_id', 'label' => 'Category', 'rules' => 'required'),
        array('field' => 'book_name', 'label' => 'Book Name', 'rules' => 'required'),
        array('field' => 'author', 'label' => 'Author', 'rules' => 'required'),
        array('field' => 'edition', 'label' => 'Edition', 'rules' => 'required'),
        array('field' => 'publication', 'label' => 'Publication', 'rules' => 'required'),
        array('field' => 'book_price', 'label' => 'Book Price', 'rules' => 'required|numeric'),
        array('field' => 'no_of_copies', 'label' => 'No Of Copies', 'rules' => 'required|numeric'),
        array('field' => 'available_copies', 'label' => 'Available Copies', 'rules' => 'required|numeric'),
        array('field' => 'shelf_no', 'label' => 'Publication', 'rules' => 'required'),
        array('field' => 'rack_no', 'label' => 'Publication', 'rules' => 'required')
    ),
    'library_fines' => array(
        array('field' => 'user_type', 'label' => 'User Type', 'rules' => 'required'),
        array('field' => 'days_permitted', 'label' => 'Days Permitted', 'rules' => 'required'),
        array('field' => 'fine_per_day', 'label' => 'Fine Per Day', 'rules' => 'required|numeric')
    ),
    'issue_book' => array(
        array('field' => 'user_type', 'label' => 'User Type', 'rules' => 'required'),
        array('field' => 'user_name', 'label' => 'ID No', 'rules' => 'required|callback_is_valid_id'),
        array('field' => 'borrower_details', 'label' => 'Borrower Details', 'rules' => 'required'),
        array('field' => 'serial_no', 'label' => 'Borrower Details', 'rules' => 'required|callback_is_valid_book'),
        array('field' => 'book_name', 'label' => 'Borrower Details', 'rules' => 'required'),
        array('field' => 'issue_date', 'label' => 'Issue Date', 'rules' => 'required'),
        array('field' => 'expiry_date', 'label' => 'Expiry Date', 'rules' => 'required')
    ),
    'receive_issue_book' => array(
        array('field' => 'return_date', 'label' => 'Return Date', 'rules' => 'required')
    ),
    'valid_std_profile' => array(
        array('field' => 'present_address', 'label' => 'Present Address', 'rules' => 'required'),
        array('field' => 'permanent_address', 'label' => 'Permanent Address', 'rules' => 'required'),
        array('field' => 'phone', 'label' => 'Telephone', 'rules' => ''),
        array('field' => 'mobile', 'label' => 'Mobile', 'rules' => ''),
        array('field' => 'email', 'label' => 'Email', 'rules' => 'valid_email')
    ),
    'valid_exemption' => array(
        array('field' => 'user_name', 'label' => 'Student ID', 'rules' => 'required|callback_is_valid_student'),
        array('field' => 'from_date', 'label' => 'From Date', 'rules' => 'required'),
        array('field' => 'to_date', 'label' => 'To Date', 'rules' => 'required'),
        array('field' => 'reason', 'label' => 'Reason', 'rules' => 'required')
    ),
    'valid_attendance' => array(
        array('field'=>'date','label'=>'Date','rules'=>'required|callback_is_exits_attendance'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),        
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'attendance_type_id', 'label' => 'Class Type', 'rules' => 'required')
        
    ),
    'valid_view_register' => array(
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),        
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'attendance_type_id', 'label' => 'Attendance Type', 'rules' => 'required'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required')
    ),
    'print_attendance' => array(
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => 'required'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'attendance_type', 'label' => 'Class Type', 'rules' => 'required'),
        array('field' => 'taken_by', 'label' => 'Taken By', 'rules' => '')
    ),
    'manage_attendance' => array(
        array('field' => 'user_name', 'label' => 'Student', 'rules' => 'required|callback_is_valid_student'),
        array('field' => 'class_id', 'label' => 'class', 'rules' => 'required'),        
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'attendance_type_id', 'label' => 'Class Type', 'rules' => 'required'),
        array('field' => 'from_date', 'label' => 'From Date', 'rules' => ''),
        array('field' => 'to_date', 'label' => 'To Date', 'rules' => '')
    ),
    'view_attendance' => array(
        array('field' => 'user_name', 'label' => 'Student', 'rules' => 'required|callback_is_valid_student'),
        array('field' => 'class_id', 'label' => 'class', 'rules' => ''),
        array('field' => 'module_id', 'label' => 'Module', 'rules' => ''),
        array('field' => 'session_id', 'label' => 'Smester', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => ''),
        array('field' => 'attendance_type_id', 'label' => 'Class Type', 'rules' => ''),
        array('field' => 'from_date', 'label' => 'From Date', 'rules' => ''),
        array('field' => 'to_date', 'label' => 'To Date', 'rules' => '')
    ),
    // Student Accounts
    'class_fee_reg' => array(
        array('field' => 'class_id', 'label' => 'class', 'rules' => 'required|callback_is_class_fee_exits'),
        array('field' => 'class_fee', 'label' => 'class Fee', 'rules' => 'required|numeric'),
        array('field' => 'class_start_date', 'label' => 'Class Start Date', 'rules' => ''),
        array('field' => 'class_end_date', 'label' => 'Class End Date', 'rules' => ''),
        array('field' => 'reg_fee', 'label' => 'Registration Fee', 'rules' => 'required|numeric'),
        array('field' => 'discount', 'label' => 'Scholorship/Discount', 'rules' => 'required|numeric'),
        array('field' => 'awarding_body_fee', 'label' => 'Awarding Body Fee', 'rules' => 'required|numeric'),
        array('field' => 'deferral', 'label' => 'Deferral', 'rules' => 'required|numeric'),
        array('field' => 'library_fee', 'label' => 'Library Fee', 'rules' => 'required|numeric'),
        array('field' => 'others_fee', 'label' => 'Other Fee', 'rules' => 'required|numeric'),
        array('field' => 'deposit', 'label' => 'Deposit', 'rules' => 'required|numeric'),
        array('field' => 'committed_amount', 'label' => 'Committed Amount', 'rules' => 'required|numeric'),
        array('field' => 'total_balance', 'label' => 'Total balance', 'rules' => 'required|numeric'),
        array('field' => 'class_comment', 'label' => 'Comments', 'rules' => '')
    ),
    'monthly_fee_reg' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'monthly_fee', 'label' => 'Monthly Fee', 'rules' => 'required|numeric'),
        array('field' => 'month', 'label' => 'Month', 'rules' => 'required|callback_is_class_fee_exits'),
        array('field' => 'paid_amount', 'label' => 'Paid Amount', 'rules' => 'required|numeric'),
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required')
    ),
    'admission_fee_reg' => array(
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'admission_fee', 'label' => 'Admission Fee', 'rules' => 'required|numeric|callback_is_admission_fee_exist'),
        array('field' => 'is_paid', 'label' => 'Is Paid', 'rules' => 'required'),
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required')
    ),
    'level_fee_reg' => array(
        array('field' => 'class_id', 'label' => 'class', 'rules' => 'required'),
        array('field' => 'levels_id', 'label' => 'Level', 'rules' => 'required|callback_is_level_fee_exits'),
        array('field' => 'level_fee', 'label' => 'Level Fee', 'rules' => 'required|numeric'),
        array('field' => 'level_extd_date', 'label' => 'Level Extended Date', 'rules' => 'required'),
        array('field' => 'extended_fee', 'label' => 'Extended Level Fee', 'rules' => 'callback_is_level_extended_fee|numeric'),
        array('field' => 'reg_fee', 'label' => 'Registration Fee', 'rules' => 'required|numeric'),
        array('field' => 'discount', 'label' => 'Scholorship/Discount', 'rules' => 'required|numeric'),
        array('field' => 'awarding_body_fee', 'label' => 'Awarding Body Fee', 'rules' => 'required|numeric'),
        array('field' => 'deferral', 'label' => 'Deferral', 'rules' => 'required|numeric'),
        array('field' => 'library_fee', 'label' => 'Library Fee', 'rules' => 'required|numeric'),
        array('field' => 'others_fee', 'label' => 'Other Fee', 'rules' => 'required|numeric'),
        array('field' => 'deposit', 'label' => 'Deposit', 'rules' => 'required|numeric'),
        array('field' => 'committed_amount', 'label' => 'Committed Amount', 'rules' => 'required|numeric'),
        array('field' => 'total_balance', 'label' => 'Total balance', 'rules' => 'required|numeric'),
        array('field' => 'classg_comment', 'label' => 'Comments', 'rules' => '')
    ),
    'fee_installment' => array(
        array('field' => 'class_fee', 'label' => 'Class Fee', 'rules' => 'required|numeric'),
        array('field' => 'total_balance', 'label' => 'Total balance', 'rules' => 'required|numeric'),
        array('field' => 'committed_date', 'label' => 'Committed Date', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Amount', 'rules' => 'required|numeric|callback_is_valid_install_amount'),
        array('field' => 'notes', 'label' => 'Comments', 'rules' => '')
    ),
    'payments' => array(
        array('field' => 'amount', 'label' => 'Amount', 'rules' => 'required|numeric'),
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required'),
        array('field' => 'paid_amount', 'label' => 'Paid Amount', 'rules' => 'required|numeric|callback_is_valid_payments'),
        array('field' => 'pay_mood', 'label' => 'Pay Mood', 'rules' => 'required'),
        array('field' => 'pay_details_id', 'label' => 'Pay Details', 'rules' => 'required'),
        array('field' => 'notes', 'label' => 'Notes', 'rules' => '')
    ),
    //Staff Attendance
    'valid_staff_attd' => array(
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'hours', 'label' => 'Hours Done', 'rules' => 'required|numeric'),
        array('field' => 'extra_hour', 'label' => 'Extra Hour', 'rules' => 'required|numeric'),
        array('field' => 'absent_hour', 'label' => 'Absent Hour', 'rules' => 'required|numeric'),
        array('field' => 'late', 'label' => 'Late', 'rules' => 'required|numeric'),
        array('field' => 'authorize', 'label' => 'Authorize', 'rules' => 'required'),
        array('field' => 'comments', 'label' => 'Comments', 'rules' => '')
    ),
    'view_staff_attendance' => array(
        array('field' => 'user_name', 'label' => 'Staffs ID', 'rules' => 'required|callback_is_valid_staffs'),
        array('field' => 'from_date', 'label' => 'From Date', 'rules' => ''),
        array('field' => 'to_date', 'label' => 'To Date', 'rules' => '')
    ),
    'is_valid_staff' => array(
        array('field' => 'user_name', 'label' => 'Staff', 'rules' => 'required|callback_is_valid_staff'),
    ),
    'staff_payment' => array(
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required'),
        array('field' => 'paid_amount', 'label' => 'Paid Amount', 'rules' => 'required|numeric'),
        array('field' => 'pay_mood', 'label' => 'Pay Mood', 'rules' => 'required'),
        array('field' => 'pay_details_id', 'label' => 'Pay Details', 'rules' => 'required'),
        array('field' => 'month', 'label' => 'Month', 'rules' => 'required'),
        array('field' => 'year', 'label' => 'year', 'rules' => 'required')
//                array('field'=>'dur_from_date','label'=>'Duration','rules'=>'required'),
//                array('field'=>'dur_to_date','label'=>'Duration','rules'=>'required'),
//                array('field'=>'purpose','label'=>'Purpose','rules'=>'required')
    ),
    'staff_balance' => array(
        array('field' => 'month', 'label' => 'Month', 'rules' => 'required'),
        array('field' => 'year', 'label' => 'year', 'rules' => 'required'),
        array('field' => 'previous_due', 'label' => 'previous_due', 'rules' => 'required'),
        array('field' => 'extra_day_hour', 'label' => 'extra_day_hour', 'rules' => 'required'),
        array('field' => 'other_add', 'label' => 'other_add', 'rules' => 'required'),
        array('field' => 'payable_total', 'label' => 'payable_total', 'rules' => 'required'),
        array('field' => 'part_adv_pay', 'label' => 'previous_due', 'rules' => 'required'),
        array('field' => 'absent_day_hour', 'label' => 'absent_day_hour', 'rules' => 'required'),
        array('field' => 'lunch', 'label' => 'lunch', 'rules' => 'required'),
        array('field' => 'other_deduce', 'label' => 'other_deduce', 'rules' => 'required'),
        array('field' => 'deduced_total', 'label' => 'deduced_total', 'rules' => 'required'),
        array('field' => 'total', 'label' => 'total', 'rules' => 'required'),
        array('field' => 'paid_amount', 'label' => 'Paid Amount', 'rules' => 'required|numeric'),
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required'),
        array('field' => 'pay_mood', 'label' => 'Pay Mood', 'rules' => 'required'),
        array('field' => 'pay_details_id', 'label' => 'Pay Details', 'rules' => 'required'),
        array('field' => 'due', 'label' => 'due', 'rules' => 'required'),
        array('field' => 'paid_holidays', 'label' => 'paid_holidays', 'rules' => 'required'),
        array('field' => 'paid_absent', 'label' => 'paid_absent', 'rules' => 'required'),
        array('field' => 'comments', 'label' => 'comments', 'rules' => '')
    ),
    'agent_payment' => array(
        array('field' => 'paid_date', 'label' => 'Paid Date', 'rules' => 'required'),
        array('field' => 'due_amount', 'label' => 'Due Amount', 'rules' => 'required|numeric'),
        array('field' => 'paid_amount', 'label' => 'Paid Amount', 'rules' => 'required|numeric'),
        array('field' => 'agent_balance', 'label' => 'Balance', 'rules' => 'required|numeric'),
        array('field' => 'pay_mood', 'label' => 'Pay Mood', 'rules' => 'required'),
        array('field' => 'pay_details_id', 'label' => 'Pay Details', 'rules' => 'required'),
        array('field' => 'comments', 'label' => 'Comments', 'rules' => '')
    ),
    // Website
    'valid_page' => array(
        array('field' => 'page_name', 'label' => 'Page Name', 'rules' => 'required|alpha|trim'),
        array('field' => 'page_title', 'label' => 'Page Title', 'rules' => 'required'),
        array('field' => 'page_des', 'label' => 'Page Description', 'rules' => ''),
    ),
    /* mass class fee registration */
    'valid_class_fee' => array(
        array('field' => 'register_date', 'label' => 'Date', 'rules' => 'callback_is_exist_class_fee'),        
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'month', 'label' => 'Month', 'rules' => 'required')
    ),
    /* mass admission fee registration */
    'valid_admission_fee' => array(
        array('field' => 'register_date', 'label' => 'Date', 'rules' => 'callback_is_exist_admission_fee'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required')
    ),
    /* mass exam fee registration */
    'valid_exam_fee' => array(
        array('field' => 'register_date', 'label' => 'Date', 'rules' => 'callback_is_exist_exam_fee'),        
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'exam_id', 'label' => 'Exam', 'rules' => 'required')
    ),
    /* mass additional fee registration */
    'valid_additional_fee' => array(
        array('field' => 'register_date', 'label' => 'Date', 'rules' => 'callback_is_exist_additional_fee'),
        array('field' => 'session_id', 'label' => 'Session', 'rules' => 'required|callback_is_have_student'),
        array('field' => 'class_id', 'label' => 'Class', 'rules' => 'required'),
        array('field' => 'section', 'label' => 'Section', 'rules' => 'required'),
        array('field' => 'description', 'label' => 'Description', 'rules' => 'required')
    ),

    /* student additional fee registration */
    'valid_student_additional_fee' => array(
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'fee', 'label' => 'Session', 'rules' => 'required')

    ),

    'staff_designation' => array(
        array('field' => 'designation', 'label' => 'Designation', 'rules' => 'required'),
        array('field' => 'mpo_scale', 'label' => 'MPO Scale', 'rules' => 'required|numeric')        
    )
    ,
    'valid_routine'=>array(
        array('field'=>'session_id','label'=>"Session",'rules'=>'required'),
        array('field'=>'class_id','label'=>"Class",'rules'=>'required'),
        array('field'=>'section','label'=>"Section",'rules'=>'required|callback_is_routine_exist')
    ),
    'valid_routine_details'=>array(
        array('field'=>'day','label'=>"Session",'rules'=>'callback_is_valid_routine')
    )
);
?>