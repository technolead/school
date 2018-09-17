<head>
        <?php $site_data=common::get_settings_data()?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>School-College Management System ::</title>
        <base href="<?=base_url()?>" />
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="tools/superfish/css/superfish.css" media="screen" />
        <?php if($thickbox){ ?>
<link rel="stylesheet" href="<?=base_url();?>tools/thickbox/thickbox.css" />
<?php }?>
        <link href="tools/redmond/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
        <link href="tools/redmond/jquery.ui.dialog.css" rel="stylesheet" type="text/css" />
        <link href="tools/redmond/jquery.ui.button.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="tools/grid/css/ui.jqgrid.css" media="screen" />
        <script type='text/javascript' src='tools/jquery-1.4.2.min.js'></script>
        <script type='text/javascript' src='tools/jquery-ui-1.8.2.custom.min.js'></script>
        <script type='text/javascript' src='tools/grid/grid.locale-en.js'></script>
        <script type='text/javascript' src='tools/grid/jquery.jqGrid.min.js'></script>
        <script type='text/javascript' src='tools/superfish/js/superfish.js'></script>
        <script type='text/javascript' src='tools/jquery.validate.js'></script>
        <script type="text/javascript">
            var $j=jQuery.noConflict();
            var base_url="<?=base_url()?>";
        </script>
        <!--<script type='text/javascript' src='tools/jquery.valid_string.min.js'></script>-->
        <script type='text/javascript' src='script/classes.js'></script>
        <script type='text/javascript' src='script/accounts.js'></script>
        <script type='text/javascript' src='script/staffs.min.js'></script>
        <script type='text/javascript' src='script/script.js'></script>
        <?php if($editor) { ?>
        <!---Editor -->
        <script type="text/javascript" src="<?=base_url()?>tools/editor/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=base_url()?>tools/editor/editor.js"></script>
        <!---Editor -->
            <?php }?>
        <?php if($thickbox) { ?>
<script type="text/javascript" src="<?=base_url();?>tools/thickbox/thickbox.js"></script>
    <?php }?>
    </head>