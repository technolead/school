<div class='form_content' style="width:880px;">
     <h3 class="fl_left"><?=$page_title?></h3>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('news/edit_news/'.$news_id)?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th>Category <span class='req_mark'>*</span></th>
                <td><select name="category_id" class="required"><?=$this->mod_news->get_category_options($category_id)?></select></td>
            </tr>
            <tr>
                <th>News Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='news_title' value='<?=$news_title?>' class='text ui-widget-content ui-corner-all required width_200' /></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td>
                    <textarea name="news_des" id="content" rows="15" cols="60" class="required"><?=$news_des?></textarea>
                </td>
            </tr>
            <tr>
                <th>News Image <span class='req_mark'>*</span></th>
                <td>
                    <img src="<?=$this->config->item('front_url')?>uploads/news/270_230_<?=$news_image?>" alt="" width="60" />
                    <input type="hidden" name="h_image" value="<?=$news_image?>" />
                    <input type='file' name='image' value='' class='' /><?=form_error('image','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>