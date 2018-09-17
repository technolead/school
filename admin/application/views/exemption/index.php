<div class="form_content">
        <form action="<?=site_url('exemption')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">Student ID</th><td><input type="text" name="user_name" value="<?=$user_name?>" class="text ui-widget-content ui-corner-all width_200" /></td>
                    <th>Last Name</th><td><input type="text" name="name" value="<?=$name?>" class="text ui-widget-content ui-corner-all width_200" /></td>
                </tr>
                <tr>
                    <th colspan="2">Date: <input type="text" name="from_date" value="<?=$from_date?>" class="text ui-widget-content ui-corner-all width_80 date_picker" /> To: <input type="text" name="to_date" value="<?=$to_date?>" class="text ui-widget-content ui-corner-all width_80 date_picker" /></th>
                    <td colspan="2" align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
<div class='table_content'>
    <?php if($msg!="") {
        echo "<div class='success'>$msg</div>";
    }?>
    <table cellpadding="1" cellspacing="1">
        <tr class='title'>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
        <?php if(count($rows)>0) {
            $inc=1;
            foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
                    echo "class='even'";
                }else {
                    echo "class='odd'";
                    }?>>
            <td><?=$row['first_name'].' '.$row['last_name']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['from_date']?></td>
            <td><?=$row['to_date']?></td>
            <td><?=$row['reason']?></td>
            <td class='view_links'>
                <?php if(common::user_permit('update','std_attendance')) {?>
                    <a href='<?=site_url('exemption/edit_exemption/'.$row['exemption_id'])?>' class="edit_link" title="Change"></a>
                    <a href='<?=site_url('exemption/delete_exemption/'.$row['exemption_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
                <?php }?>
            </td>
        </tr>
                <?php $inc++;
            endforeach;
        }else {
            echo "<tr><td colspan='4'>No Content Found!!!</td></tr>";
        }  ?>
    </table>
</div>