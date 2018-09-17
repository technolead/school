<div class='form_content'>
    <div class="white_bg">
        <form action='<?=site_url('student/reg_new_module/'.$levels_reg_id)?>' method='post'>
            <table>
                <?php if(validation_errors()!=''){ echo "<tr><td colspan='2' class='error'>".validation_errors()."</td></tr>";}?>
                <tr>
                    <th>Semester</th>
                    <td><?=$semester?></td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td><?=$year?></td>
                </tr>
                <tr>
                    <th>Levels</th>
                    <td><?=$level_code?></td>
                </tr>
                <tr>
                    <th>Levels</th>
                    <td><?=$level_name?></td>
                </tr>
                <tr>
                    <th>Start Date <span class='req_mark'>*</span></th>
                    <td><?=$start_date?></td>
                </tr>
                <tr>
                    <th>End Date <span class='req_mark'>*</span></th>
                    <td><?=$end_date?></td>
                </tr>
                <tr>
                    <th>Level Status <span class='req_mark'>*</span></th>
                    <td><?=$level_status?></td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td><?=$level_comment?></td>
                </tr>
            </table>
            <fieldset>
                 <legend>New Module Registration</legend>
                <table>
                    <tr class="title"><th>Module</th><th>Module Status</th><th>Attempt</th><th>Module Comment</th></tr>
                    <?php for($inc=0;$inc<5;$inc++){ ?>
                    <tr>
                        <td><select class="jmodule_list input_txt width_200" name="module_id[]"><?=combo::get_levels_module($levels_id)?></select></td>
                        <td><select name="module_status[]" class="input_txt width_200"><?=combo::get_module_status()?></select></td>
                        <td><select name="attempt[]" class="input_txt width_200"><?=combo::get_module_attempt()?></select></td>
                        <td><input type="text" name="module_comment[]" class="input_txt width_200" value="" /></td>
                    </tr>
                    <?php }  ?>
                </table>
            </fieldset>
            <div>
                <input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
            </div>
        </form>
    </div>
</div>