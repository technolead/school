<div id="sidebar">
    Hello
</div>
<div id="main">
    <div class="pad_10_0" style="padding:10px 0;">
        <?php if(count($rows)>0):
            foreach ($rows as $row): ?>
        <div class="" style="padding:5px 0;">
            <h3 style="margin:0;padding:0;"><a href="<?=site_url('events/details/'.$row['event_id'].'/'.url_title($row['event_title']))?>"><?=$row['event_title']?></a></h3>
                    <?=word_limiter(strip_tags($row['event_des'], '<br>'),50)?>
            <div class="clear"></div>
        </div>
        <hr />
            <?php endforeach;
        endif;?>
    </div>
</div>