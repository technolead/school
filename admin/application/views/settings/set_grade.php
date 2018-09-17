<div class="table_content txt_center" style="width:70%;margin:auto;">
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
     echo "<div class='success'>".$msg."</div>";
}?>
    <form action='<?=site_url('settings/set_grade')?>' method='post'>
        
        <table  >
            <tr class="title">
                <th>Grade Letter</th>
                <th>Grade Point</th>
                <th>Marks From</th>
                <th>Marks To</th>
            </tr>

            <?if(count($grade)>0){?>
            <?foreach($grade as $g){?>
            <tr>
                <td><input type='text' name='grade[]' value='<?=$g['grade']?>' class='text ui-widget-content ui-corner-all' /></td>
                <td><input type='text' name='grade_point[]' value='<?=$g['grade_point']?>' class='text ui-widget-content ui-corner-all' /></td>
                <td><input type='text' name='marks_from[]' value='<?=$g['marks_from']?>' class='text ui-widget-content ui-corner-all' /></td>
                <td><input type='text' name='marks_to[]' value='<?=$g['marks_to']?>' class='text ui-widget-content ui-corner-all' /></td>
            </tr>
            <?}
            if(count($grade)<11){
                $more=11-count($grade);
                for($i=1;$i<=$more;$i++){?>
                    <tr>
                        <td><input type='text' name='grade[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='grade_point[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='marks_from[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='marks_to[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                    </tr>
                <?}
            }

            ?>
            <?}else{?>
                <?for($i=1;$i<=11;$i++){?>
                    <tr>
                        <td><input type='text' name='grade[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='grade_point[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='marks_from[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                        <td><input type='text' name='marks_to[]' value='' class='text ui-widget-content ui-corner-all' /></td>
                    </tr>
                <?}?>
            <?}?>
            
            
        </table>

        <div class="txt_center" style="margin-top: 10px;">
            <input type='submit' name='update' value='Update Settings' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' />
        </div>
            
    </form>

</div>
<div class="clear"></div>