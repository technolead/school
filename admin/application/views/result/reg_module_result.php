<form id="valid_form" action='<?=site_url('result/reg_module_result')?>' method='post'>
    <div class='form_content'>
        <?  $exam_id=$this->session->userdata('sel_exam_id');
            $exam=sql::row("exam","exam_id=$exam_id") ?>
        <table>
            <tr><th>Subject Code</th><td><?=$module_code?></td></tr>
            <tr><th>Subject Name</th><td><?=$module_name?></td></tr>
            <tr><th>Exam On Marks</th><td class="jmodule_mark"><?=$marks?></td></tr>
            <tr><th>Exam Name</th><td><?=$exam['exam_name']?></td></tr>
            <tr><th>Exam Date</th><td><?=$this->session->userdata('sel_exam_date');?></td></tr>
        </table>
    </div>
    <div class='table_content'>
        <table>
            <tr class='title'>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Subject Status</th>
                <th>Marks</th>
                <th>Grade</th>
                <th>Attendance</th>
                <th>Tutorial</th>
                <th>Attempt</th>
                <th>Note</th>
                <th>Result</th>
            </tr>
            <?php
            $inc=1;
            foreach($rows as $row):?>

            <? 
            
                $attd_row=combo::get_attendance_percentage($row['student_id']);
                 if($attd_row['total_class']==''||$attd_row['total_class']==0) {
                    $attd=0;
                 }else {
                    $attd=round(($attd_row['present']-$attd_row['total_leave'])/$attd_row['total_class']*100,2);
                 }

                 $attd_per=common::get_settings_data_with_flag("attendance");
                 $final_attd=round(($attd*$attd_per)/100);


                 $tutorial_marks=common::get_tutorial_marks($row['student_id'],$exam_id,$module_id);

            ?>
            <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
                <td><input type='hidden' name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['student_name']?></td>
                <td><?=$row['user_name']?></td>
                <td><select name="module_status[]" class="width_80"><?=combo::get_class_module_status_options($row['module_status'])?></select></td>
                <th><input type="text" name="mark[]" class="jmark width_40" title="<?=$row['student_id']?>" value="<?=set_value('mark')?>" /><?=form_error('mark[]')?></th>
                <th>
                    <span class="jgrade_<?=$row['student_id']?>"></span>
                    <input type="hidden" name="grade[]" value="" class="jgradeInp_<?=$row['student_id']?>" />                    
                </th>

                <td>
                    <input type="text" name="attendance[]" value="<?=$final_attd?>%" class="text ui-widget-content ui-corner-all width_80" readonly />
                    <!--<br/><span style="color:green;">[ Absent=<?=$attd_row['absent']?> ]<br />[ Present=<?=$attd_row['present']?> ]<br/> [ Leave/Excuse=<?=$attd_row['total_leave']?> ]<br /> [Total Class=<?=$attd_row['total_class']?>]</span>-->
                </td>

                <td>
                    <input type="text" name="tutorial[]" value="<?=$tutorial_marks?>" class="text ui-widget-content ui-corner-all width_40" readonly />
                </td>

                <th><select name='attempt[]' class="width_80"><?=combo::get_type_options('SUBJECT_ATTEMPT',$row['module_attempt'])?></select></th>
                <td><input type="text" name="notes[]" value="" /></td>
                <th><select name='result_status[]'><?=$this->mod_result->get_result_options()?></select></th>
            </tr>
                <?php $inc++;
            endforeach;
            ?>
            <tr><th colspan="8"><input type='submit' name='generate' value='Generate Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></th></tr>
        </table>
    </div>
</form>