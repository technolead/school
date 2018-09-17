$j(document).ready(function(){
    //valid_string.init();
    common.init();
    user.init();
    classes.init();
    sort_data.init();
    new_window_open.init();
    student.init();
    result.init();
    books.init();
    accounts.init();
    staffs.init();
    
    $j('button.button,input[type="button"].button,input[type="submit"].button,input[type="reset"].button,button.cancel,input[type="button"]').button();
    $j(".date_picker").datepicker({
        dateFormat:'yy-mm-dd',
        showOn:'both',
        buttonImage:base_url+'images/calendar.gif',
        buttonImageOnly:true,
        changeYear:true
    });
    $j(".tooolbars #add").button({
        icons: {
            primary: 'ui-icon-plus'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-pencil'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-trash'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-circle-check'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-circle-close'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon ui-icon-disk'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-circle-arrow-n'
        }
    }).next().button({
        icons: {
            primary: 'ui-icon-key'
        }
    });
    $j('ul.sf-menu').superfish();
    $j("#valid_form").validate();

    //
    $j("#tabs").tabs();
    $j('.cancel').click(function(){
        window.history.back();
    });
    $j('.jclass_fee_delete').click(function(){
        common.delete_class_fee(this);
    });
    $j(".jsel_all").change( function() {
        if($j(this).attr('checked')){
            $j('.select_std').attr('checked','checked');
        }else{
            $j('.select_std').attr('checked','');
        }
    });
    $j('.jposted_to').click(function(){
        if($j(this).val()==2){
            $j('.jindividual_box').css('display','block');
        }else{
            $j('.jindividual_box').css('display','none');
        }
        
    });

    $j('.jreceive').click(function(){        
        common.receive_fee(this);
    });

    $j('.jmark').live('keyup',function(){
        common.match_module_mark(this);
        common.get_grade(this);
    });

    $j('.jmodule_staff').live('change',function(){
        common.get_assigned_staff(this);
    });

    $j('.show_routine_div').live('click',
        function(){
            common.load_routine_div(this);
            
        }
    );
    $j('.jroutine_toggle').live('click',function(){
        var day=$j(this).attr('title');
        $j('#div_'+day).toggle();
    });

    $j('.jstaff').live('change',function(){
        common.check_unique_period(this);
    });

    
});
var common={
    init:function(){
        $j('.jadd_button').click(function(){
            common.add_content(this);
        });
        $j('.jedit_button').click(function(){
            common.edit_content(this);
        });
        $j('.jdelete_button').click(function(){
            common.delete_content(this);
        });
        $j('.jstatus_button').click(function(){
            common.status_content(this);
        });
    },
    add_content:function(obj){
        var url=$j(obj).attr('title');
        window.location=base_url+url;
    },
    edit_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];        
        var url=$j(obj).attr('title');
        window.location=base_url+url+'/'+id;
        return false;
    },
    delete_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];
        if(confirm('Are you sure want to delete the content?')){
            var url=$j(obj).attr('title');
            window.location=base_url+url+'/'+id;
        }

        return false;
    },
    status_content:function(obj){
        var s=$j("#data_grid").jqGrid('getGridParam','selarrrow');
        if(s.length==0){
            alert('Please select a record!');
            return false;
        }
        var id=s[0];
        var url=$j(obj).attr('title');
        window.location=base_url+url+'/'+id;
        return false;
    }
    ,
    delete_class_fee:function(obj){
        var url=$j(obj).attr('title');
        window.location=base_url+url;
    }

    ,
    receive_fee:function(obj){
        var url=$j(obj).attr('title');        
        $j('#std_fee_form').attr('action',url);        
        $j('#std_fee_form').submit();
    },
    get_grade:function(obj){
        var mark=$j(obj).val();
        var student_id=$j(obj).attr('title');
        var module_mark=$j('.jmodule_mark').html();
        
        
        $j.ajax({
            type:'post',
            url:base_url+'result/get_grade',
            data:{
                mark:mark,
                module_mark:module_mark
            },
            success:function(html){
                $j('.jgrade_'+student_id).html(html);
                $j('.jgradeInp_'+student_id).val(html);
            }
        });
        
    },
    match_module_mark:function(obj){
        var module_mark=parseFloat($j('.jmodule_mark').html());
        var student_mark=parseFloat($j(obj).val());
        var student_id=$j(obj).attr('title');
        if(student_mark>module_mark){
            alert('Invalid Mark');
            $j(obj).val('');
            $j('.jgrade_'+student_id).html('');
            $j('.jgradeInp_'+student_id).val('');
        }
    },
    get_assigned_staff:function(obj){
        var module_id=$j(obj).val();
        var class_id=$j(obj).attr('title');
        var id=$j(obj).attr('id');
        $j.ajax({
            type:'post',
            url:base_url+'ajax_content/get_assigned_staff',
            data:{
                module_id:module_id,
                class_id:class_id
            },
            beforesend:function(){
                $j('.jmodule_staff_list_'+id).html('Loading..');
            },
            success:function(html){                
                $j('.jmodule_staff_list_'+id).html(html);
            },
            error:function(a,b,c){
                //alert(a+'\n'+b+'\n'+c);
            }
        })
    },

    load_routine_div:function(obj){

        $j(obj).addClass('jroutine_toggle');
        var day=$j(obj).attr('title');
        var class_id=$j('#jclass_id').html();
        $j(obj).removeClass('show_routine_div');
        
        $j.ajax({
            type:'post',
            url:base_url+'classes/load_routine_div',
            data:{
                day:day,
                class_id:class_id
            },

            success:function(html){
                $j('#div_'+day).html(html);
            },
            error:function(a,b,c){
                //alert(a+'\n'+b+'\n'+c);
            }
        })

    },
    hide_routine_div:function(obj){
        var day=$j(obj).attr('title');
        $j('#div_'+day).css('display','none');
    },
    check_unique_period:function(obj){
        var id=$j(obj).attr('title');
        var day=id.split('_');
        day=day[0];
        var staffs_id=$j(obj).val();
        var period=$j('.jperiod_'+id).val();

        $j.ajax({
            type:'post',
            url:base_url+'classes/check_unique_period',
            data:{
                day:day,
                period:period,
                staffs_id:staffs_id
            },

            success:function(msg){
                if(msg!=''){
                    alert(msg);
                }
                
            },
            error:function(a,b,c){
                //alert(a+'\n'+b+'\n'+c);
            }
        })
        
    }
    

}
var user={
    init:function(){
        $j('.user_id_gen').click(function(){
            user.generate_user_id();
        });
        $j('.juas_username').keyup(function(){
            user.get_user_list();
        });
    },
    generate_user_id:function(){
        var first_name=$j("input[name='first_name']").val();
        var last_name=$j("input[name='last_name']").val();
        if(first_name==''){
            alert("The First Name Field is Required!");
            $j("input[name='first_name']").focus();
            return false;
        }
        if(last_name==''){
            alert("The Last Name Field is Required!");
            $j("input[name='last_name']").focus();
            return false;
        }
        $j.ajax({
            type: "post",
            url: base_url+"user/generate_user_id",
            data: {
                first_name:first_name,
                last_name:last_name
            },
            beforeSend:function(){
                $j('.user_id_gen').val("Working...");
            },
            success: function(html){
                $j("input[name='user_name']").val(html);
                $j('.user_id_gen').val("Generate");
            }
        });
        return false;
    },
    bind:function(){
        $j('.juas_list').find('li').unbind('click');
        $j('.juas_list').find('li').bind('click',function(){
            $j('.juas_username').val($j(this).attr('title'));
            $j('.juas_name').val($j(this).attr('rel'));
            $j('.juas_list').css('display','none');
        });
    }
    ,
    get_user_list:function(){
        $j('.juas_list').css('display','block');
        var search=$j('.juas_username').val();
        $j.ajax({
            type:'post',
            url:base_url+'user/get_user_list/',
            data:{
                search:search
            },
            success:function(html){
                $j('.juas_list').html(html);
                user.bind();
            },
            error:function(a,b,c){
            //alert(a+'\n'+b+'\n'+c);
            }
        });
    }

}

var student={
    init:function(){
        $j('.jlevel_id').change(function(){
            student.get_levels_info(this);
        });
        $j('.jreg_level_id').change(function(){
            student.get_levels_reg_info(this);
        });
        $j('.jstudent_username').keyup(function(){
            student.get_student_list();
        });
    },
    get_levels_info:function(obj){
        var levels_id=$j(obj).val();
        $j.ajax({
            type: "post",
            url: base_url+"levels/get_levels_info",
            data: {
                levels_id:levels_id
            },
            beforeSend:function(){
                $j('.jmodule_list').html("Working...");
            },
            success: function(html){
                $j('.jlevel_duration').val(html);
            }
        });
    },
    get_levels_reg_info:function(obj){
        var levels_id=$j(obj).val();
        var student_id=$j(obj).attr('title');
        $j.ajax({
            type: "post",
            url: base_url+"levels/levels_reg_info",
            data: {
                levels_id:levels_id,
                student_id:student_id
            },
            beforeSend:function(){
            //$j('.sdfsd').html("Working...");
            },
            success: function(html){
                var data=html.split('##');
                $j('.js_level_duration').val(data[0]);
                $j('.js_level_start_date').val(data[1]);
                $j('.js_level_end_date').val(data[2]);
                $j('.js_level_extd_date').val(data[3]);
            }
        });
    },
    bind:function(){
        $j('.jstudent_list').find('li').unbind('click');
        $j('.jstudent_list').find('li').bind('click',function(){
            $j('.jstudent_username').val($j(this).attr('title'));
            $j("input[name='student_id']").val($j(this).attr('rel'));
            $j('.jstudent_list').css('display','none');
        });
    }
    ,
    get_student_list:function(){
        $j('.jstudent_list').css('display','block');
        var search=$j('.jstudent_username').val();
        $j.ajax({
            type:'post',
            url:base_url+'student/get_student_list/',
            data:{
                search:search
            },
            success:function(html){
                $j('.jstudent_list').html(html);
                student.bind();
            },
            error:function(a,b,c){
            //alert(a+'\n'+b+'\n'+c);
            }
        });
    }
}
var sort_data={
    init:function(){
        $j('.jconf_type').change(function(){
            sort_data.conf_type(this);
        });
        $j('.jconf_status').change(function(){
            sort_data.conf_status(this);
        });
        $j('.js_abody_id').change(function(){
            sort_data.awarding_body_class(this)
        });
        $j('.sort_levels_map').change(function(){
            sort_data.sort_levels_map(this)
        });
        $j('.sort_module_map').change(function(){
            sort_data.sort_module_map(this)
        });
        $j('.sort_session_map').change(function(){
            sort_data.sort_session_map(this)
        });
        $j('.sort_staffs_list').change(function(){
            sort_data.sort_staffs_list(this)
        });
        $j('.jsort_attendance').change(function(){

            sort_data.get_class_attendance();
        });
        $j('.jsort_std_attendance').change(function(){
            sort_data.get_student_attendance();
        });
        $j('.jsort_module_result').change(function(){
            sort_data.sort_module_result();
        });
        $j('.jsel_month_year').change(function(){
            sort_data.cng_month_sess();
        });
        $j('.sort_module_dis').change(function(){
            sort_data.sort_module_dis(this)
        });


        $j('.jsort_tutorial_result').change(function(){
            sort_data.sort_tutorial_result();
        });
    },
    conf_type:function(obj){
        var ctype=$j(obj).val();
        window.location=base_url+'college_config/index/'+ctype
    },
    conf_status:function(obj){
        var cstatus=$j(obj).val();
        window.location=base_url+'college_config/manage_status/'+cstatus
    },
    awarding_body_class:function(obj){
        var abody_id=$j(obj).val();
        window.location=base_url+'classes/mapping/'+abody_id
    },
    sort_levels_map:function(obj){
        var programs_id=$j(obj).val();
        window.location=base_url+'levels/mapping/'+programs_id
    },
    sort_module_map:function(obj){
        var class_id=$j(obj).val();
        window.location=base_url+'modules/mapping/'+class_id
    },
    sort_module_dis:function(obj){
        var staffs_id=$j(obj).val();
        window.location=base_url+'modules/mng_distribution/'+staffs_id
    },
    sort_session_map:function(){
        //var jsession_id=$j(obj).val();
        var jsession_id=$j("select[name='jsession_id']").val();
        window.location=base_url+'session/mapping/'+jsession_id
    },
    sort_staffs_list:function(obj){
        var department_id=$j(obj).val();
        window.location=base_url+'staffs/manage_staffs/'+department_id
    },
    get_class_attendance:function(){
        
        var attendance_type_id=$j("select[name='jattendance_type_id']").val();
        if(attendance_type_id==''){
            attendance_type_id=0;
        }
        //console.log(attendance_type_id);
        window.location=base_url+'attendance/class_attendance/'+attendance_type_id;
    },

 
    get_student_attendance:function(){
        
        var attendance_type_id=$j("select[name='jattendance_type_id']").val();
        if(attendance_type_id==''){
            attendance_type_id='all';
        }
        window.location=base_url+'attendance/student_attendance/'+attendance_type_id;
    },
    sort_module_result:function(){
        var module_id=$j("select[name='jmodule_id']").val();
        if(module_id==''){
            module_id='all';
        }
        var jsession_id=$j("select[name='jsession_id']").val();
        if(jsession_id==''){
            jsession_id='all';
        }
        window.location=base_url+'result/index/'+module_id+'/'+jsession_id;
    },
    sort_tutorial_result:function(){
        var module_id=$j("select[name='jmodule_id']").val();
        if(module_id==''){
            module_id='all';
        }
        var exam_id=$j("select[name='jexam_id']").val();
        if(exam_id==''){
            exam_id='all';
        }
        window.location=base_url+'result/tutorial_result/'+module_id+'/'+exam_id;
    },
    cng_month_sess:function(){
        $j.ajax({
            type: "post",
            url: base_url+"staff_account/cng_month_sess",
            data: {
                month:$j("select[name='month']").val(),
                year:$j("select[name='year']").val()
            },
            beforeSend:function(){
                $j('.jmodule_list').html("Working...");
            },
            success: function(html){
                //alert(html);
                window.location=html;
            }
        });
    }
}
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

var result={
    init:function(){
        $j('.jmodule_result').click(function(){
            result.edit_std_result(this);
            return false;
        });

        $j('.jtutorial_result').click(function(){            
            result.edit_std_tutorial_result(this);
            return false;
        });
    },
    edit_std_result:function(obj){
        var result_id=$j(obj).attr('rel');
        $j.ajax({
            type:'post',
            url:base_url+'result/edit_std_result/'+result_id,
            data:{},
            success:function(html){
                $j('#jmodule_result_form').html(html);
            },
            error:function(e,m,s){
            //alert(e+m+s);
            }
        })
    },
    update_std_result:function(frm){
        if(frm.marks.value==''){
            alert('The Mark field is required!');
            frm.marks.focus();
            return false;
        }
        if(frm.grade.value=='') alert('The Grade filed is required!');
        if(frm.attempt.value=='') alert('The Attempt filed is required!');
        if(frm.result_status.value=='') alert('The Result Status filed is required!');
        $j.ajax({
            url:base_url+'result/update_result',
            type:'post',
            data:{
                marks:frm.marks.value,
                grade:frm.grade.value,
                attempt:frm.attempt.value,
                notes:frm.notes.value,
                result_status:frm.result_status.value
            },
            success:function(html){
                if(html=='success'){
                    window.location=base_url+frm.title;
                }
                else{
                    alert(html);
                }
            }
        })
        return false;
    },

    edit_std_tutorial_result:function(obj){
        var result_id=$j(obj).attr('rel');
        $j.ajax({
            type:'post',
            url:base_url+'result/edit_std_tutorial_result/'+result_id,            
            data:{},
            success:function(html){                
                $j('#jtutorial_result_form').html(html);
            },
            error:function(e,m,s){
            //alert(e+m+s);
            }
        })
    },
    update_std_tutorial_result:function(frm){
        if(frm.obtained_marks.value==''){
            alert('The Obtained Mark field is required!');
            frm.obtained_marks.focus();
            return false;
        }
        
        $j.ajax({
            url:base_url+'result/update_tutorial_result',
            type:'post',
            data:{
                obtained_marks:frm.obtained_marks.value
            },
            success:function(html){
                if(html=='success'){
                    window.location=base_url+frm.title;
                }
                else{
                    alert(html);
                }
            }
        })
        return false;
    }
}
var books={
    init:function(){
        $j('.jbu_type').change(function(){
            books.get_expiry_date(this);
        });
        $j('.jbook_serial').keyup(function(){
            books.get_book_list();
        });
    },
    get_expiry_date:function(obj){
        $j.ajax({
            type:'post',
            url:base_url+'books/get_expiry_date',
            data:{
                user_type:$j(obj).val()
            },
            success:function(html){
                $j('.jbu_expiry_date').val(html);
            },
            error:function(m,e){
            //alert(m+e);
            }
        });
    },
    bind:function(){
        $j('.jbook_list').find('li').unbind('click');
        $j('.jbook_list').find('li').bind('click',function(){
            $j('.jbook_serial').val($j(this).attr('title'));
            $j('.jbook_details').val($j(this).attr('rel'));
            $j('.jbook_list').css('display','none');
        });
    }
    ,
    get_book_list:function(){
        $j('.jbook_list').css('display','block');
        var search=$j('.jbook_serial').val();
        $j.ajax({
            type:'post',
            url:base_url+'books/get_book_list/',
            data:{
                search:search
            },
            success:function(html){
                $j('.jbook_list').html(html);
                books.bind();
            },
            error:function(a,b,c){
                alert(a+'\n'+b+'\n'+c);
            }
        });
    }
    
}