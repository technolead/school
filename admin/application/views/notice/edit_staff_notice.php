<div class='form_content' style="width:880px;">
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('notice/edit_staff_notice/'.$notice_id)?>' method='post'>
        <table>
        <tr>
                <th>Notice Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='notice_title' value='<?=set_value('notice_title',$notice_title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('notice_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td><textarea name="des" id="content" rows="15" class="" cols="60"><?=set_value('des',$des)?></textarea><?=form_error('des','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Posted To <span class='req_mark'>*</span></th>
                <td>
                    <input type="radio" name="posted_to" value="1" class="jposted_to" checked />Allocated Student
                    <input type="radio" name="posted_to" value="2" class="jposted_to" <?php if($posted_to==2){echo 'checked';}?> />Send Individual Student
                    <input type="radio" name="posted_to" value="3" class="jposted_to" <?php if($posted_to==3){echo 'checked';}?> />All Student
                    <div class="jindividual_box" <?php if($posted_to!=2)echo 'style="display:none;"'?>>
                        Student ID: <input type="hidden" name="student_id" value="<?=$student_id?>" />
                        <input type='text' autocomplete='off' class='width_160 jstudent_username text ui-widget-content ui-corner-all'  name='user_name' value='<?=set_value('user_name',$std_user_name)?>' />
                        <div class="jstudent_list"></div>
                    </div>
                </td>
            </tr>
            <!--
            <tr>
                <th>Notice Type <span class='req_mark'>*</span></th>
                <td><select name="notice_type" class="required"><?=combo::get_type_options('NOTICE_TYPE',set_value('notice_type'))?></select><?=form_error('notice_type','<span>','</span>')?></td>
            </tr>
            -->
            <tr>
                <th>Priority <span class='req_mark'>*</span></th>
                <td>
                    <select name="priority" class="required"><?=$this->mod_notice->get_priority(set_value('priority',$priority))?></select>
                    <?=form_error('priority','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Valid Until <span class='req_mark'>*</span></th>
                <td><input type='text' name='valid_until' value='<?=set_value('valid_until',$valid_until)?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('valid_until','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Posted Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='posted_date' value='<?=set_value('posted_date',$posted_date)?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /><?=form_error('posted_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>