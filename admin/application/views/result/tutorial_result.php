<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="fl_left">
<?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Subject Results</span>
        </div>
        <div class="fl_right">
            <select name="jmodule_id" class="input_txt width_200 left jsort_tutorial_result"><option value="">Select Subject</option><?=combo::get_modules_options($module_id)?></select>
            <select name="jexam_id" class="input_txt margin_0_10 right jsort_tutorial_result"><?=combo::get_exam_options($exam_id)?></select>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Exam</th>            
            <th>Description</th>
            <th>Date</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
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
            <td><a href="<?=site_url('result/student_tutorial_result/'.$row['user_name'])?>" title="View Student Tutorial Result"><?=$row['first_name'].' '.$row['last_name']?></a></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['exam_name']?></td>            
            <td><?=$row['description']?></td>
            <td><?=$row['tutorial_date']?></td>
            <td><?=$row['module_code']?></td>
            <td><?=$row['module_name']?></td>            
            <th><?=$row['total_marks']?></th>
            <th><?=$row['obtained_marks']?></th>
            
            <td class='view_links'>
                <a href='<?=site_url('result/edit_tutorial_result/'.$row['tutorial_result_id'])?>' class="edit_link" title="Change"></a>
                <a href='<?=site_url('result/delete_tutorial_result/'.$row['tutorial_result_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='8'>No Content Found!!!</td></tr>";
}  ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?><span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Students</span></div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>