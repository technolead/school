<ul>
    <?php
    $cat=sql::rows('wb_static_pages','status=1');
    if(count($cat)>0): ?>

        <?php foreach($cat as $row): ?>
    <li><a href="<?=site_url('site/'.$row['page_name'])?>"><?=$row['page_title']?></a></li>
        <?php  endforeach;

    endif;
    ?>
</ul>