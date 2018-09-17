<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Student Information</a></li>
        <li><a href="#tabs-2">Registration Informations</a></li>
        <li><a href="#tabs-3">Issued Letters</a></li>
        <li><a href="#tabs-4">Progress Report</a></li>
        <li><a href="#tabs-5">Subject Result</a></li>
    </ul>
    <div id="tabs-1">
        <div class='form_content'>
            <h3>Basic Information</h3>
             <table class="left" style="width:450px;">
                 <tr><th>Student ID </th><td><?=$user_name?></td></tr>
                <tr><th>Title </th><td><?=$title?></td></tr>
                <tr><th>Gender </th><td><?=$gender?></td></tr>
                <tr><th>First Name </th><td><?=$first_name?></td></tr>
                <tr><th>Last Name </th><td><?=$last_name?></td></tr>
                <tr><th>Date of Birth</th><td><?=$date_of_birth?></td></tr>
                <tr><th>Present Address </th><td><?=nl2br($present_address)?></td></tr>
                <tr><th>Permanent Address</th><td><?=nl2br($permanent_address)?></td></tr>
                 <tr><th>Nationality </th><td><?=$nationality?></td></tr>
                <tr><th>Marital Status </th><td><?=$marital_status?></td></tr>
                <tr><th>Telephone</th><td><?=$phone?></td></tr>
                
                <tr><th>Mobile</th><td><?=$mobile?></td></tr>
                <tr><th>Email </th><td><?=$email?></td></tr>
            </table>
            <div class="right" style="border:1px solid #ddd;width:200px;height:200px;padding:2px;text-align:center;">
                <img src="<?=base_url()?>uploads/photograph/<?=$photograph?>" width="200" alt="Photograph" />
            </div>
            <div class="clear"></div>
        </div>

        <div class='form_content'>
            <h3>Parent Information</h3>
             <table class="left" style="width:450px;">
                <tr><th>Father's Name </th><td><?=$parent_row['father_name']?></td></tr>
                <tr><th>Mother's Name </th><td><?=$parent_row['mother_name']?></td></tr>
                <tr><th>Parent Address </th><td><?=nl2br($parent_row['parent_address'])?></td></tr>
                <tr><th>Parent Phone</th><td><?=$parent_row['parent_phone']?></td></tr>
                <tr><th>Legal Guardian's Name </th><td><?=$parent_row['legal_guardian_name']?></td></tr>
                <tr><th>Legal Guardian's Address </th><td><?=nl2br($parent_row['legal_guardian_address'])?></td></tr>
                <tr><th>Legal Guardian's Phone</th><td><?=$parent_row['legal_guardian_phone']?></td></tr>
                
            </table>
            
            <div class="clear"></div>
        </div>

        <div class='form_content'>
            <h3>Registration</h3>
            <table>
                <tr><th>Admission Date </th><td><?=$admission_date?></td></tr>
                <tr><th>Branch </th><td><?=common::get_branch_name($branch_id)?></td></tr>
                <tr><th>Student Status </th><td><?=$student_status?></td></tr>
                <tr><th>Status Change Date </th><td><?=$std_status_date?></td></tr>
               
            </table>
        </div>
        
        
        
        <div class='form_content'>
            <h3>Qualification Information</h3>
            <table class='txt_center'>
                <tr class="title"><th>Qualification</th><th>Awarding Body</th><th>Year</th><th>Grade</th></tr>
                <?php $qua=sql::rows('std_qualifications',"student_id=$student_id order by std_qualifications_id");
                for($inc=0;$inc<5;$inc++) { ?>
                <tr>
                    <td><?=$qua[$inc]['qualification']?></td>
                    <td><?=$qua[$inc]['awarding_body']?></td>
                    <td><?=$qua[$inc]['year']?></td>
                    <td><?=$qua[$inc]['grade']?></td>
                </tr>
                    <?php }  ?>
                
            </table>
        </div>
        <div class='form_content'>
            <h3>Documents Information</h3>
            <?php $doc=explode(',',$doc_submitted)?>
            <table>
                <?php if($doc[0]==1) {?>
                <tr>
                    <th><input type="checkbox" checked /></th>
                    <td><a href="<?=base_url()?>uploads/photograph/<?=$photograph?>" target="_blank">Photograph</a></td>
                </tr>
                    <?php }?>
                
                <?php if($doc[1]==2) {?>
                <tr>
                    <th><input type="checkbox" name="document_submitted[]" value="2" <?php if($doc[1]==2) {echo 'checked';}?> /></th>
                    <td><a href="<?=base_url()?>uploads/cirtificates/<?=$doc_certificates?>" target="_blank">Copy Of Certificates</a></td>
                </tr>
                    <?php }?>
                
               
                <tr>
                    <th>Documents Required:</th>
                    <td><?=$doc_required?></td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td colspan="3"><?=$comments?></td>
                </tr>
            </table>
        </div>
    </div>

    

    <div id="tabs-2">
        <!--<div class="right"><a class="add" href="<?=site_url('student/reg_new_class/'.$student_id)?>" title="New Class Registration">New Class Registration</a></div>-->
        <div class="clear"></div>
        <div class='table_content'>
            <h3>Registered Class</h3>
            <table cellpadding="1" cellspacing="1">
                <tr class="title">
                    <th>Session</th>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Class Teacher</th>
                    <th>Privilege</th>
                    <th>Class Status</th>
                    <th>Status Change</th>
                    <th>Action</th>
                </tr>
                <?php if(count($rows)>0) {
                    $inc=1;
                    foreach($rows as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even txt_center'";
                        }else {
                            echo "class='odd txt_center'";
                            }?>>
                    <td><?=$row['session_name']?></td>
                    <td><?=$row['class_name']?></td>
                    <td><?=$row['section']?></td>
                    <td><?=$row['start_date']?></td>
                    <td><?=$row['end_date']?></td>
                    <td><?=$row['tutor_name']?></td>
                    <td><?=common::get_privilege_name($row['privilege'])?></td>
                    <td><?=combo::get_class_module_status($row['class_status'])?></td>
                    <td><?=$row['class_status_date']?></td>
                    <td class='view_links'>
                                <?php if(common::user_permit('add','student')) {?>
                        <!--<a href='<?=site_url('student/class_status/'.$row['reg_class_id'].'/'.$row['status'])?>'><?=common::status($row['status'])?></a>-->
                        <a href='<?=site_url('student/edit_reg_class/'.$row['reg_class_id'])?>' class="edit_link" title="Change"></a>
                        <?php }?>
                        <?php if(common::user_permit('delete','student') && $site_data['delete']) {?>
                        <a href='<?=site_url('student/delete_class/'.$row['reg_class_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                                    <?php }?>
                    </td>
                </tr>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
        </div>

      
        
        
        <div class='table_content'>
            <h3>Registered Subjects</h3>
            <table cellpadding="1" cellspacing="1">
                <tr class="title">
                    
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Type</th>
                    <th>Subject Status</th>
                    <th>Attempt</th>
                    <!--<th>Action</th>-->
                </tr>
                <?php if(count($modules)>0) {
                    $inc=1;
                    foreach($modules as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even txt_center'";
                        }else {
                            echo "class='odd txt_center'";
                            }?>>
                    
                    <td><?=$row['module_code']?></td>
                    <td><?=$row['module_name']?></td>
                    <td><?=($row['is_compulsary']==1)?"Compulsory":"Optional"?></td>
                    <td><?=combo::get_class_module_status($row['module_status'])?></td>
                    <td><?=$row['module_attempt']?></td>
                    
                    <!--<td class='view_links'>
                         <?php if(common::user_permit('delete','student') && $site_data['delete']) {?>
                        <a href='<?=site_url('student/delete_student_module/'.$row['reg_module_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                                    <?php }?>
                    </td>-->
                </tr>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
        </div>
    </div>
    <div id="tabs-3">
        <div class='table_content'>
            <h3>Student Letters</h3>
            <table cellspacing='1' cellpadding="1">
                <tr class='title'>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>From Name</th>
                    <th>Issue Date</th>
                    <th>Letter Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php if(count($letters)>0) {
                    $inc=1;
                    foreach($letters as $row): ?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><?=$row['student_name']?></td>
                    <td><?=$row['user_name']?></td>
                    <td><?=$row['first_name'].' '.$row['last_name']?></td>
                    <td><?=$row['issue_date']?></td>
                    <td><?=$row['letter_title']?></td>
                    <td><?=word_limiter(strip_tags($row['des']),10)?></td>
                    <td class='view_links'>
                                <?php  if(common::user_permit('add','student')) { ?>
                        <a href='#print_view' rel="<?=site_url('letters/print_view/'.$row['student_letters_id'])?>" class="print_link print_view" title="Print View"></a>
                        <?php }?>
                        <?php  if(common::user_permit('delete','student') && $site_data['delete']) { ?>
                        <a href='<?=site_url('letters/delete_issued_letters/'.$row['student_letters_id'])?>' class="delete_link" onclick='javascript: return confirm("Are you sure you want to delete?");' title="Delete"></a>
                                    <?php }?>
                    </td>
                </tr>
                        <?php  $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='3'>No Letters Found!!!</td></tr>";
                }?>
            </table>
        </div>
    </div>
    <div id="tabs-4">
        <div class='table_content'>
            <h3>Student Progress Report</h3>
            <table cellpadding="1" cellspacing="1">
                <tr class='title'>
                    <th>Student Name</th>
                    <th>Class Name</th>
                    <th>Session Name</th>
                    <th>Exam</th>
                    <th>Grade</th>
                    <th>Grade Point</th>
                    <th>Attendance</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
                <?php if(count($reports)>0) {
                    $inc=1;
                    foreach($reports as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><?=$row['student_name']?></td>
                    <td><?=$row['class_name']?></td>
                    <td><?=$row['session_name']?></td>
                    <td><?=$row['exam_name']?></td>
                    <td><?=$row['final_grade']?></td>
                    <td><?=$row['final_grade_point']?></td>
                    <th><?=$row['attendance']?></th>
                    <td><?=$row['first_name'].' '.$row['last_name']?></td>
                    <td class='view_links'>
                        <?php  if(common::user_permit('add','progress_rep')) { ?>
                        <a href='<?=site_url('report/edit_report/'.$row['report_id'])?>' class="edit_link" class="Change"></a>
                        <a href='#print_view' rel="<?=site_url('report/print_view/'.$row['report_id'])?>" class="print_link print_view" title="Print View"></a>
                        <?php }?>
                        <?php  if(common::user_permit('delete','progress_rep') && $site_data['delete']) { ?>
                        <a href='<?=site_url('report/delete_report/'.$row['report_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");' class="delete_link" title="Delete"></a>
                        <?php }?>
                    </td>
                </tr>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
        </div>
    </div>
    <div id="tabs-5">
        <div class="table_content">
            <h3>Student Subject Result</h3>
            <table cellpadding="1" cellspacing="1">
                <tr class='title'>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Result Status</th>
                    <th>Task</th>
                </tr>
                <?php if(count($results)>0) {
                    $inc=1;
                    foreach($results as $row):?>
                <tr <?php if($inc%2==0) {
                            echo "class='even'";
                        }else {
                            echo "class='odd'";
                            }?>>
                    <td><?=$row['module_code']?></td>
                    <td><?=$row['module_name']?></td>
                    <th><?=$row['marks']?></th>
                    <th><?=$row['grade']?></th>
                    <td><?=$row['result_status']?></td>
                    <td class='view_links'>
                        <?php  if(common::user_permit('add','result')) { ?>
                        <a href='<?=site_url('result/edit_result/'.$row['module_result_id'])?>' class="edit_link" title="Change"></a>
                        <?php }?>
                        <?php  if(common::user_permit('delete','result') && $site_data['delete']) { ?>
                        <a href='<?=site_url('result/delete_module_result/'.$row['module_result_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                        <?php }?>
                    </td>
                </tr>
                        <?php $inc++;
                    endforeach;
                }else {
                    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
                }  ?>
            </table>
        </div>
    </div>
</div>