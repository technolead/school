<div class='table_content'>
    <form method="post" action="#submitForm" onsubmit="javascript:return result.update_std_tutorial_result(this);" title="result/student_tutorial_result/<?=$student_id?>">
        <table>
            <tr class='title'>
                <th>Subject Name</th>
                <th>Exam Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
            </tr>
            <tr>
                <th><?=$module_name?></th>
                <th><?=$exam_name?></th>
                <th><?=$description?></th>
                <th><?=$tutorial_date?>"</th>
                <th><?=$total_marks?></th>
                <th>                    
                    <input type="text" name="obtained_marks" value="<?=$obtained_marks?>"  />
                </th>
                
            </tr>
            <tr><th colspan="7"><input type='submit' name='generate' value='Generate Result' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></th></tr>
        </table>
    </form>
</div>