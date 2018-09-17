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
<div id="jtutorial_result_form"></div>
<div class='table_content'>
    <h3>Enrolled Subjects for the Above Student</h3>
    <hr />
    <div class="pagination_links">
        <span class="b margin_0_10">Student Tutorial Results</span>
    </div>
    <?php if($msg!='') {
    echo "<div class='success'>$msg</div>";
}?>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Exam</th>
            <th>Description</th>
            <th>Date</th>
            <th>Total Marks</th>
            <th>Obtained Marks</th>
            
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
            <th><?=$row['description']?></th>
            <th><?=$row['tutorial_date']?></th>
            <th><?=$row['total_marks']?></th>
            <th><?=$row['obtained_marks']?></th>
            
            <td class='view_links' style="width:50px;">
                <a herf="#jtutorial_result_form" class="pointer jtutorial_result edit_link" title="Change" rel="<?=$row['tutorial_result_id']?>"></a>
                <a href='<?=site_url('result/delete_tutorial_result/'.$row['tutorial_result_id'])?>' title="Delete" class="delete_link" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
    </table>
</div>