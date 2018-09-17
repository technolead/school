<div class='form_content'>
    <h3><?=$page_title?></h3>
    <?php if($msg!='') {
    echo '<div class="error">'.$msg.'</div>';
}?>
    <form action='<?=site_url('report/library_report')?>' method='post'>
        <table>
            <tr>
                <th>User Type</th>
                <td><select name='user_type'><?=$this->mod_books->get_user_type_options(set_value('user_type'))?></select><?=form_error('user_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Issue Date</th>
                <td><input type='text' name='issue_date' value='<?=set_value('issue_date',date('Y-m-d'))?>' class='text ui-widget-content ui-corner-all width_80 date_picker' /><?=form_error('issue_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Expiry Date</th>
                <td><input type='text' name='expiry_date' value='<?=set_value('expiry_date',date('Y-m-d'))?>' class='text ui-widget-content ui-corner-all jbu_expiry_date width_80 date_picker' /><?=form_error('expiry_date','<span>','</span>')?></td>
            </tr>
            <tr><th>&nbsp;</th>
                <td><input type='submit' name='gen_report' value='Generate Report' class='button' />  <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
<?php if(count($rows)>0) {?>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left b"><?=$page_title?></div>
        <div class="clear"></div>
    </div>
    <table cellspacing="1" cellpadding="1">
        <tr class='title'>
            <th>User Type</th>
            <th>Borrower Name</th>
            <th>ID No.</th>
            <th>Serial No.</th>
            <th>Book Name</th>
            <th>Issue Date</th>
            <th>Expiry Date</th>
            <th>Return Date</th>
            <th>Fine Amount</th>
            <th>Paid Amount</th>
            <th>Due</th>
        </tr>
            <?php if(count($rows)>0) {
        $inc=1;
        foreach($rows as $row):?>
        <tr <?php if($inc%2==0) {
                echo "class='even txt_center'";
            }else {
                echo "class='odd txt_center'";
            }?>>
            <td><?=$row['user_type']?></td>
            <td><?=$row['borrower_name']?></td>
            <td><?=$row['user_name']?></td>
            <td><?=$row['serial_no']?></td>
            <td><?=$row['book_name']?></td>
            <td><?=$row['issue_date']?></td>
            <td><?=$row['expiry_date']?></td>
            <td><?=$row['return_date']?></td>
            <td><?=$row['fine_amount']?></td>
            <td><?=$row['paid_amount']?></td>
            <td><?=$row['fine_amount']-$row['paid_amount']?></td>
        </tr>
            <?php $inc++;
        endforeach;
    }else {
        echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
    }  ?>
    </table>
</div>
    <?php }?>