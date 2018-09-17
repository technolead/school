var classes={
    init:function(){
        $j('.jclass_id').change(function(){
            /*classes.get_class_levels(this);*/
            classes.get_class_details(this);
        });
        $j('.jselected_class_id').change(function(){
            classes.get_selected_class_details(this);
        });
        $j('.jawarding_body_id').change(function(){
            classes.get_awarding_body_class(this);
        });

        $j('.jawarding_body_session').change(function(){
            classes.get_awarding_body_session(this);
        });

        $j('.jlevels_id').change(function(){
            classes.get_levels_module(this);
        });
        $j('.jclass_details_id').change(function(){
            classes.get_class_details(this);
        });
        $j('.jclass_module').change(function(){
            classes.get_class_module(this);
        });
        $j('.jsession_id').change(function(){
            classes.get_session_details(this);
        });
        $j('.jmodule_level').change(function(){
            classes.module_level(this);
        });
        $j('.jclass_session').change(function(){
            classes.get_class_session(this);
        });
        $j('.jsession_class').change(function(){
            classes.get_session_class(this);
        });

        $j('.jclass_for_exam').change(function(){
            classes.get_class_for_exam_details(this);
        });
    },
    get_awarding_body_class:function(obj){
        var awarding_body_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_awarding_body_class",
            data: {
                awarding_body_id:awarding_body_id
            },
            beforeSend:function(){
                $j('.jclass_list').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                $j('.jclass_list').html(html);
            }
        });
    },
     get_awarding_body_session:function(obj){
        var awarding_body_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_awarding_body_session",
            data: {
                awarding_body_id:awarding_body_id
            },
            beforeSend:function(){
                $j('.jsession_list').html("<option value=''>Loading...</option>");
                $j('.jclass_list').html("<option value=''>Loading...</option>");
                $j('.jexam_list').html("<option value=''>Loading...</option>");
                $j('.jclass_optional_module').html("<option value=''>Select Optional Module...</option>");
                $j('.jc_start_date').val("");
                $j('.jc_end_date').val("");
                $j('.jclass_fee').val("");
            },
            success: function(html){
                var data=html.split('##');
                $j('.jsession_list').html(data[0]);
                $j('.jclass_list').html(data[1]);
            }
        });
    },
    get_class_levels:function(obj){
        var class_id=$j(obj).val();
        //alert(programs_id);
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/class_levels",
            data: {
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jlevels_list').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                //alert('ok'+html);
                $j('.jlevels_list').html(html);
            }
        });
    },
    get_levels_module:function(obj){
        var levels_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/levels_module",
            data: {
                levels_id:levels_id
            },
            beforeSend:function(){
                $j('.jmodule_list').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                $j('.jmodule_list').html(html);
            }
        });
    },
    get_class_details:function(obj){
        var class_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_class_details",
            data: {
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                var data=html.split('##');
                $j('.jclass_duration').val(data[0]);
                $j('.jc_awarding_body').html(data[1]);

            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_selected_class_details:function(obj){
        var class_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_selected_class_details",
            data: {
                class_id:class_id
            },
            
            success: function(html){
                var data=html.split('##');
                $j('.jc_start_date').val(data[0]);
                $j('.jc_end_date').val(data[1]);
                $j('.jclass_optional_module').html(data[2]);

            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_class_module:function(obj){
        var class_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/class_module",
            data: {
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                $j('.jmodule_list').html(html);
            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_class_session:function(obj){
        var class_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/class_session",
            data: {
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                $j('.jclass_session_list').html(html);
            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_session_class:function(obj){
        var jsession_id=$j("select[name='session_id']").val();     
        
        
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/session_class",
            data: {
                jsession_id:jsession_id
                
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
                $j('.jexam_list').html("<option value=''>Loading...</option>");
                $j('.jc_start_date').val("");
                $j('.jc_end_date').val("");
                $j('.jclass_optional_module').html("<option value=''>Select Optional Module</option>");

            },
            success: function(html){
                $j('.jsession_class_list').html(html);
            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_session_details:function(obj){
        var session_id=$j(obj).val();
        var class_id=$j("select[name='class_id']").val();
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_session_details",
            data: {
                session_id:session_id,
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                var data=html.split('##');
                $j('.js_start_date').val(data[0]);
                $j('.js_end_date').val(data[1]);
                $j('.js_session_duration').val(data[2]);

            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    module_level:function(obj){
        var module_id=$j(obj).val();
        var lclass=$j(obj).attr('title');
        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/module_level",
            data: {
                module_id:module_id
            },
            beforeSend:function(){
                $j('.jclass_details').html("<option value=''>Loading...</option>");
            },
            success: function(html){
                $j('.'+lclass).val(html);
            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    },
    get_class_for_exam_details:function(obj){
        var jsession_id=$j("select[name='session_id']").val();        
        var class_id=$j(obj).val();


        $j.ajax({
            type: "post",
            url: base_url+"ajax_content/get_exam_for_class",
            data: {
                jsession_id:jsession_id,                
                class_id:class_id
            },
            beforeSend:function(){
                $j('.jexam_list').html("<option value=''>Loading...</option>");
                
            },
            success: function(html){
                $j('.jexam_list').html(html);
            },
            error:function(sta,error,msg){
            //alert(sta+error+msg);
            }
        });
    }
}