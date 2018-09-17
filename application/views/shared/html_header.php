<head>
    
    <?php $site_data=common::get_settings_data()?>
    <?php $site_logo=common::get_site_logo();?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?=$page_title.' :: '.$site_data['site_title']?></title>
    <meta name="keywords" content="<?=$site_data['meta_keywords']?>" />
    <meta name="description" content="<?=$site_data['meta_description']?>" />
    <base href="<?=base_url()?>" />
    <link href="style/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="tools/slider/style.css" type="text/css" />
    <script type='text/javascript' src='tools/jquery-1.4.2.min.js'></script>
     <?php if($portal): ?>
        <link href="style/portal.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>admin/tools/redmond/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='<?=base_url()?>admin/tools/jquery-ui-1.8.2.custom.min.js'></script>
    <?php endif;?>
    <script type='text/javascript' src='tools/jquery.validate.js'></script>
    <script type="text/javascript">
        var $j=jQuery.noConflict();
        var base_url="<?=base_url()?>";
    </script>
    <?php if($slider_view):?>
    <link href="tools/slicing/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="tools/slider/slider.js"></script>
    <script type="text/javascript" src="tools/slicing/jquery.easing.1.3.js"></script>
     <script type="text/javascript" src="tools/slicing/slicing.js"></script>
    <?php endif;?>
    <?php if($portal):?>
    <script type="text/javascript" src="script/portal.js"></script>
    <?php endif;?>
    <script type='text/javascript' src='script/script.js'></script>
</head>