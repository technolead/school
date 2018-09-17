<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class='form_content'>
    <table cellpadding="1" cellspacing="1">



        <tr>
            <th>Session : </th><td><?=$session_name?></td>
        </tr>
        <tr>
            <th>Class : </th><td><?=$class_name?><span id="jclass_id" style="display: none"><?=$class_id?></span></td>
        </tr>

        <tr>
            <th>Section : </th><td><?=$section?></td>
        </tr>

        

    </table>
</div>

<div class='table_content'>
    <form id="valid_form" action="<?=site_url($action)?>" method="post">

        <?php if(validation_errors()){ echo "<div style='color:red;font-size:11px;text-align:left;'>".validation_errors()."</div>";}?>

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="saturday" > [ Saturday ]</span>
            <div id="div_saturday" style="margin: 10px 0px;"></div>
        </div>
        

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="sunday" > [ Sunday ]</span>
            <div id="div_sunday" style="margin: 10px 0px;"></div>
        </div>

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="monday" > [ Monday ]</span>
            <div id="div_monday" style="margin: 10px 0px;"></div>
        </div>

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="tuesday" > [ Tuesday ]</span>
            <div id="div_tuesday" style="margin: 10px 0px;"></div>
        </div>

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="wednesday" > [ Wednesday ]</span>
            <div id="div_wednesday" style="margin: 10px 0px;"></div>
        </div>

        <div class="txt_center">
            <span class="routine_link show_routine_div pointer" title="thursday" > [ Thursday ]</span>
            <div id="div_thursday" style="margin: 10px 0px;"></div>
        </div>
        

        
        <div class="txt_center margin_10_0">
            
            <input type='submit' name='save' value='Save' class='button' />
            <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
    </form>
</div>