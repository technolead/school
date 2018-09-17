<div id="">
    <div>
        <?php if(count($featured_rows)>0):
            $inc=1;
            foreach($featured_rows as $frow): ?>
        <div class="homeUpperBox" <?php if($inc%2==0){echo 'style="margin:0 10px;"';}?> >
            <img src="uploads/featured/<?=$frow['featured_image']?>" alt="<?=$frow['featured_title']?>" />
            <?=common::get_featured_links_ul($frow['featured_links'])?>
        </div>
            <?php $inc++;   endforeach;
        endif;
        ?>
        <div class="clear"></div>
    </div>
    <div id="homeLower">
        <div id="news">
            <div id="rollover">
                <h3><a href="">Media Centre</a></h3>
                <a href="<?=site_url('news')?>" class="allNewsButton">View all news</a>
                <ol>
                    <?php if(count($news_rows)>0):
                        foreach($news_rows as $news):?>
                    <li>
                        <p>
                            <a href="<?=site_url('news/details/'.$news['news_id'].'/'.url_title($news['news_title']))?>"><?=$news['news_title']?></a><br />
                            <span class="small"><?=$news['news_date']?></span><br />
                            <a href=""><img src="uploads/news/270_230_<?=$news['news_image']?>" alt="" title="<?=$news['news_title']?>" /></a>
                        </p>
                    </li>
                        <?php endforeach;
endif;?>
                </ol>
            </div>
        </div><!-- news -->
        <div id="topEvent">
            <a href="<?=site_url('events')?>" class="allEventsButton">View all events</a>
            <h3><a href="<?=site_url('events')?>">Events</a></h3>
            <?php $eventDate=explode('-', $event_row['event_date'])?>
            <div class="eventsItemDate"><?=$eventDate[0]?> <br> <?=$eventDate[1]?> <br> <?=$eventDate[2]?></div>
            <div class="eventsItemTime"><?=$event_row['event_time']?></div>
            <div class="eventsItemTitle"><a href="<?=site_url('events/details/'.$event_row['wb_events_id'].'/'.url_title($event_row['event_title']))?>"><?=$event_row['event_title']?></a></div>
        </div><!-- topEvent -->
        <div id="usefulLinks">
            <p><strong>Useful links:</strong></p>
            <ul>
                <?php if(count($link_rows)>0):
    foreach($link_rows as $lnk): ?>
                <li><a href="<?=$lnk['link_url']?>" target=""><?=$lnk['link_title']?></a></li>
                    <?php      endforeach;
                endif;
?>
            </ul>
        </div>
    </div>
</div>