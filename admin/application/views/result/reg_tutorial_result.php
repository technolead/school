<form id="valid_form" action='<?=site_url('result/reg_tutorial_result')?>' method='post'>
    <div class='form_content'>
        <?  $exam_id=$this->session->userdata('tut_exam_id');
            $exam=sql::row("exam","exam_id=$exam_id") ?>
        <table>
            <tr><th>Subject Code</th><td><?=$module_code?></td></tr>
            <tr><th>Subject Name</th><td><?=$module_name?></td></tr>
            <tr><th>Exam Name</th><td><?=$exam['exam_name']?></td></tr>
            <tr><th>Title</th><td><?=$this->session->userdata('tut_description');?></td></tr>
            <tr><th>Total Marks</th><td><?=$this->session->userdata('tut_total_marks');?></td></tr>
            <tr><th>Exam Date</th><td><?=$this->session->userdata('tut_tutorial_date');?></td></tr>
        </table>
    </div>
    <div class='table_content'>
        <table>
            <tr class='title'>
                <th>Student Name</th>
                <th>Student ID</th>                
                <th>Obtained Marks</th>
                
            </tr>
            <?php
            $inc=1;
            foreach($rows as $row):?>
           
            <tr <?php if($inc%2==0) {echo "class='even'";}else {echo "class='odd'";}?>>
                <td><input type='hidden' name="student_id[]" value="<?=$row['student_id']?>" /><?=$row['student_name']?></td>
                <td><?=$row['user_name']?></td>
                
                <th><input type="text" name="obtained_marks[]" style="width:80px;" value="<?=set_value('obtained_marks')?>" /><?=form_error('obtained_marks[]')?></th>
               
            </tr>
                <?php $inc++;
            endforeach;
            ?>
            <tr><th colspan="8"><input type='submit' name='generate' value='Generate Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></th></tr>
        </table>
    </div>
</form>