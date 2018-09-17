<div class='form_content'>
    <form id="valid_form" action='<?=site_url($action)?>' method='post' enctype="multipart/form-data">
        <table>

            <tr>
                <th>Site Logo <span class='req_mark'>*</span></th>
                <td>
                    <?php if($site_logo!=''){ ?>
                    <img src="<?=$this->config->item('front_url')?>uploads/site_logo/<?=$site_logo?>" width="275" height="120" alt="site_logo" /><br />
                    <input type="hidden" name="h_logo" value="<?=$site_logo?>" />
                    <?php }?>
                    <input type='file' name='logo' value=''/> [Note:Width X Height=275px X 120px]
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>