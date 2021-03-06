<div class='form_content'>
    <h3><?=$page_title?></h3>
    <form id="valid_form" action='<?=site_url('books/nw_issue_book')?>' method='post'>
        <table>
            <tr>
                <th>User Type <span class='req_mark'>*</span></th>
                <td><select name='user_type' class="jbu_type"><?=$this->mod_books->get_user_type_options(set_value('user_type'))?></select><?=form_error('user_type','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>ID No <span class='req_mark'>*</span></th>
                <td><input type='text' name='user_name' value='<?=set_value('user_name')?>' autocomplete="off" class='text ui-widget-content ui-corner-all required width_160 juas_username' /><?=form_error('user_name','<span>','</span>')?><div class="juas_list"></div></td>
            </tr>
            <tr>
                <th>Borrower Details <span class='req_mark'>*</span></th>
                <td><input type='text' name='borrower_details' value='<?=set_value('borrower_details')?>' readonly class='text ui-widget-content ui-corner-all required width_200 juas_name' /><?=form_error('borrower_details','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Book Serial No <span class='req_mark'>*</span></th>
                <td><input type='text' name='serial_no' value='<?=set_value('serial_no')?>' autocomplete="off" class='text ui-widget-content ui-corner-all required jbook_serial width_160' /><?=form_error('serial_no','<span>','</span>')?><div class="jbook_list"></div></td>
            </tr>
            <tr>
                <th>Book Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='book_name' readonly value='<?=set_value('book_name')?>' class='text ui-widget-content ui-corner-all required jbook_details width_200' /><?=form_error('book_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Issue Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='issue_date' value='<?=date('Y-m-d')?>' class='text ui-widget-content ui-corner-all required width_160 date_picker' /><?=form_error('issue_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Expiry Date <span class='req_mark'>*</span></th>
                <td><input type='text' name='expiry_date' value='<?=set_value('expiry_date')?>' class='text ui-widget-content ui-corner-all required jbu_expiry_date width_160 date_picker' /><?=form_error('expiry_date','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>