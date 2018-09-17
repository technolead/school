<?php
$config=array(
        'valid_login'=>array(
                array('field'=>'user_name','label'=>'User Name','rules'=>'required'),
                array('field'=>'password','label'=>'Password','rules'=>'required')
        ),
        'valid_change_password'=>array(
                array('field'=>'old_password','label'=>'Old Password','rules'=>'required|callback_is_valid_user_password'),
                array('field'=>'new_password','label'=>'New Password','rules'=>'required'),
                array('field'=>'confirm_password','label'=>'Confirm Password','rules'=>'required|matches[new_password]')
        ),
        'valid_std_profile'=>array(
                array('field'=>'present_address','label'=>'Present Address','rules'=>'required'),
                array('field'=>'permanent_address','label'=>'Permanent Address','rules'=>'required'),
                array('field'=>'phone','label'=>'Telephone','rules'=>''),
                array('field'=>'mobile','label'=>'Mobile','rules'=>''),
                array('field'=>'email','label'=>'Email','rules'=>'valid_email')
        )
);
?>