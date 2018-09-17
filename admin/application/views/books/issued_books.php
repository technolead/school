<?php if($msg!="") {
    echo "<div class='success'>$msg</div>";
}?>
<div class="form_content" style="width:880px;">
        <form action="<?=site_url('books/issued_books')?>" method="post">
            <table>
                <tr>
                    <th class="txt_right">ISBN</th><td><input type="text" name="isbn" value="<?=set_value('isbn')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Serial No</th><td><input type="text" name="serial_no" value="<?=set_value('serial_no')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Book Name</th><td><input type="text" name="book_name" value="<?=set_value('book_name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                </tr>
                <tr>
                    <th>Student ID</th>
                    <td><input type="text"  name="user_name" value="<?=set_value('user_name')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Last Name</th>
                    <td><input type="text"  name="name" value="<?=set_value('author')?>" class="text ui-widget-content ui-corner-all width_160" /></td>
                    <th>Issue Date</th>
                    <td><input type="text"  name="from_date" value="<?=set_value('from_date')?>" class="date_picker text ui-widget-content ui-corner-all width_80" /> To <input type="text" name="to_date" value="<?=set_value('to_date')?>" class="date_picker text ui-widget-content ui-corner-all width_80" /></td>
                    <td align="right"><input type='submit' name='apply_filter' value='Search' class='button' /></td>
                </tr>
            </table>
        </form>
    </div>
<div class='table_content'>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Issued Books</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
    <table cellpadding="1" cellspacing="1">
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
            <th>Action</th>
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
            <td class='view_links'>
                <a href="<?=site_url('books/receive_book/'.$row['issued_id'])?>" class="receive_link" title="Receive Book"></a>
                <a href='<?=site_url('books/edit_issued_book/'.$row['issued_id'])?>' class="edit_link" title="Change"></a>
                <a href='<?=site_url('books/delete_issued_book/'.$row['issued_id'])?>' class="delete_link" title="Delete" onclick='javascript: return confirm("Are you sure you want to delete?");'></a>
            </td>
        </tr>
        <?php $inc++;
    endforeach;
}else {
    echo "<tr><td colspan='5'>No Content Found!!!</td></tr>";
}  ?>
    </table>
    <div class="pagination_links">
        <div class="left"><?=$pagination_links?></div><div class="left width_500 b">Showing <?=$start?>-<?=$end?> of <?=$total?> Issued Books</div><div class="right"><?=$prev_next?></div>
        <div class="clear"></div>
    </div>
</div>