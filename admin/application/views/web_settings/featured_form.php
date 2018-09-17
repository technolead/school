<div class='form_content'>
    <form id="valid_form" action='<?=site_url($action)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Link Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='featured_title' value='<?=$featured_title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Link URL <span class='req_mark'>*</span></th>
                <td><input type='text' name='featured_url' value='<?=$featured_url?>' class='text ui-widget-content ui-corner-all url required width_200' /></td>
            </tr>
             <tr>
                <th>Featured Image <span class='req_mark'>*</span></th>
                <td>
                    <img src="<?=$this->config->item('front_url')?>uploads/featured/<?=$featured_image?>" alt="" width="60" /><br />
                    <input type="hidden" name="h_image" value="<?=$featured_image?>" />
                    <input type='file' name='image' value='' class='' />[Note:Width X Height=300px X 132px]
                </td>
            </tr>
            <tr>
                <th>Bottom Links <span class='req_mark'>*</span></th>
                <td><select name="featured_links[]" multiple><?=$this->mod_web_settings->get_links_opt($featured_links)?></select></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>