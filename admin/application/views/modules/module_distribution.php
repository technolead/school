<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('modules/module_distribution/')?>' method='post'>
        <table>
            <tr>
                <th>Staff Name <span class='req_mark'>*</span></th>
                <td><select name="staffs_id" class="required"><?=combo::get_staff_options(set_value('staffs_id'))?></select><?=form_error('staffs_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Class Name: <span class='req_mark'>*</span></th>
                <td><select name="class_id" class="jclass_list jclass_id jporgrams_details_id jclass_module required"><?=combo::get_class_options(set_value('class_id'))?></select><?=form_error('class_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Subject <span class='req_mark'>*</span></th>
                <td><select class="jmodule_list required width_250" name="module_id[]" size="10" multiple ><?=combo::get_class_module(set_value('class_id'),set_value("module_id[]"))?></select></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>