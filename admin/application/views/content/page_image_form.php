<div class='form_content'>
    <form id="valid_form" action='<?=site_url($action)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Top Menu <span class='req_mark'>*</span></th>
                <td><select name="menu_id" class="required"><?=$this->mod_content->get_menu_options(FALSE,$menu_id)?></select></td>
            </tr>
            <tr>
                <th>Image Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='image_title' value='<?=set_value('image_title',$image_title)?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('image_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Image <span class='req_mark'>*</span></th>
                <td>
                    <?php if($image!=''){ ?>
                    <img src="<?=$this->config->item('front_url')?>uploads/page_image/<?=$image?>" width="100" alt="" /><br />
                    <input type="hidden" name="h_image" value="<?=$image?>" />
                    <?php }?>
                    <input type='file' name='image' value=''/> [Note:Width X Height=960px X 140px]
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>