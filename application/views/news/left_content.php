<ul>
    <?php
    $categories=sql::rows('wb_event_category','status=1');
    if(count($categories)>0): ?>

        <?php foreach($categories as $cat): ?>
    <li><a href="<?=site_url('news/index/'.$cat['category_id'].'/'.url_title($cat['title']))?>"><?=$cat['title']?></a></li>
        <?php  endforeach;

    endif;
    ?>
</ul>