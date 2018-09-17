<table cellpadding="1" cellspacing="1">
            <tr class='title'>
                <th>Period</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Teacher</th>

            </tr>


            <input type="hidden" name="day[]" value="<?=$day?>" />
            <?for($i=0;$i<8;$i++){?>
            
            <tr>
                <td align="center">
                    <select name="period_<?=$day?>_<?=$i?>" class="jperiod_<?=$day?>_<?=$i?>">
                        <?=combo::get_period_options($_REQUEST['period_'.$day."_".$i])?>
                    </select>
                </td>
                <td align="center">
                    <input type="text" name="time_<?=$day?>_<?=$i?>" value="<?=$_REQUEST['time_'.$day."_".$i]?>" />
                </td>
                <td align="center">
                    <select name="module_id_<?=$day?>_<?=$i?>" title="<?=$class_id?>"  id="<?=$day."_".$i?>" class="jmodule_staff"><?=combo::get_class_module($class_id,$_REQUEST['module_id_'.$day."_".$i])?></select>
                </td>

                <td align="center">
                    <select name="staffs_id_<?=$day?>_<?=$i?>" title="<?=$day?>_<?=$i?>" class="jstaff jmodule_staff_list_<?=$day."_".$i?>">
                        <option value=""> Select Staff</option>
                    </select>
                </td>
                <?}?>

            </tr>


        </table>