$j(document).ready(function() {
    //Execute the slideShow, set 4 seconds for each images
    slider.slideShow(4000);

});

var slider={
    slideShow:function(speed){
        //append a LI item to the UL list for displaying caption
        $j('ul.slideshow').append('<li id="slideshow-caption" class="caption"><div class="slideshow-caption-container"><h3></h3><p></p></div></li>');

        //Set the opacity of all images to 0
        $j('ul.slideshow li').css({
            opacity: 0.0
        });

        //Get the first image and display it (set it to full opacity)
        $j('ul.slideshow li:first').css({
            opacity: 1.0
        });

        //Get the caption of the first image from REL attribute and display it
        $j('#slideshow-caption h3').html($j('ul.slideshow a:first').find('img').attr('title'));
        $j('#slideshow-caption p').html($j('ul.slideshow a:first').find('img').attr('alt'));

        //Display the caption
        $j('#slideshow-caption').css({
            opacity: 0.53,
            bottom:0
        });

        //Call the gallery function to run the slideshow
        var timer = setInterval('slider.gallery()',speed);

        //pause the slideshow on mouse over
        $j('ul.slideshow').hover(
            function () {
                clearInterval(timer);
            },
            function () {
                timer = setInterval('slider.gallery()',speed);
            }
            );
    },
    gallery:function(){

        //if no IMGs have the show class, grab the first image
        var current = ($j('ul.slideshow li.show')?  $j('ul.slideshow li.show') : $j('#ul.slideshow li:first'));

        //Get next image, if it reached the end of the slideshow, rotate it back to the first image
        var next = ((current.next().length) ? ((current.next().attr('id') == 'slideshow-caption')? $j('ul.slideshow li:first') :current.next()) : $j('ul.slideshow li:first'));

        //Get next image caption
        var title = next.find('img').attr('title');
        var desc = next.find('img').attr('alt');

        //Set the fade in effect for the next image, show class has higher z-index
        next.css({
            opacity: 0.0
        }).addClass('show').animate({
            opacity: 1.0
        }, 1000);

        //Hide the caption first, and then set and display the caption
        $j('#slideshow-caption').animate({
            bottom:-100
        }, 1000, function () {
            //Display the content
            $j('#slideshow-caption h3').html(title);
            $j('#slideshow-caption p').html(desc);
            $j('#slideshow-caption').animate({
                bottom:0
            }, 800);
        });

        //Hide the current image
        current.animate({
            opacity: 0.0
        }, 1000).removeClass('show');

    }
}