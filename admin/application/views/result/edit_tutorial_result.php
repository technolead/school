<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=site_url('result/edit_tutorial_result/'.$tutorial_result_id)?>' method='post'>
        <table>
            <tr><th>Student Name</th><td><?=$first_name.' '.$last_name?></td></tr>
            <tr><th>Student ID</th><td><?=$user_name?></td></tr>            
            <tr><th>Exam</th><td><?=$exam_name?></td></tr>
            <tr><th>Description</th><td><?=$description?></td></tr>
            <tr><th>Date</th><td><?=$tutorial_date?></td></tr>            
            <tr><th>Subject Name</th><td><?=$module_name?></td></tr>
            <tr><th>Total Marks</th><td><?=$total_marks?></td></tr>
            <tr>
                <th>Obtained Marks</th><td><input type="text" name="obtained_marks"  class='input_txt' style="width:80px;" value="<?=$obtained_marks?>" /><?=form_error('obtained_marks','<span>','</span>')?></td>
            </tr>
            
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td></tr>
        </table>
    </form>
</div>