<div class="form_content">
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
     echo "<div class='success'>".$msg."</div>";
}?>
    <form action='<?=site_url('settings/set_marking')?>' method='post'>
        <table>
           <tr>
                <th>From Tutorial</th>
                <td><input type="text" name="tutorial" value="<?=$tutorial?>" /> %</td>
            </tr>
            <tr>
                <th>From Attendance</th>
                <td><input type="text" name="attendance" value="<?=$attendance?>" /> %</td>
            </tr>
            <tr>
                <th>From Tutorial</th>
                <td><input type="text" name="final_exam" value="<?=$final_exam?>" /> %</td>
            </tr>
            
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<div class="clear"></div>