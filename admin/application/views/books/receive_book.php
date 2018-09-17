<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('books/receive_book/'.$issued_id)?>' method='post'>
        <table>
            <tr>
                <th>User Type</th>
                <td><?=$user_type?></td>
            </tr>
            <tr>
                <th>ID No</th>
                <td><?=$user_name?></td>
            </tr>
            <tr>
                <th>Borrower Details </th>
                <td><?=$borrower_name?></td>
            </tr>
            <tr>
                <th>Book Serial No </th>
                <td><?=$serial_no?></td>
            </tr>
            <tr>
                <th>Book Name </th>
                <td><?=$book_name?></td>
            </tr>
            <tr>
                <th>Issue Date</th>
                <td><?=$issue_date?></td>
            </tr>
            <tr>
                <th>Expiry Date </th>
                <td><?=$expiry_date?></td>
            </tr>
            <tr>
                <th>Return Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='return_date' value='<?=$return_date?>' class='text ui-widget-content ui-corner-all width_80 jbu_expiry_date date_picker required' /><?=form_error('return_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Fine Amount </th>
                <td><input type='text' name='fine_amount' value='<?=$fine_amount?>' class='text ui-widget-content ui-corner-all width_160 jbu_expiry_date' /><?=form_error('fine_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Paid Amount </th>
                <td><input type='text' name='paid_amount' value='<?=$paid_amount?>' class='text ui-widget-content ui-corner-all width_160 jbu_expiry_date width_160' /><?=form_error('paid_amount','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='update' value='Update' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>