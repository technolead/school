<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('modules/edit_distribution/'.$distribution_id)?>' method='post'>
        <table>
            <tr>
                <th>Staff Name <span class='req_mark'>*</span></th>
                <td><select name="staffs_id" class="required"><?=combo::get_staff_options($staffs_id)?></select><?=form_error('staffs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_list required jclass_id jporgrams_details_id jclass_module"><?=combo::get_class_options($class_id)?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select class="jmodule_list required width_250" name="module_id" ><?=combo::get_class_module($class_id,$module_id)?></select></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>