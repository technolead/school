<div class="form_content">
     <form action="<?=site_url('notice')?>" method="post">
        <table>
            <tr>
                <th class="txt_right">Search Key</th><td><select name="searchField"><?=$this->mod_notice->get_notice_search_options($_REQUEST['searchField'])?></select></td>
                <th>Search Value</th><td><input type="text" name="searchValue" value="<?=$_REQUEST['searchValue']?>" class="text ui-widget-content ui-corner-all width_160" /></td>
            </tr>
            <tr>
                <td colspan="4" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
            </tr>
        </table>
    </form>
</div>
<div class='grid_area' style="width: 900px;">
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <div class="tooolbars">
        <button id="add" title="notice/new_notice"  class="jadd_button">Add</button>
        <button title="notice/edit_notice" class="jedit_button">Edit</button>
        <button title="notice/delete_notice" class="jdelete_button">Delete</button>
        <button title="notice/notice_status/disabled" class="jdelete_button">Activate</button>
        <button title="notice/notice_status/enabled" class="jdelete_button">Deactivate</button>
    </div>
    <hr />
    <?php echo $grid_data?>
</div>
