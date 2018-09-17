<div id="footer">
    <div id="copyright">&copy; <?=$site_data['contact_name']?></div>
    <div id="footerLinks">
        <ul>
            <?=common::get_static_pages_li()?>
            <li>[ <a href="<?=site_url('student')?>">Student Portal</a> ]</li>
        </ul>
	<?=$site_data['contact_address'].' Tel: '.$site_data['contact_phone']?>
    </div>

</div><!-- footer -->

<?php common::track_uri();?>