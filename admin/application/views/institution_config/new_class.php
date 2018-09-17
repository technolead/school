<div class='form_content'>
	<h3><?=$page_title?></h3>
        <form id="valid_form" action='<?=$action?>' method='post'>
        <table>
            <tr>
                <th>Institution Type <span class='req_mark'>*</span></th>
                <td>
                    <select name="institution_type_id">
                        <?=common::get_institution_type($institution_type_id);?>
                    </select>
                    <?=form_error('institution_type_id','<span>','</span>')?>
                </td>
                
            </tr>
            <tr>
                <th>Year <span class='req_mark'>*</span></th>
                <td><input type="text" name="year" value="<?=set_value('class_year',$class_year)?>" /><?=form_error('year','<span>','</span>')?></td>
            </tr>

            <tr>
                <th>Class <span class='req_mark'>*</span></th>
                <td>
                    <select name="class_code">
                        <option value="">-- Select a class --</option>
                        <option value="1" <?if($class_code==1) echo 'selected';?>>1</option>
                        <option value="2" <?if($class_code==2) echo 'selected';?>>2</option>
                        <option value="3" <?if($class_code==3) echo 'selected';?>>3</option>
                        <option value="4" <?if($class_code==4) echo 'selected';?>>4</option>
                        <option value="5" <?if($class_code==5) echo 'selected';?>>5</option>
                        <option value="6" <?if($class_code==6) echo 'selected';?>>6</option>
                        <option value="7" <?if($class_code==7) echo 'selected';?>>7</option>
                        <option value="8" <?if($class_code==8) echo 'selected';?>>8</option>
                        <option value="9" <?if($class_code==9) echo 'selected';?>>9</option>
                        <option value="10" <?if($class_code==10) echo 'selected';?>>10</option>
                        <option value="11" <?if($class_code==11) echo 'selected';?>>11</option>
                        <option value="12" <?if($class_code==12) echo 'selected';?>>12</option>
                    </select>
                    <?=form_error('class_code','<span>','</span>')?>
                </td>
            </tr>
            <tr>
                <th>Status <span class='req_mark'>*</span></th>
                <td>
                    <select name="status">
                        <option value="">-- Select status --</option>
                        <option value="enabled" <?if($status=='enabled') echo "selected"?>>Enabled</option>
                        <option value="disabled" <?if($status=='disabled') echo "selected"?>>Disabled</option>
                    </select>
                    <?=form_error('status','<span>','</span>')?>
                </td>

            </tr>

            <!-- to do -->
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>