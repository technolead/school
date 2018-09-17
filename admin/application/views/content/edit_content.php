<div class='form_content' style="width:880px;">
     <h3 class="fl_left"><?=$page_title?></h3>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('content/edit_content/'.$content_id)?>' method='post'>
        <table>
            <tr>
                <th>Category <span class='req_mark'>*</span></th>
                <td><select name="menu_id" class="required"><?=$this->mod_content->get_menu_options($menu_id)?></select></td>
            </tr>
            <tr>
                <th>News Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='content_title' value='<?=$content_title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td>
                    <textarea name="content_des" id="content" rows="15" cols="60" class=""><?=$content_des?></textarea>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>