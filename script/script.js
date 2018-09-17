$j(document).ready(function(){
    
    new_window_open.init();
    $j('.cancel').click(function(){
        window.history.back();
    });
    $j("#valid_form").validate();


   
    

});


var new_window_open={

    init:function(){
        $j('.print_view').live('click',function(){
            new_window_open.print_view(this);
            return false;
        });
    },

    print_view:function(obj){
        var url=$j(obj).attr('rel');
        var title=$j(obj).attr('title');
        TheNewWin=window.open(url,title,'location = 1, width=800,height=600 resizable = no, status = 1, scrollbars = 1');
        var left   = (screen.width  - 800)/2;
        var top    = (screen.height - 600)/2;
        TheNewWin.moveTo(left,top);
    },
    print:function(){
        $j('#print').click(function(){
            window.print();
        });
    }
}
