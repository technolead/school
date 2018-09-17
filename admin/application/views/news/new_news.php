<div class='form_content' style="width:880px;">
    <h3 class="fl_left"><?=$page_title?></h3>
    <div class="clear"></div>
    <form id="valid_form" action='<?=site_url('news/new_news')?>' method='post' enctype="multipart/form-data">
        <table>
            <tr>
                <th width="100">News Category <span class='req_mark'>*</span></th>
                <td><select name="category_id" class="required"><?=$this->mod_news->get_category_options(set_value('category_id'))?></select><?=form_error('category_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>News Title <span class='req_mark'>*</span></th>
                <td><input type='text' name='news_title' value='<?=set_value('news_title')?>' class='text ui-widget-content ui-corner-all required width_200' /><?=form_error('news_title','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Description <span class='req_mark'>*</span></th>
                <td><?=form_error('news_des','<span class="block">','</span>')?><textarea name="news_des" id="content" class="" rows="10" cols="60"><?=set_value('news_des')?></textarea></td>
            </tr>
            <tr>
                <th>News Image <span class='req_mark'>*</span></th>
                <td><input type='file' name='image' value='' class='' /><?=form_error('image','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>