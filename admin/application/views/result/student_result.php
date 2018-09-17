<div class='form_content'>
    <h3>Student Information</h3>
    <table>
        <tr><th>Student ID:</th><td><?=$user_name?></td></tr>
        <tr><th>Student Name:</th><td><?=$student_name?></td><th>Email:</th><td><?=$email?></td></tr>
        <tr><th>Class Name:</th><td><?=$class_name?></td>
        <tr><th>Session Name:</th><td><?=$session_name?></td></tr>
        <tr><th>Class Status:</th><td><?=combo::get_class_module_status($class_status)?></td><th>Status Change Date:</th><td><?=$class_status_date?></td></tr>
    </table>
</div>
<div id="jmodule_result_form"></div>
<div class='table_content'>
    <h3>Enrolled Subjects for the Above Student</h3>
    <hr />
    <div class="pagination_links">
        <span class="b margin_0_10">Student Subject Results</span>
    </div>
    <?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Exam</th>
            <th>Exam Date</th>
            <th>Marks</th>            
            <th>Grade</th>
            <th>Attempt</th>
            <th>Result Status</th>
            <th>Task</th>
        </tr>
        <?php if(count($rows)>0) {
    $inc=1;
    foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
            echo "class='even'";
        }else {
            echo "class='odd'";
        }?>>
            <td><?=$row['module_code']?></td>
            <td><?=$row['module_name']?></td>
            <th><?=$row['exam_name']?></th>
            <th><?=$row['exam_date']?></th>
            <th><?=$row['marks']?></th>
            <th><?=$row['grade']?></th>
            <th><?=$row['attempt']?></th>            
            <td><?=$row['result_status']?></td>
            <td class='view_links' style="width:50px;">
                <a href="#jmodule_result_form" class="jmodule_result edit_link" title="Change" rel="<?=$row['module_result_id']?>"></a>
                <a href='<?=site_url('result/delete_module_result/'.$row['module_result_id'])?>' title="Delete" class="delete_link" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
    </table>
</div>