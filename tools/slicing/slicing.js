$j(document).ready(function() {

    //Custom settings
    var style_in = 'easeOutBounce';
    var style_out = 'jswing';
    var speed_in = 1000;
    var speed_out = 300;

    //Calculation for corners
    var neg = Math.round($j('.qitem').width() / 2) * (-1);
    var pos = neg * (-1);
    var out = pos * 2;

    $j('.qitem').each(function () {

        url = $j(this).find('a').attr('href');
        img = $j(this).find('img').attr('src');
        alt = $j(this).find('img').attr('img');

        $j('img', this).remove();
        $j(this).append('<div class="topLeft"></div><div class="topRight"></div><div class="bottomLeft"></div><div class="bottomRight"></div>');
        $j(this).children('div').css('background-image','url('+ img + ')');

        $j(this).find('div.topLeft').css({
            top:0,
            left:0,
            width:pos ,
            height:pos
        });
        $j(this).find('div.topRight').css({
            top:0,
            left:pos,
            width:pos ,
            height:pos
        });
        $j(this).find('div.bottomLeft').css({
            bottom:0,
            left:0,
            width:pos ,
            height:pos
        });
        $j(this).find('div.bottomRight').css({
            bottom:0,
            left:pos,
            width:pos ,
            height:pos
        });

    }).hover(function () {

        $j(this).find('div.topLeft').stop(false, true).animate({
            top:neg,
            left:neg
        }, {
            duration:speed_out,
            easing:style_out
        });
        $j(this).find('div.topRight').stop(false, true).animate({
            top:neg,
            left:out
        }, {
            duration:speed_out,
            easing:style_out
        });
        $j(this).find('div.bottomLeft').stop(false, true).animate({
            bottom:neg,
            left:neg
        }, {
            duration:speed_out,
            easing:style_out
        });
        $j(this).find('div.bottomRight').stop(false, true).animate({
            bottom:neg,
            left:out
        }, {
            duration:speed_out,
            easing:style_out
        });

    },

    function () {

        $j(this).find('div.topLeft').stop(false, true).animate({
            top:0,
            left:0
        }, {
            duration:speed_in,
            easing:style_in
        });
        $j(this).find('div.topRight').stop(false, true).animate({
            top:0,
            left:pos
        }, {
            duration:speed_in,
            easing:style_in
        });
        $j(this).find('div.bottomLeft').stop(false, true).animate({
            bottom:0,
            left:0
        }, {
            duration:speed_in,
            easing:style_in
        });
        $j(this).find('div.bottomRight').stop(false, true).animate({
            bottom:0,
            left:pos
        }, {
            duration:speed_in,
            easing:style_in
        });

    }).click (function () {
        window.location = $j(this).find('a').attr('href');
    });
});