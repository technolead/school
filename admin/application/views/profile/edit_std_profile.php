<div class='form_content'>
    <h3>Basic Information</h3>
    <form id="valid_form" action="<?=site_url('profile/edit_std_profile')?>" method="post">
        <table>
            <tr>
                <th>Title </th>
                <td><?=$title?></td>
            </tr>
            <tr>
                <th>Gender </th>
                <td><?=$gender?></td>
            </tr>
            <tr>
                <th>First Name </th>
                <td><?=$first_name?></td>
            </tr>
            <tr>
                <th>Last Name </th>
                <td><?=$last_name?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?=$date_of_birth?></td>
            </tr>
            <tr>
                <th>Present Address <span class='req_mark'>*</span></th>
                <td><textarea name="present_address" rows="5" cols="35" class="text ui-widget-content required ui-corner-all"><?=set_value('present_address',$present_address)?></textarea><?=form_error('present_address','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Permanent Address <span class='req_mark'>*</span></th>
                <td><textarea name="permanent_address" rows="5" cols="35" class="text ui-widget-content required ui-corner-all"><?=set_value('permanent_address',$permanent_address)?></textarea><?=form_error('permanent_address','<span class="block">','</span>')?></td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td><input type="text" name="phone" value="<?=set_value('phone',$phone)?>" class="text ui-widget-content ui-corner-all width_200" /><?=form_error('phone','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th>Mobile </th>
                <td><input type="text" name="mobile" value="<?=set_value('mobile',$mobile)?>" class="text ui-widget-content ui-corner-all width_200" /><?=form_error('mobile','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email </th>
                <td><input type="text" name="email" value="<?=set_value('email',$email)?>" class="text ui-widget-content ui-corner-all email width_200" /><?=form_error('email','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>