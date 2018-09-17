<div class="form_content">
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
     echo "<div class='success'>".$msg."</div>";
}?>
    <form action='<?=site_url('settings/set_attendance')?>' method='post'>
        <table>
           <tr>
                <th>Continuous Missed Class</th>
                <td>
                    <div class="first_color block pad_0_10">From <input type='text' name='con_start_1' value='<?=$con_start_1?>' class='input_txt width_80' /> To <input type='text' name='con_end_1' value='<?=$con_end_1?>' class='input_txt width_80' /></div>
                    <div class="second_color block pad_0_10" style="margin:5px 0;">From <input type='text' name='con_start_2' value='<?=$con_start_2?>' class='input_txt width_80' /> To <input type='text' name='con_end_2' value='<?=$con_end_2?>' class='input_txt width_80' /></div>
                    <div class="fourth_color block pad_0_10">From <input type='text' name='con_start_3' value='<?=$con_start_3?>' class='input_txt width_80' /> To <input type='text' name='con_end_3' value='<?=$con_end_3?>' class='input_txt width_80' /></div>
                </td>
            </tr>
            <tr>
                <th>Percentage</th>
                <td>
                    <div class="first_color block pad_0_10">From <input type='text' name='per_start_1' value='<?=$per_start_1?>' class='input_txt width_80' /> To <input type='text' name='per_end_1' value='<?=$per_end_1?>' class='input_txt width_80' /></div>
                    <div class="second_color block pad_0_10" style="margin:5px 0;">From <input type='text' name='per_start_2' value='<?=$per_start_2?>' class='input_txt width_80' /> To <input type='text' name='per_end_2' value='<?=$per_end_2?>' class='input_txt width_80' /></div>
                    <div class="fourth_color block pad_0_10" style="margin:5px 0;">From <input type='text' name='per_start_3' value='<?=$per_start_3?>' class='input_txt width_80' /> To <input type='text' name='per_end_3' value='<?=$per_end_3?>' class='input_txt width_80' /></div>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="clear"></div>