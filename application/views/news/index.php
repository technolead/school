<div id="sidebar">
    Hello
</div>
<div id="main">
    <div class="pad_10_0" style="padding:10px 0;">
    <?php if(count($rows)>0):
        foreach ($rows as $row): ?>
        <div class="" style="padding:5px 0;">
            <div class="fl_left" style="width:280px;">
                <h3 style="margin:0;padding:0;"><a href="<?=site_url('news/details/'.$row['news_id'].'/'.url_title($row['news_title']))?>"><?=$row['news_title']?></a></h3>
                    <?=word_limiter(strip_tags($row['news_des'], '<br>'),50)?>
            </div>
            <div class="fl_right">
                <img src="uploads/news/270_230_<?=$row['news_image']?>" alt="" />
            </div>
            <div class="clear"></div>
        </div>
        <hr />
        <?php endforeach;
endif;?>
    </div>
</div>