var accounts={
    init:function(){
        $j('.jaccount_class_id').change(function(){
            accounts.get_class_reg_info(this);
        });
        $j('.jaccount_level_id').change(function(){
            accounts.get_level_reg_info(this);
        });
        $j('.jreg_fee').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jreg_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jreg_error').html('')
            }
        });

        $j('.jextended_fee').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jextended_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jextended_error').html('')
            }
        });


        $j('.jdiscount').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jdiscount_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jdiscount_error').html('')
            }
        });

        $j('.jawarding_body_fee').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jawarding_body_fee_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jawarding_body_fee_error').html('')
            }
        });

        $j('.jdeferral').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jdeferral_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jdeferral_error').html('')
            }
        });

        $j('.jlibrary_fee').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jlibrary_fee_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jlibrary_fee_error').html('')
            }
        });

        $j('.jothers_fee').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jothers_fee_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jothers_fee_error').html('')
            }
        });

        $j('.jdeposit').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jdeposit_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jdeposit_error').html('')
            }
        });

        $j('.jcommitted_amount').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jcommitted_amount_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_class_balance();
                $j('.jcommitted_amount_error').html('')
            }
        });

        $j('.jprevious_due').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jprevious_due_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jprevious_due_error').html('')
            }
        });

        $j('.jextra_day_hour').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jextra_day_hour_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jextra_day_hour_error').html('')
            }
        });
        $j('.jother_add').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jother_add_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jother_add_error').html('')
            }
        });

        $j('.jpart_adv_pay').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jpart_adv_pay_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jpart_adv_pay_error').html('')
            }
        });

        $j('.jabsent_day_hour').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jabsent_day_hour_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jabsent_day_hour_error').html('')
            }
        });
        $j('.jlunch').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jlunch_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jlunch_error').html('')
            }
        });
        $j('.jother_deduce').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jother_deduce_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jother_deduce_error').html('')
            }
        });

        $j('.jnet_pay').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.jnet_pay_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.jnet_pay_error').html('')
            }
        });

        $j('.js_paid_amount').keyup(function(){
            if(isNaN(parseFloat($j(this).val()))){
                $j('.js_paid_amount_error').html('Please Enter Numeric Value!');
            }else{
                accounts.cal_staff_balance();
                $j('.js_paid_amount_error').html('')
            }
        });

    },
    get_class_reg_info:function(obj){
        var class_id=$j(obj).val();
        $j.ajax({
            type:'post',
            url:base_url+'accounts/get_class_reg_info/',
            data:{
                class_id:class_id
            },
            success:function(html){
                var data=html.split('##');
                if(data[0]==""){
                    $j('.jclass_fee').css('color','red');
                    $j('.jmonthly_fee').css('color','red');
                    $j('.jclass_fee').val("Not registered in this class!!");
                    $j('.jmonthly_fee').val("Not registered in this class!!");
                }else{
                    $j('.jclass_fee').css('color','black');
                    $j('.jmonthly_fee').css('color','black');
                    $j('.jclass_fee').val(data[0]);
                    $j('.jmonthly_fee').val(data[1]);
                    $j('.jstart_date').val(data[2]);
                    $j('.jend_date').val(data[3]);
                }
                
            },
            error:function(a,b,c){
                alert(a+'\n'+b+'\n'+c);
            }
        });
    },
    get_level_reg_info:function(obj){
        var levels_id=$j(obj).val();
        $j.ajax({
            type:'post',
            url:base_url+'accounts/get_level_reg_info/',
            data:{
                levels_id:levels_id
            },
            success:function(html){
                var data=html.split('##');
                $j('.jmapped_value').val(data[0]);
                $j('.jextended_date').val(data[1]);
            },
            error:function(a,b,c){
                alert(a+'\n'+b+'\n'+c);
            }
        });
    },
    cal_class_balance:function(){
        var total_balance=0;
        var mapped_value=parseFloat($j('.jmapped_value').val());
        var extended_fee=parseFloat($j('.jextended_fee').val());
        var reg_fee=parseFloat($j('.jreg_fee').val());
        var discount=parseFloat($j('.jdiscount').val());
        var awarding_body_fee=parseFloat($j('.jawarding_body_fee').val());
        var deferral=parseFloat($j('.jdeferral').val());
        var library_fee=parseFloat($j('.jlibrary_fee').val());
        var others_fee=parseFloat($j('.jothers_fee').val());
        //        var deposit=parseFloat($j('.jdeposit').val());

        if(!isNaN(mapped_value)){
            total_balance+=mapped_value;
        }
        if(!isNaN(extended_fee)){
            total_balance+=extended_fee;
        }
        if(!isNaN(reg_fee)){
            total_balance+=reg_fee;
        }
        if(!isNaN(discount)){
            total_balance-=discount;
        }
        if(!isNaN(awarding_body_fee)){
            total_balance+=awarding_body_fee;
        }
        if(!isNaN(deferral)){
            total_balance+=deferral;
        }
        if(!isNaN(library_fee)){
            total_balance+=library_fee;
        }
        if(!isNaN(others_fee)){
            total_balance+=others_fee;
        }
        //        if(!isNaN(deposit)){
        //            total_balance-=deposit;
        //        }

        $j('.jtotal_balance').val(total_balance);
    },
    cal_staff_balance:function(){
        var total_balance=0;
        var previous_due=parseFloat($j('.jprevious_due').val());
        var extra_day_hour=parseFloat($j('.jextra_day_hour').val());
        var other_add=parseFloat($j('.jother_add').val());
        var payable_total=0;
        if(!isNaN(previous_due)){
            payable_total+=previous_due;
        }
        if(!isNaN(extra_day_hour)){
            payable_total+=extra_day_hour;
        }
        if(!isNaN(other_add)){
            payable_total+=other_add;
        }
        $j('.jpayable_total').val(payable_total);
        $j('.jtobe_added').val(payable_total);

        var part_adv_pay=parseFloat($j('.jpart_adv_pay').val());
        var absent_day_hour=parseFloat($j('.jabsent_day_hour').val());
        var lunch=parseFloat($j('.jlunch').val());
        var other_deduce=parseFloat($j('.jother_deduce').val());
        var deduced_total=0;

        if(!isNaN(part_adv_pay)){
            deduced_total+=part_adv_pay;
        }
        if(!isNaN(absent_day_hour)){
            deduced_total+=absent_day_hour;
        }
        if(!isNaN(lunch)){
            deduced_total+=lunch;
        }
        if(!isNaN(other_deduce)){
            deduced_total+=other_deduce;
        }
        $j('.jdeduced_total').val(deduced_total);
        $j('.jtobe_deduce').val(deduced_total);

        var net_pay=parseFloat($j('.jnet_pay').val());
        if(!isNaN(net_pay)){
            total_balance=net_pay+payable_total-deduced_total;
        }
        $j('.jtotal').val(total_balance);

        var paid_amount=parseFloat($j('.js_paid_amount').val());
        var due=0;
        if(!isNaN(paid_amount)){
            due=total_balance-paid_amount;
        }else{
            due=total_balance;
        }

        $j('.js_due').val(due);
    }
}