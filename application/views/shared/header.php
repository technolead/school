<!-- Header -->
<div id="header">
    <div class="container">
        
        <h1>
            <a href="<?=site_url('')?>" class="logo" style="background:url(uploads/site_logo/<?=$site_logo?>) top left no-repeat;" title="<?=$site_data['contact_name']?>"></a>
        </h1>
        
        
        <div class="fl_right loginInfos">
            <strong><?=date('l F d, Y')?></strong>&nbsp;&nbsp;<input type="text" name="query" value="" style="border:1px solid #7E9DB9;padding:2px;" /><input type="submit" name="search" value="Search" class="searchSubmit" />
        </div>
        <div class="clear"></div>
    </div>
    <div id="primaryNav">
        <ul>
            <li><a href="<?=site_url('home')?>">Home</a></li>
            <?=common::get_top_menu_li()?>
            
            
        </ul>
    </div>
</div>
<!-- /Header -->


