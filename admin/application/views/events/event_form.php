<div class='form_content' style="width:880px;">
     <h3 class="fl_left"><?=$page_title?></h3>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url($action)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Category <span class='req_mark'>*</span></th>
                <td><select name="category_id" class="required"><?=$this->mod_events->get_category_options($category_id)?></select></td>
            </tr>
            <tr>
                <th>Event Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='event_title' value='<?=$event_title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Event Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='event_date' value='<?=$event_date?>' class='text ui-widget-content ui-corner-all required width_80 date_picker' /></td>
            </tr>
            <tr>
                <th>Event Time <span class='req_mark'>*</span></th>
                <td><input type='text' name='event_time' value='<?=$event_time?>' class='text ui-widget-content ui-corner-all required width_80' /></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td>
                    <textarea name="event_des" id="content" rows="15" cols="60" class="required"><?=$event_des?></textarea>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>