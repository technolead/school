<div class='form_content' style="width:880px;">
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('notice/new_notice')?>' method='post'>
        <table>
            <tr>
                <th>Notice Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='notice_title' value='<?=set_value('notice_title')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('notice_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td><textarea name="des" id="content" rows="15" class="required" cols="60"><?=set_value('des')?></textarea><?=form_error('des','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Posted To <span class='req_mark'>*</span></th>
                <td>
                    <select name="posted_to" class="required"><?=$this->mod_notice->get_posted_to(set_value('posted_to'))?></select>
                    <?=form_error('posted_to','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Notice Type <span class='req_mark'>*</span></th>
                <td><select name="notice_type" class="required"><?=combo::get_type_options('NOTICE_TYPE',set_value('notice_type'))?></select><?=form_error('notice_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Priority <span class='req_mark'>*</span></th>
                <td>
                    <select name="priority" class="required"><?=$this->mod_notice->get_priority(set_value('priority'))?></select>
                    <?=form_error('priority','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Valid Until <span class='req_mark'>*</span></th>
                <td><input type='text' name='valid_until' value='<?=set_value('valid_until')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('valid_until','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Posted Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='posted_date' value='<?=set_value('posted_date')?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('posted_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>