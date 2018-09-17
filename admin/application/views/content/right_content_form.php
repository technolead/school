<div class='form_content'>
    <form id="valid_form" action='<?=site_url($action)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Top Menu <span class='req_mark'>*</span></th>
                <td><select name="menu_id" class="required"><?=$this->mod_content->get_menu_options(FALSE,$menu_id)?></select></td>
            </tr>
            <tr>
                <th>Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='title' value='<?=set_value('title',$title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Details</th>
                <td><textarea name="des" rows="3" cols="40"><?=$des?></textarea></td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <?php if($image!=''){ ?>
                    <img src="<?=$this->config->item('front_url')?>uploads/right_content/<?=$image?>" width="100" alt="" /><br />
                    <input type="hidden" name="h_image" value="<?=$image?>" />
                    <?php }?>
                    <input type='file' name='image' value=''/> [Note:Width X Height=185px X XXX]
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>