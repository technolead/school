<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form action='<?=site_url('result/search')?>' method='post'>
        <table>
            <tr>
                <th>Semester <span class='req_mark'>*</span></th>
                <td><select name="semester" class="input_txt"><?=combo::get_semester_options(set_value('semester'))?></select></td>
            </tr>
            <tr><th>Student ID <span class='req_mark'>*</span></th><td><input type="text" class="input_txt width_180" name="student_code" value="<?=set_value('student_code')?>" /></td></tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='search' value='Search Result' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>