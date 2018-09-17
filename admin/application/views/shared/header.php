<?php if(common::is_logged_in()) { ?>
<div class="top_menu">
        <?php if(common::is_admin_user()) { ?>
    <ul class="sf-menu">
        <li><a href="<?=site_url('home')?>" title='Home' class="white">Home</a></li>
        <li><a href="<?=site_url('home')?>" title='Home' class="white">Website</a>
            <ul>
                <li><a href="<?=site_url('settings/websetting')?>">Web Settings</a>
                    <ul>
                        <li><a href="<?=site_url('settings/websetting')?>">Meta Content Settings</a></li>
                        <li><a href="<?=site_url('settings/contact')?>">Contact Information</a></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('slider')?>">Home Slider</a>
                    <ul>
                        <li><a href="<?=site_url('slider')?>">View Sliders</a></li>
                        <li><a href="<?=site_url('slider/new_slider')?>">Add New Slider</a></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('content')?>">Website Content</a>
                    <ul>
                        <li><a href="<?=site_url('content')?>">Contents</a>
                            <ul>
                                <li><a href="<?=site_url('content')?>">Manage Contents</a></li>
                                <li><a href="<?=site_url('content/new_content')?>">Add New Content</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('content/site_logo')?>">Site Logo</a></li>
                        <li><a href="<?=site_url('content/menus')?>">Top Menu</a>
                            <ul>
                                <li><a href="<?=site_url('content/menus')?>">Manage Top Menu</a></li>
                                <li><a href="<?=site_url('content/new_menu')?>">Add New Menu</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('content/sub_menus')?>">Left Menu</a>
                             <ul>
                                <li><a href="<?=site_url('content/sub_menus')?>">Manage Left Menu</a></li>
                                <li><a href="<?=site_url('content/new_submenu')?>">Add New Menu</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('content/page_images')?>">Page Images</a>
                            <ul>
                                <li><a href="<?=site_url('content/page_images')?>">Manage Page Images</a></li>
                                <li><a href="<?=site_url('content/new_page_image')?>">Add Page Image</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('content/right_contents')?>">Right Content</a>
                            <ul>
                                <li><a href="<?=site_url('content/right_contents')?>">Manage Right Content</a></li>
                                <li><a href="<?=site_url('content/new_right_content')?>">Add Right Content</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('web_settings')?>">Useful Links</a>
                             <ul>
                                <li><a href="<?=site_url('web_settings')?>">Manage Links</a></li>
                                <li><a href="<?=site_url('web_settings/new_link')?>">Add New Link</a></li>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('web_settings/featured')?>">Home Featured Box</a>
                             <ul>
                                <li><a href="<?=site_url('web_settings/featured')?>">Manage Featured</a></li>
                                <li><a href="<?=site_url('web_settings/new_featured')?>">Add New Featured</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="<?=site_url('news')?>">Website News</a>
                    <ul>
                        <li><a href="<?=site_url('news')?>">Manage News</a></li>
                        <li><a href="<?=site_url('news/new_news')?>">Add News</a></li>
                        <li><a href="<?=site_url('news/category')?>">Manage News Category</a></li>
                        <li><a href="<?=site_url('news/new_category')?>">Add New Category</a></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('events')?>">Website Events</a>
                    <ul>
                        <li><a href="<?=site_url('events')?>">Manage Events</a></li>
                        <li><a href="<?=site_url('events/new_event')?>">Add New Event</a></li>
                        <li><a href="<?=site_url('events/category')?>">Manage Events Category</a></li>
                        <li><a href="<?=site_url('events/new_category')?>">Add New Category</a></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('static_pages')?>">Static Pages</a>
                    <ul>
                        <li><a href="<?=site_url('static_pages')?>">Manage Pages</a></li>
                        <li class="round"><a href="<?=site_url('static_pages/new_page')?>">Add New Page</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="current"><a href="#a" class="white">Configurations</a>
            <ul><li class="current"><a href="#ab">Site Settings</a>
                    <ul>
                        <?php if(common::is_admin_logged()) {?><li><a href="<?=site_url('settings')?>">Email Settings</a></li><?php }?>
                        <li class="round"><a href="<?=site_url('settings/change_password')?>">Change Password</a></li>
                    </ul>
                </li>

                <li><a href="#">Branch</a>
                    <ul>
                        <?php if(common::user_permit('view','branch')): ?>
                            <li><a href="<?=site_url('settings/branch')?>">View Branch</a></li>
                            <?php if(common::user_permit('add','branch')) {?>
                            <li class="round"><a href="<?=site_url('settings/new_branch')?>">New Branch</a></li>
                            <?php }?>
                        <?endif;?>
                     </ul>
                </li>

                <?php if(common::user_permit('view','grade')): ?>
                    <li><a href="<?=site_url('settings/set_grade')?>">Grade Settings</a></li>
                <?endif;?>

                <?php if(common::user_permit('add','marking')): ?>
                    <li><a href="<?=site_url('settings/set_marking')?>">Mark Settings</a></li>
                <?endif;?>
                    
                <?php if(common::is_admin_logged()): ?>
                <li><a href="#">Alert</a>
                    <ul>
                        <li><a href="<?=site_url('settings/set_attendance')?>">Attendance Settings</a></li>
                    </ul>
                </li>
                <?php endif;?>
                        
                <?php if(common::is_admin_logged()):?>
                <li><a href="#user">Site Users</a>
                    <ul>
                        <li><a href="<?=site_url('user')?>">View Users</a></li>
                        <li><a href="<?=site_url('user/new_user')?>">Add New User</a></li>
                        <li class="round"><a href="<?=site_url('user/user_log')?>">User Login History</a></li>
                    </ul>
                </li>
                <?php endif;?>
                <li><a href="#">Class</a>
                    <ul>
                        <?php if(common::user_permit('view','class')): ?>
                        
                        <?php if(common::user_permit('view','session')): ?>
                        <li><a href="<?=site_url('session')?>">Session</a>
                            <ul>
                                <li><a href="<?=site_url('session')?>">View Session</a></li>
                                            <?php if(common::user_permit('add','session')) {?><li><a href="<?=site_url('session/new_session')?>">Add New Session</a></li><?php }?>
                                <!--<li><a href="<?=site_url('session/mapping')?>">View Mapping</a></li>
                                            <?php if(common::user_permit('add','session')) {?><li class="round"><a href="<?=site_url('session/new_mapping')?>">Session Mapping</a></li><?php }?>-->
                            </ul>
                        </li>
                        <?php endif;?>


                        <li><a href="<?=site_url('class')?>">Class</a>
                            <ul>
                                <li><a href="<?=site_url('classes')?>">View Classes</a></li>
                                            <?php if(common::user_permit('add','class')) {?><li><a href="<?=site_url('classes/new_class')?>">Add New Class</a></li><?php }?>
                                <li><a href="<?=site_url('classes/mapping')?>">View Mappings</a></li>
                                            <?php if(common::user_permit('add','class')) {?><li class="round"><a href="<?=site_url('classes/new_mapping')?>">Add New Mapping</a></li><?php }?>
                            </ul>
                        </li>
                        <?php endif;?>
                       
                        <li><a href="<?=site_url('scms_config/index/SECTION')?>">Section</a></li>


                        <?php if(common::user_permit('view','module')) : ?>
                        <li><a href="#modules">Subjects</a>
                            <ul>
                                <li><a href="<?=site_url('modules')?>">View Subjects</a></li>
                                            <?php if(common::user_permit('add','module')) {?><li><a href="<?=site_url('modules/new_module')?>">Add New Subject</a></li><?php }?>
                                <li><a href="<?=site_url('modules/mapping')?>">View Subject Mapping</a></li>
                                            <?php if(common::user_permit('add','module')) {?><li class="round"><a href="<?=site_url('modules/new_mapping')?>">New Subject Mapping</a></li><?php }?>
                            </ul>
                        </li>
                        <?php endif;?>


                        <?php if(common::user_permit('view','routine')) : ?>
                        <li><a href="#routine">Class Routine</a>
                            <ul>
                                <li><a href="<?=site_url('classes/routine')?>">View Class Routine</a></li>
                                <?php if(common::user_permit('add','routine')) {?><li class="round"><a href="<?=site_url('classes/new_routine')?>">New Class Routine</a></li><?php }?>
                            </ul>
                        </li>
                        <?php endif;?>
                        
                        
                        
                        
                        
                        <?php if(common::user_permit('view','exam')) : ?>
                        <li class="round"><a href="#exam">Exams</a>
                            <ul>
                                <li><a href="<?=site_url('classes/exam')?>">View Exams</a></li>
                                <?php if(common::user_permit('add','exam')) {?><li class="round"><a href="<?=site_url('classes/new_exam')?>">Add New Exams</a></li><?php }?>
                                
                            </ul>
                        </li>
                        <?php endif;?>

                        <!--<?php if(common::user_permit('view','ts_config')): ?>
                        <li class="round"><a href="#">Config</a>
                            <ul>
                                <li><a href="<?=site_url('scms_config/manage_status/CLASS_STATUS')?>">Class Status</a></li>
                                <li><a href="<?=site_url('scms_config/manage_status/SUBJECT_STATUS')?>">Module Status</a></li>
                                <li><a href="<?=site_url('scms_config/index/SUBJECT_TYPE')?>">Module Type</a></li>
                                <li  class="round"><a href="<?=site_url('scms_config/manage_status/SESSION_STATUS')?>">Session Status</a></li>
                            </ul>
                        </li>
                        <?php endif;?>-->
                    </ul>
                </li>
                <?php if(common::user_permit('view','ts_config')): ?>
                <li><a href="#">Student</a>
                    <ul>
                        <!--<li><a href="<?=site_url('scms_config/index/STUDENT_TYPE')?>">Student Type</a></li>
                        <li><a href="<?=site_url('scms_config/manage_status/STUDENT_STATUS')?>">Student Status</a></li>-->
                        <li><a href="<?=site_url('scms_config/index/STD_ATTENDANCE')?>">Attendance Class Type</a></li>
                        
                        <li><a href="<?=site_url('scms_config/index/SUBJECT_ATTEMPT')?>">Subject Attempt</a></li>
                        <li class="round"><a href="<?=site_url('scms_config/manage_report_status')?>">Student Report Status</a></li>
                    </ul>
                </li>
                <li><a href="#">Staffs</a>
                    <ul>
                        <li><a href="<?=site_url('staffs/department')?>">Staff Department</a>
                            <ul>
                                <li><a href="<?=site_url('staffs/department')?>">View Departments</a></li>
                                <?php if(common::user_permit('add','ts_config')) {?><li class="round"><a href="<?=site_url('staffs/new_department')?>">Add New Department</a></li><?php }?>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('#')?>">Designation-MPO Scale</a>
                            <ul>
                                <li><a href="<?=site_url('staffs/designation')?>">View Designation</a></li>
                                <?php if(common::user_permit('add','ts_config')) {?><li class="round"><a href="<?=site_url('staffs/new_designation')?>">Add New Designation</a></li><?php }?>
                            </ul>
                        </li>
                        <li><a href="<?=site_url('staffs/training')?>">Training</a></li>
                        <li><a href="<?=site_url('scms_config/manage_status/STAFFS_STATUS')?>">Staff Status</a></li>
                        <li><a href="<?=site_url('scms_config/index/SALARY_TYPE')?>">Salary Type</a></li>
                        <li><a href="<?=site_url('scms_config/index/EMPLOYMENT_TYPE')?>">Employment Type</a></li>
                        <li class="round"><a href="<?=site_url('scms_config/index/EMPLOYMENT_NATURE')?>">Employment Nature</a></li>
                    </ul>
                </li>
                
                <li><a href="<?=site_url('scms_config/manage_country')?>" class="fly">Countries</a>
                    <ul>
                        <li><a href="<?=site_url('scms_config/manage_country')?>">View Countries</a></li>
                        <?php if(common::user_permit('add','ts_config')) {?><li class="round"><a href="<?=site_url('scms_config/new_country')?>">Add New Country</a></li><?php }?>
                    </ul>
                </li>
                <li class="round"><a href="<?=site_url('scms_config/payment_details')?>" class="fly">Payment Details</a>
                    <ul>
                        <li><a href="<?=site_url('scms_config/payment_details')?>">View Payment Details</a></li>
                        <?php if(common::user_permit('add','ts_config')) {?><li><a href="<?=site_url('scms_config/new_pay_details')?>">New Payment Details</a></li><?php }?>
                        <?php if(common::user_permit('view','ts_config')): ?>
                        <li class="round"><a href="#">Config</a>
                            <ul>
                                <li class="round"><a href="<?=site_url('scms_config/index/PAY_MOOD')?>">Pay Mood</a></li>
                                
                            </ul>
                        </li>
                        <?php endif;?>
                    </ul>
                </li>
                <?php endif;?>
            </ul>
        </li>

        <li><a href="#" class="white">Students</a>
            <ul>
                <?php if(common::user_permit('view','student')) :?>
                <li><a href="<?=site_url('student/manage_students')?>">Students</a>
                    <ul>
                        <li><a href="<?=site_url('student/manage_students')?>">View Student List</a></li>
                        <?php if(common::user_permit('add','student')) {?><li class="round"><a href="<?=site_url('student/new_student')?>">Add New Student</a></li><?php }?>
                    </ul>
                </li>
                <?php endif;?>


                <li><a href="<?=site_url('attendance')?>">Attendance</a>
                    <ul>
                        <?php if(common::user_permit('add','arv_attd')) {?><li><a href="<?=site_url('attendance/record_attendance')?>">Record Attendance</a></li><?php }?>
                        <?php if(common::user_permit('delete','arv_attd')) {?><li><a href="<?=site_url('attendance')?>">View Register</a></li><?php }?>
                        <?php if(common::user_permit('delete','arv_attd')) {?><li><a href="<?=site_url('attendance/view_summary')?>">View Attendance</a></li><?php }?>

                        <!--  have to disable this option, coz this module is incomplete/meaningless, should modify later
                        <?php if(common::user_permit('add','print_attd')):?>
                        <li><a href="<?=site_url('attendance/print_attendance')?>">Print Attendance</a>
                            <ul>
                                <li><a href="<?=site_url('attendance/mng_print_attendance')?>">Manage Print Attendance</a></li>
                                <?php if(common::user_permit('add','print_attd')) {?>
                                <li class="round"><a href="<?=site_url('attendance/print_attendance')?>">Print Attendance</a></li>
                                <?php }?>
                            </ul>
                        </li>
                        <?php endif;?>
                        -->

                        <?php if(common::user_permit('view','std_attendance')):?>
                        <li><a href="<?=site_url('attendance/view_attendance')?>">Student Attendance</a>
                            <ul>
                                <?php if(common::user_permit('add','std_attendance')) {?><li><a href="<?=site_url('attendance/manage_attendance')?>">Manage Attendance</a></li><?php }?>
                                <?php if(common::user_permit('view','std_attendance')) {?><li><a href="<?=site_url('attendance/view_attendance')?>">View Attendance</a></li><?php }?>
                            </ul>
                        </li>
                        <?php endif;?>

                        <?php if(common::user_permit('view','exemption')):?>
                        <li><a href="<?=site_url('exemption')?>">Exemption</a>
                            <ul>
                                <li><a href="<?=site_url('exemption')?>">View Exemption</a></li>
                                <?php if(common::user_permit('add','exemption')) {?><li class="round"><a href="<?=site_url('exemption/new_exemption')?>">Add Exemption</a></li><?php }?>
                            </ul>
                        </li>
                        <?php endif;?>

                        <li class="round"><a href="<?=site_url('prev_attd')?>">Previous Attendance</a>
                            <ul>
                                <li><a href="<?=site_url('prev_attd')?>">View Attendance</a></li>
                                <li class="round"><a href="<?=site_url('prev_attd/new_attd')?>">Add Attedance</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <?php if(common::user_permit('view','fee')):?>
                <li><a href="#">Fees</a>
                    <ul>
                        <? if(common::user_permit('add','class_fee')) {?><li><a href="<?=site_url('fee/register_class_fee')?>">Register Class Fee</a></li><?}?>
                        <? if(common::user_permit('view','class_fee')) {?><li><a href="<?=site_url('fee/view_class_fee')?>">View Class Fee</a></li><?}?>
                        <? if(common::user_permit('add','admission_fee')) {?><li><a href="<?=site_url('fee/register_admission_fee')?>">Register Admission Fee</a></li><?}?>
                        <? if(common::user_permit('view','admission_fee')) {?><li><a href="<?=site_url('fee/view_admission_fee')?>">View Admission Fee</a></li><?}?>
                        <? if(common::user_permit('add','exam_fee')) {?><li><a href="<?=site_url('fee/register_exam_fee')?>">Register Exam Fee</a></li><?}?>
                        <? if(common::user_permit('view','exam_fee')) {?><li><a href="<?=site_url('fee/view_exam_fee')?>">View Exam Fee</a></li><?}?>
                        <? if(common::user_permit('add','additional_fee')) {?><li><a href="<?=site_url('fee/register_additional_fee')?>">Register Additional Fee</a></li><?}?>
                        <? if(common::user_permit('view','additional_fee')) {?><li><a href="<?=site_url('fee/view_additional_fee')?>">View Additional Fee</a></li><?}?>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','result')):?>
                <li><a href="<?=site_url('result')?>">Result</a>
                    <ul>
                        <li><a href="<?=site_url('result/students_grades')?>">Student's Grades</a></li>
                        <?php if(common::user_permit('view','result')) {?><li><a href="<?=site_url('result/new_tutorial_result')?>">Add Tutorial Result</a></li><?php }?>
                        <li><a href="<?=site_url('result/tutorial_result')?>">View Tutorial Result</a></li>
                        <?php if(common::user_permit('view','result')) {?><li><a href="<?=site_url('result/new_module_result')?>">Add Subject Result</a></li><?php }?>
                        <li class="round"><a href="<?=site_url('result')?>">View Subject Result</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','progress_rep')):?>
                <li><a href="<?=site_url('report')?>">Progress Report</a>
                    <ul>
                        <li><a href="<?=site_url('report')?>">View Progress Report</a></li>
                                    <?php if(common::user_permit('view','progress_rep')) {?> <li class="round"><a href="<?=site_url('report/new_report')?>">New Progress Report</a></li><?php }?>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','std_account')):?>
                <li><a href="<?=site_url('accounts')?>">Accounts</a>
                    <ul>
                        <li><a href="<?=site_url('accounts')?>">Student Accounts</a></li>
                         <!--<li><a href="<?=site_url('accounts/mng_accounts')?>">Manage Student Accounts</a></li>-->
                    </ul>
                </li>
                <?php endif;?>
                 <?php if(common::user_permit('view','alert') || common::user_permit('add','alert')): ?>
                        <li class="round"><a href="<?=site_url('alert')?>">Student Alert</a>
                            <ul>
                                
                                <?php if(common::user_permit('add','alert')) { ?><li><a href="<?=site_url('alert/attendance')?>">Attendance Alert</a></li><?php }?>
                            </ul>
                        </li>
                 <?php endif;?>
            </ul>
        </li>
        <li>
            <a href="#" class="white">Staffs</a>
            <ul>
                        <?php if(common::user_permit('view','staffs')) {?>
                <li><a href="<?=site_url('staffs/manage_staffs')?>">View Staff List</a></li>
                            <?php if(common::user_permit('add','staffs')) {?><li><a href="<?=site_url('staffs/new_staff')?>">Add New Staff</a></li><?php }?>
                            <?php }?>
                        <?php if(common::user_permit('view','staff_attendance')) {?>
                <li><a href="<?=site_url('staff_attd')?>">Staff Attendance</a>
                    <ul>
                                    <?php if(common::user_permit('add','staff_attendance')) {?><li><a href="<?=site_url('staff_attd')?>">Record Attendance</a></li><?php }?>
                        <li><a href="<?=site_url('staff_attd/mng_attendance')?>">View Attendance Register</a></li>
                                    <?php if(common::user_permit('add','staff_attendance')) {?><li class="round"><a href="<?=site_url('staff_attd/view_attendance')?>">View Attendance</a></li><?php }?>
                    </ul>
                </li>
                            <?php }?>
                <?php if(common::user_permit('add','staff_account')):?>
                <li><a href="<?=site_url('staff_account')?>">Accounts</a>
                    <ul>
                        <li><a href="<?=site_url('staff_account')?>">Staff Accounts</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('add','module')):?>
                <li ><a href="#modules">Subject Distribution</a>
                    <ul>
                        <li><a href="<?=site_url('modules/mng_distribution')?>">View Subject Distribution</a></li>
                                    <?php if(common::user_permit('add','module')) {?><li class="round"><a href="<?=site_url('modules/module_distribution')?>">New Subject Distribution</a></li><?php }?>
                    </ul>
                </li>
                <?php endif;?>

                 <!--<?php if(common::user_permit('view','staffs')):?>
                <li class="round"><a href="<?=site_url('staffs/routine')?>">Staff Routine</a>
                <? endif;?>-->
                
            </ul>
        </li>

       

        <?php if(common::user_permit('view','letters')):?>
        <li><a href="#" class="white">Letters</a>
            <ul>

                <li><a href="<?=site_url('letters/letters_type')?>" class="fly">Letters Type</a>
                    <ul>
                        <li><a href="<?=site_url('letters/letters_type')?>">View Letters Type</a></li>
                                    <?php if(common::user_permit('add','letters')) {?><li class="round"><a href="<?=site_url('letters/new_letter_type')?>">Add New Letter Type</a></li><?php }?>
                    </ul>
                </li>
                <li><a href="<?=site_url('letters/manage_letters')?>" class="fly">Letters</a>
                    <ul>
                        <li><a href="<?=site_url('letters/manage_letters')?>">View Letters</a></li>
                                    <?php if(common::user_permit('add','letters')) {?><li class="round"><a href="<?=site_url('letters/new_letter')?>">Add New Letter</a></li><?php }?>
                    </ul>
                </li>
                <li><a href="<?=site_url('letters/issued_letters')?>" class="fly">Issued Letters</a>
                    <ul>
                        <li><a href="<?=site_url('letters/issued_letters')?>">Issued Letter List</a></li>
                    </ul>
                </li>

                <li><a href="<?=site_url('letters/official_letters')?>" class="fly">Other Official Letters</a></li>
                <li><a href='#print_view' rel="<?=site_url('letters/letter_variable/')?>" class="print_view round" title="Letter Variable List">Letter Variable List</a></li>
            </ul>
        </li>
        <?php endif;?>

        <?php if(common::user_permit('view','library')):?>
        <li><a href="#" class="white">Library</a>
            <ul>
                <li><a href="<?=site_url('books')?>" class="fly">Books</a>
                    <ul>
                        <li><a href="<?=site_url('books')?>">View Books</a></li>
                                    <?php if(common::user_permit('add','library')) {?><li><a href="<?=site_url('books/new_book')?>">Add New Book</a></li><?php }?>
                        <li><a href="<?=site_url('books/category')?>">View Books Category</a></li>
                                    <?php if(common::user_permit('add','library')) {?><li class="round"><a href="<?=site_url('books/new_books_category')?>">Add New Book Category</a></li><?php }?>
                    </ul>
                </li>
                <li><a href="<?=site_url('books/issued_books')?>" class="fly">Issued Books</a>
                    <ul>
                        <li><a href="<?=site_url('books/issued_books')?>">Issued Book List</a></li>
                                    <?php if(common::user_permit('add','library')) {?><li class="round"><a href="<?=site_url('books/nw_issue_book')?>">New Issue Book</a></li><?php }?>
                    </ul>
                </li>
            </ul>
        </li>
        <?php endif;?>

        <li><a href="#" class="white">Report</a>
            <ul>
                <?php if(common::user_permit('view','std_report')):?>
                <li><a href="#">Student</a>
                    <ul>
                        <li><a href="<?=site_url('report/std_sts_report')?>">Status Report</a></li>                        
                        <li><a href="<?=site_url('report/std_cont_report')?>">Contact Report</a></li>
                        <li><a href="<?=site_url('#')?>">Payment Report</a>
                            <ul>
                                <li><a href="<?=site_url('report/view_admission_fee/paid')?>">Admission Fee</a>
                                <li><a href="<?=site_url('report/view_monthly_fee/paid')?>">Monthly Fee</a>
                                <li><a href="<?=site_url('report/view_exam_fee/paid')?>">Exam Fee</a>
                                <li class="round"><a href="<?=site_url('report/view_additional_fee/paid')?>">Additional Fee</a>
                            </ul>
                        </li>
                        <li class="round"><a href="<?=site_url('#')?>">Due Report</a>
                            <ul>
                                <li><a href="<?=site_url('report/view_admission_fee/due')?>">Admission Fee</a>
                                <li><a href="<?=site_url('report/view_monthly_fee/due')?>">Monthly Fee</a>
                                <li><a href="<?=site_url('report/view_exam_fee/due')?>">Exam Fee</a>
                                <li class="round"><a href="<?=site_url('report/view_additional_fee/due')?>">Additional Fee</a>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','std_attd_rep')):?>
                <li><a href="#">Attendance</a>
                    <ul>
                        <li><a href="<?=site_url('report/attd_per_report')?>">Attendance Percentage</a></li>
                        <li class="round"><a href="<?=site_url('report/attd_class_report')?>">Attendance Class</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                
                <?php if(common::user_permit('view','account_rep')) :?>
                <li><a href="#">Account</a>
                    <ul>
                        <li><a href="<?=site_url('report/payment_report')?>">Account (Payment) Report</a></li>
                        <!--<li><a href="<?=site_url('report/due_report')?>">Account (Due) Report</a></li>-->
                        <li class="round"><a href="<?=site_url('report/daily_acc_report')?>">Daily Account Report</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','std_report')) :?>
                <li><a href="<?=site_url('report/letter_report')?>">Letter Report</a>
                    <ul>
                        <li><a href="<?=site_url('report/letter_report')?>">Letter Generation Report</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','library_rep')):?>
                <li><a href="#">Library Report</a>
                    <ul>
                        <li><a href="<?=site_url('report/library_report')?>">Issued Book Report</a></li>
                    </ul>
                </li>
                <?php endif;?>

                <?php if(common::user_permit('view','staff_report')):?>
                <li><a href="<?=site_url('report/staff_report')?>">Staff Report</a>
                    <ul>
                        <li><a href="<?=site_url('report/staff_report')?>">Staff Report</a></li>
                    </ul>
                </li>
                <?php endif; ?>
                <!--
                        <?php if(common::user_permit('view','agent_report')) {?>
                <li class="round"><a href="<?=site_url('report/agent_report')?>">Agent Report</a></li>
                            <?php }?>
                -->
            </ul>
        </li>

        <li><a href="#" class="white">Miscellaneous</a>
            <ul>
                <li><a href="<?=site_url('notice')?>">Notice</a>
                    <ul>
                        <li><a href="<?=site_url('notice')?>">View Notice</a></li>
                        <li><a href="<?=site_url('notice/new_notice')?>">Add New Notice</a></li>
                        <li class="round"><a href="<?=site_url('scms_config/index/NOTICE_TYPE')?>">Notice Type</a></li>
                    </ul>
                </li>
                <li><a href="<?=site_url('notice/staff_notice')?>">Manage Staff Notice</a></li>
                <?php if(common::user_permit('view','account_rep')):?>
                <li><a href="<?=site_url('expense')?>">Daily Account</a>
                    <ul>
                        <li><a href="<?=site_url('expense')?>">Manage Daily Account</a></li>
                        <?php if(common::user_permit('view','account_rep')) {?><li class="round"><a href="<?=site_url('expense/new_expense')?>">Add New Expense</a></li><?php }?>
                    </ul>
                </li>
                <?php endif;?>
                <?php if(common::user_permit('view','up_history')):?>
                <li class="round"><a href="<?=site_url('module_material/module_doc_history')?>">Upload History</a></li>
                <?php endif;?>
            </ul>
        </li>

        <li><a href="<?=site_url('login/logout')?>" class="white" title='Logout'>Logout</a></li>
    </ul>
            <?php }?>
        <?php if(common::is_student_user()) {
            include_once 'std_menu.php';
        }?>
        
        <?php if(common::is_staff_user()) {
            include_once 'staff_menu.php';
        }?>
</div>
<div class="clear"></div>
    <?php }?>