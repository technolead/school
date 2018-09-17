<div class='form_content'>
    <table>
        <tr><th>Student Name</th><td><?=$first_name.' '.$last_name?></td></tr>
        <tr><th>Present Adress</th><td><?=$present_address?></td></tr>
        <tr><th>Email</th><td><?=$email?></td></tr>
        <tr><th>Admission Date</th><td><?=$admission_date?></td></tr>
        <tr><th>Student Type</th><td><?=$student_type?></td></tr>
        <tr><th>Student Status</th><td><?=$student_status?></td></tr>
    </table>
</div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left">
            <?=$pagination_links?> <span class="b margin_0_10">Showing <?=$start?>-<?=$end?> of <?=$total?> Module Results</span>
        </div>
        <div class="clear"></div>
    </div>
    <table>
        <tr class='title'>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Marks</th>
            <th>Grade</th>
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
            <th><?=$row['mark']?></th>
            <th><?=$row['grade']?></th>
            <td><?=$row['result_status']?></td>
            <td class='width_150 links'>
                <a href='<?=site_url('result/edit_result/'.$row['module_result_id'])?>'>Edit</a>
                <a href='<?=site_url('result/delete_module_result/'.$row['module_result_id'])?>' onclick='javascript: return confirm("Are you sure you want to delete?");'>Delete</a>
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