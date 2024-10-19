var record = {
    id: null,
    action: 'save'
};

var selected_request = null;
var schedule_id = null;
var detail_id = null

function print(id) {
    var html = '';
    $.get(`/loan-request/edit/${id}`, function(response) {
        
        var r = response.record;
        var c = response.record.comaker;
        var v = response.record.member;

        $('.p_fullname').text(`${v.firstname} ${v.middlename} ${v.lastname}`);
        $('.p_account_number').text(`${v.acc_no !== null?formatNumber(v.acc_no):"-"}`);
        $('.p_address').text(`${v.address}`);
        $('.p_h_phone').text(`${v.contact_person_no}`);
        $('.p_o_phone').text(`${v.company_phone_no}`);
        $('.p_mobile').text(`${v.mobile_no}`);
        $('.p_occupation').text(`${v.occupation}`);
        $('.p_company_address').text(`${v.company_address}`);
        $('.p_spouse').text(`${v.spouse!==null?v.spouse:'-'}`);
        $('.p_spouse_occupation').text(`${v.spouse_occupation!==null?v.spouse_occupation:'-'}`);
        $('.p_no_children').text(`${v.no_children}`);
        $('.p_loan_amount').text(currency(r.loan_amount));
        
        $('.p_'+r.income_type).text('✓');
        $('.p_f_'+r.payment_frequency).text('✓');
        $('.p_income').text(currency(r.income_amount));
        
        $('.p_reference_1').text(`${r.reference_name_1 !== null?r.reference_name_1:'-'}`);
        $('.p_reference_no_1').text(`${r.reference_phone_1 !== null?r.reference_phone_1:'-'}`);
        $('.p_reference_relationship_1').text(`${r.reference_relationship_1 !== null?r.reference_relationship_1:'-'}`);
        
        $('.p_reference_2').text(`${r.reference_name_2 !== null?r.reference_name_2:'-'}`);
        $('.p_reference_no_2').text(`${r.reference_phone_2 !== null?r.reference_phone_2:'-'}`);
        $('.p_reference_relationship_2').text(`${r.reference_relationship_2 !== null?r.reference_relationship_2:'-'}`);

        $('.c_fullname').text(c !== null? `${c.firstname} ${c.middlename} ${c.lastname}`:'-');
        $('.c_account_number').text(c !== null? `${c.acc_no !== null?formatNumber(c.acc_no):"-"}`:'-');
        $('.c_address').text(c !== null? `${c.address}`:'-');
        $('.c_h_phone').text(c !== null? `${c.contact_person_no}`:'-');
        $('.c_o_phone').text(c !== null? `${c.company_phone_no}`:'-');
        $('.c_mobile').text(c !== null? `${c.mobile_no}`:'-');
        $('.c_occupation').text(c !== null? `${c.occupation}`:'-');
        $('.c_company_address').text(c !== null? `${c.company_address}`:'-');
        $('.c_spouse').text(c !== null? `${c.spouse!==null?c.spouse:'-'}`:'-');
        $('.c_spouse_occupation').text(c !== null? `${c.spouse_occupation!==null?c.spouse_occupation:'-'}`:'-');
        $('.c_no_children').text(c !== null? `${c.no_children}`:'-');

        $.each(response.record.details, (i,val) => {
            html += `<div style="display:flex;">`;
                html += `<div style="width:100%;text-align:left;">${val.loan_purpose}</div>`;
                html += `<div style="width:100%;text-align:left;">${currency(val.amount)}</div>`;
            html += `</div>`;
        });
        
        $('.purpose-list').html(html);
        
    });
    $('#printModal').modal('show');
}

function printFile() {
    var divContents = document.getElementById('printable_area').innerHTML;
    var a = window.open('', '', 'height=800, width=1200');
    a.document.write('<html>');
    a.document.write('<head>');
    a.document.write('</head>');
    a.document.write('<body id="print_canvas">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();

    setTimeout(function() {
        a.print();
    }, 2000);
}

function printSchedule() {
    var divContents = document.getElementById('printable_area_2').innerHTML;
    var a = window.open('', '', 'height=800, width=1200');
    a.document.write('<html>');
    a.document.write('<head>');
    a.document.write('</head>');
    a.document.write('<body id="print_canvas">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();

    setTimeout(function() {
        a.print();
    }, 2000);
}

function approve(id) {
    record.id = id;

    $('.status-modal').text('approve');
    $('#approvalModal').modal('show');
}

function decline(id) {
    record.id = id;

    $('.status-modal').text('decline');
    $('#approvalModal').modal('show');
}

function release(id) {
    record.id = id;

    $('.status-modal').text('release');
    $('#approvalModal').modal('show');
}

function yesApprove() {
    $.get(`/loan-request/${$('.status-modal').text()}/${record.id}`, function(response) {
        $('#table').bootstrapTable('refresh');
        $('#approvalModal').modal('hide');
    });
}

function create() {
    record.id = null;
    record.action = 'save';
    $('#loanApplicationModal').modal('show');
}

function onDblClickRow(row, type) {
    $(`.${type}-acc-number-display`).text(formatNumber(row.id));
    $(`#${type}`).val(`${row.firstname} ${row.middlename} ${row.lastname}`);
    $(`#${type}_id`).val(row.id);

    if(type === "member") {
        $('#income_type').val('monthly');
        $('#income_amount').val(row.monthly_income);
    }

    $('#selectModal').modal('hide');
}

function showMember(type) {
    
    $('#selectModal .search>input').val('');
    
    $.get(`/member/get-lookup`, {search: $('#selectModal .search>input').val(), id: 0}, function(response) {

        $('#member_list').bootstrapTable('load', response.rows).off('dbl-click-row.bs.table').on('dbl-click-row.bs.table', function(e, row) {
            onDblClickRow(row, type);
        });

        $('#selectModal').modal('show');
    });
    
}

function saveLoanRequest() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: $('#member_id').val(),
        income_type: $('#income_type').val(),
        income_amount: $('#income_amount').val(),
        payment_frequency: $('#payment_frequency').val(),
        no_of_payment: $('#no_of_payment').val(),
        loan_amount: $('#loan_amount').val(),
        loan_date: $('#loan_date').val(),
        reference_name_1: $('#reference_name_1').val(),
        reference_phone_1: $('#reference_phone_1').val(),
        reference_relationship_1: $('#reference_relationship_1').val(),
        reference_name_2: $('#reference_name_2').val(),
        reference_phone_2: $('#reference_phone_2').val(),
        reference_relationship_2: $('#reference_relationship_2').val(),
        co_maker_id: $('#co_maker_id').val() !== "" && $('#co_maker_id').val() !== null?$('#co_maker_id').val():0,
        purpose: []
    };
    
    $.each($('#purpose_list>div'), (i, v) => {
        data.purpose.push({
            loan_purpose: $('#purpose_list>div .loan_purpose')[i].textContent,
            amount: $('#purpose_list>div .purpose_amount')[i].textContent,
        });
    });
    
    if(record.id === null) {
        $.post('/loan-request/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('.form-control').val('');
            $('#loanApplicationModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
    else {
        $.post('/loan-request/update/'+record.id, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('.form-control').val('');
            $('#loanApplicationModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }

}

function addPurpose() {
    var html = '';

    if($('#loan_purpose').val() !== '' && $('#purpose_amount').val() !== '') {
        html += `<div class="row mb-2">`;
            html += `<div class="col-md-6 loan_purpose">${$('#loan_purpose').val()}</div>`;
            html += `<div class="col-md-5 purpose_amount">${$('#purpose_amount').val()}</div>`;
            html += `<div class="col-md-1"><button class="btn btn-danger" onclick="removeBeneficiary(this)"><i class="fa fa-times"></i></button></div>`;
        html += `</div>`;

        $('#loan_purpose').val('');
        $('#purpose_amount').val('');

        $('#purpose_list').append(html);
    }
    else {
        alert('Please provide the following information.');
    }
}

function viewSchedule(id) {

    $.get(`/loan-request/get-details/${id}`,function(response) {
        var d = response.record;
        var row = 15 - parseInt(d.schedule.length);
        var no = 0;
        var schedule = '';
        var payment = '';
        var total_loan_amount = (parseFloat(d.loan_amount) + parseFloat(d.total_interest));

        $('#ld_account_no').text(d.member.acc_no !== null?formatNumber(d.member.acc_no):"-");
        $('#ld_borrower').text(`${d.member.firstname} ${d.member.middlename} ${d.member.lastname}`);
        $('#ld_amount').text(currency(d.loan_amount));
        $('#ld_terms').text(d.schedule.length + "(" + d.loan.payment_frequency + ")");
        $('#ld_interest_rate').text(d.interest_rate + "%");
        $('#ld_penalty_rate').text(d.penalty_rate + "%");
        $('#ld_date').text(moment(d.date_avail).format('MMM DD, YYYY'));
        $('#ld_first').text(moment(d.first_payment).format('MMM DD, YYYY'));
        $('#ld_due').text(moment(d.due_date).format('MMM DD, YYYY'));

        $('#ld_loan_amount').text(currency(d.loan_amount));
        $('#ld_net_proceeds').text(currency(d.net_proceeds));
        $('#ld_interest').text(currency(d.total_interest));
        $('#ld_total_amount').text(currency(total_loan_amount));
        $('#ld_payment').text(currency(d.weekly_payment));
        $('#lp_total_payment').text(currency(Math.round(response.total_payment)));
        $('#total_payment').text(currency(total_loan_amount));
        $('#ld_penalty').text(currency(d.penalty_amount));

        $('#br_net_proceeds').text(currency(d.net_proceeds));
        $('#br_processing_fee').text(currency(d.processing_fee));
        $('#br_take_home').text(currency(parseFloat(d.net_proceeds) - parseFloat(d.processing_fee)));
        
        $('#lp_account_no').text(d.member.acc_no !== null?formatNumber(d.member.acc_no):"-");
        $('#lp_borrower').text(`${d.member.firstname} ${d.member.middlename} ${d.member.lastname}`);
        $('#lp_amount').text(currency(d.loan_amount));
        $('#lp_terms').text(d.schedule.length + "(" + d.loan.payment_frequency + ")");
        $('#lp_interest_rate').text(d.interest_rate + "%");
        $('#lp_penalty_rate').text(d.penalty_rate + "%");
        $('#lp_date').text(moment(d.date_avail).format('MMM DD, YYYY'));
        $('#lp_first').text(moment(d.first_payment).format('MMM DD, YYYY'));
        $('#lp_due').text(moment(d.due_date).format('MMM DD, YYYY'));
        
        $('#lp_loan_amount').text(currency(d.loan_amount));
        $('#lp_net_proceeds').text(currency(d.net_proceeds));
        $('#lp_interest').text(currency(d.total_interest));
        $('#lp_total_amount').text(currency(total_loan_amount));
        $('#lp_payment').text(currency(d.weekly_payment));
        $('#lp_penalty').text(currency(d.penalty_amount));

        $.each(d.schedule, (i,v)=>{
            schedule += `<tr>
                <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;font-weight:bold;">${i+1}</td>
                <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;font-weight:bold;">${moment(v.date).format('MMM DD, YYYY')}</td>
                <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;font-weight:bold;">${currency(v.amount)}</td>
            </tr>`;
        });

        $.each(d.schedule, (i,v)=>{
            if(v.payment !== null) {
                no = no + 1;
                payment += `<tr>
                    <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;font-weight:bold;">${no}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${moment(v.payment.date).format('MMM DD, YYYY')}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${currency(v.payment.amount)}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${currency(v.payment.penalty)}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${v.payment.user.name}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${v.payment.receipt_no}</td>
                    <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;">${currency(v.payment.loan_balance - v.payment.amount)}</td>
                </tr>`
            }
        });

        for(var i = 0; i < row; i++) {
            schedule += `<tr>
                <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
            </tr>`;
        }
        
        for(var i = 0; i < (15-no); i++) {
            payment += `<tr>
                <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
                <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;font-weight:bold;"></td>
            </tr>`
        }
        $('#ld_schedule').html(schedule);
        $('#lp_payment_table').html(payment);
        
        $('#loanScheduleModal').modal('show');

    });
}

function viewPayment(id) {
    detail_id = id;
    
    $.get(`/loan-request/get-details/${id}`,function(response) {
        selected_request = response.record;

        var total_loan_amount = (parseFloat(response.record.loan_amount) + parseFloat(response.record.total_interest));
        var balance = parseFloat(total_loan_amount) - parseFloat(response.total_payment);

        $('#schd_account_no').text(response.record.member.acc_no!==null?formatNumber(response.record.member.id):'-');
        $('#schd_account_name').text(`${response.record.member.firstname} ${response.record.member.middlename} ${response.record.member.lastname}`);
        $('#schd_loan_amount').text(currency(total_loan_amount));
        $('#schd_payment').text(currency(response.total_payment));
        $('#schd_balance').text(currency(balance));
        
        $('#schedule').bootstrapTable('load', response.record.schedule);

        $('#loanPaymentModal').modal('show');
    });
        
}

function payLoan(id) {
    schedule_id = id;

    $.get('/loan-request/get-schedule/'+id, function(response) {
        var d = response.record;
        var total_loan_amount = (parseFloat(selected_request.loan_amount) + parseFloat(selected_request.total_interest));
        var balance = parseFloat(total_loan_amount) - parseFloat(response.total_payment);

        $('#receipt_no').val('');
        $('#schedule_date').val(d.date);
        $('#payment_date').val(d.date);
        $('#payment_amount').val(parseFloat(d.amount).toFixed(2));
        $('#loan_balance').val(balance.toFixed(2));
        
        checkInterestRate($('#payment_date').val(), $('#schedule_date').val());

        $('#payLoanModal').modal('show');
    });
}

function checkInterestRate(date_1, date_2) {

    var start = new Date(date_1);
    var end = new Date(date_2);

    if (!isNaN(start) && !isNaN(end)) {
        if(start > end) {

            var timeDiff = start - end;
            var daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

            var penalty = (parseFloat(selected_request.penalty_amount )*parseFloat(daysDiff));

            $('#penalty').val(penalty.toFixed(2));
            $('.btn-no-penalty').css('display', 'inline-block');
            $('.btn-penalty').text('PAY WITH PENALTY');
        }
        else {
            $('#penalty').val('0');
            $('.btn-no-penalty').css('display', 'none');
            $('.btn-penalty').text('PAY');
        }
    }
    $('#payment_total').val(parseFloat($('#payment_amount').val()) + parseFloat($('#penalty').val()));
}

function checkInterestRate2(date_1, date_2) {
    $('#payment_total').val(parseFloat($('#payment_amount').val()) + parseFloat($('#penalty').val()));
}

function pay(type) {
    var data = {};
    if(type === 0) {
        data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            member_id: selected_request.member_id,
            loan_schedule_id: schedule_id,
            date: $('#payment_date').val(),
            amount: $('#payment_amount').val(),
            penalty: 0,
            receipt_no: $('#receipt_no').val(),
            loan_balance: $('#loan_balance').val(),
            status: 1,
        };
    }
    else if(type === 1) {
        data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            member_id: selected_request.member_id,
            loan_schedule_id: schedule_id,
            date: $('#payment_date').val(),
            amount: $('#payment_amount').val(),
            penalty: $('#penalty').val(),
            receipt_no: $('#receipt_no').val(),
            loan_balance: $('#loan_balance').val(),
            status: 1,
        };
    }

    $.post('/loan-request/save-payment', data).done((response)=>{
        viewPayment(selected_request.loan_request_id);
        $('#payLoanModal').modal('hide');
    });
}

function edit(id) {
    $.get(`/loan-request/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            if(i === "details") {
                $.each(v, (i, v) => {
                    html += `<div class="row mb-2" id="existing_${v.id}">
                                <div class="col-md-6 loan_purpose">${v.loan_purpose}</div>
                                <div class="col-md-5 purpose_amount">${v.amount}</div>
                                <div class="col-md-1"><button class="btn btn-danger" onclick="removePurpose(${v.id})"><i class="fa fa-times"></i></button></div>
                            </div>`;
                });

                $('#purpose_exist').html(html);
            }
            else if(i === "member") {
                $('.member-acc-number-display').text(formatNumber(v.id));
                $('#member').val(`${v.firstname} ${v.middlename} ${v.lastname}`);
                $('#member_id').val(`${v.id}`);
            }
            else if(i === "comaker") {
                $('.co_maker-acc-number-display').text(formatNumber(v.id));
                $('#co_maker').val(`${v.firstname} ${v.middlename} ${v.lastname}`);
                $('#co_maker_id').val(`${v.id}`);
            }
            else {
                $(`#${i}`).val(v);
            }
        });
        
        $('#purpose_list').html('');
        $('#loanApplicationModal').modal('show');
    });
}

function removePurpose(id) {
    $.get(`/loan-request/destroy-purpose/${id}`, function() {
        $(`#existing_${id}`).remove();
    });
}

function selectFrequency() {
    var frequency = $('#payment_frequency').val();

    switch(frequency) {
        case "monthly":
            $('#no_of_payment').val(3);

            break;
            
        case "semi_monthly":
            $('#no_of_payment').val(6);

            break;
            
        case "weekly":
            $('#no_of_payment').val(13);
            $('#chart_btn').css('display', 'table-cell');

            break;

        case "daily":
            $('#no_of_payment').val(90);

            break;
    }
    countwithInterest();
}

function countwithInterest() {
    var loan = parseFloat($('#loan_amount').val() !== ""?$('#loan_amount').val():0);
    var interest_rate = 4;

    var total = 0;
    var frequency = $('#payment_frequency').val();
    var ir = 0;

    var noOfPayments = parseFloat($('#no_of_payment').val());

    switch(frequency) {
        case "monthly":
            ir = (interest_rate/1) / 100;

            break;
            
        case "semi_monthly":
            ir = (interest_rate/2) / 100;

            break;
            
        case "weekly":
            var months = Math.round(noOfPayments / 4.345);
            
            var interestPerWeek = (((loan * (interest_rate / 100)) * months) / (months * 30)) * 7;
            var totalInterest = interestPerWeek * (noOfPayments - 1);
            var lastInterest = (loan * (interest_rate / 100) * months) - totalInterest;

            ir = (totalInterest + lastInterest)

            break;

        case "daily":
            ir = (interest_rate/30) / 100;

            break;
    }
    total = frequency !== "weekly"?(loan + (loan * ir) * parseFloat($('#no_of_payment').val()!==""?$('#no_of_payment').val():1)):(loan + ir);

    $('#with_interest').val(total.toFixed(2));
}

function editSched() {
    var html = '';
    $.each(selected_request.schedule, (i,v) => {
        html += `<tr id="field_${i}" data-id="${v.id}">
            <td><input type="date" class="form-control edit-date" value="${v.date}" ${v.status !== "draft"?"disabled":""}/></td>
            <td><input type="number" class="form-control edit-principal" oninput="inputUpdate(${i})" value="${parseFloat(v.principal_amount).toFixed(2)}" ${v.status !== "draft"?"disabled":""}/></td>
            <td><input type="number" class="form-control edit-interest" oninput="inputUpdate(${i})" value="${parseFloat(v.interest_amount).toFixed(2)}" ${v.status !== "draft"?"disabled":""}/></td>
            <td><input type="number" class="form-control edit-total" value="${parseFloat(v.amount).toFixed(2)}" disabled/></td>
        </tr>`;
    });
    $('#editable_schedule tbody').html(html);

    $('#editLoanModal').modal('show');
}

function inputUpdate(i) {
    var principal = parseFloat($(`#field_${i} .edit-principal`).val());
    var interest = parseFloat($(`#field_${i} .edit-interest`).val());
    var total = parseFloat(principal + interest).toFixed(2);

    $(`#field_${i} .edit-total`).val(total);
}

function saveEdit() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: detail_id,
        sched: []
    };

    $.each($('#editable_schedule tbody tr'), (i,v) => {
        var id = v.id;

        data.sched.push({
            id: $(`#${id}`).attr('data-id'),
            date: $(`#${id} .edit-date`).val(),
            principal_amount: $(`#${id} .edit-principal`).val(),
            interest_amount: $(`#${id} .edit-interest`).val(),
            amount: $(`#${id} .edit-total`).val()
        });
    });

    $.post('/loan-schedule/edit', data).done(function(response) {
        $('#editLoanModal').modal('hide');
        viewPayment(detail_id);
    });
    
}

function applyAll(n) {

    if(n === 1) {
        var v = $('#field_0 .edit-principal').val();
        $('.edit-principal').val(v);
    }
    else if(n === 2) {
        var v = $('#field_0 .edit-interest').val();
        $('.edit-interest').val(v);
    }
    
}

function viewChart() {
    $('#convert_month').val(0);
    $('#convert_week').val(0);
    $('#viewChartModal').modal('show');
}

function convertMonth() {
    var months = parseInt($('#convert_month').val());

    if (!isNaN(months) && months > 0) {
        var weeks = months * 4.35;
        $('#convert_week').val(Math.round(weeks.toFixed(2)));
    } else {
        $('#convert_week').val(0);
    }
}

function useConvert() {
    $('#no_of_payment').val($('#convert_week').val());
    $('#viewChartModal').modal('hide');
}

var formatter = {
    account_number(v, r, i) {
        return formatNumber(r.id);
    },
    interest(v, r, i) {
        var n = parseFloat(r.no_of_payment);
        var f = r.payment_frequency;
        var l = parseFloat(r.loan_amount);

        var ir = 4; 
        var rate = 0;

        switch(f) {
            case "monthly":
                rate = (ir / 1) / 100;
                break;
            case "semi_monthly":
                rate = (ir / 2)/ 100;
                break;
            case "weekly":
                // rate = (ir / 4.33)/ 100;
                
                var months = Math.round(n / 4.345);
                
                var interestPerWeek = (((l * (ir / 100)) * months) / (months * 30)) * 7;
                var totalInterest = interestPerWeek * (n - 1);
                var lastInterest = (l * (ir / 100) * months) - totalInterest;

                rate = (totalInterest + lastInterest);
                console.log(rate);

                break;
            case "daily":
                rate = (ir / 30.44)/ 100;
                break;
        }
        
        return currency(f !== "weekly"?((parseFloat(r.loan_amount) * (rate)) * n):rate);
    },
    account_no(v, r, i) {
        return r.member.acc_no !== null?formatNumber(r.member.acc_no):'-';
    },
    fullname(v, r, i) {
        return `${r.member.firstname} ${r.member.middlename} ${r.member.lastname}`;
    },
    fullname_member(v, r, i) {
        return `${r.firstname} ${r.middlename} ${r.lastname}`;
    },
    comaker(v, r, i) {
        return r.comaker !== null?`${r.comaker.firstname} ${r.comaker.middlename} ${r.comaker.lastname}`:'-';
    },
    loan_amount(v, r, i) {
        return currency(r.loan_amount);
    },
    terms(v, r, i) {
        return r.no_of_payment + " (" + r.payment_frequency + ")";
    },
    action(v, r, i) {
        return r.status === "draft"?`<a href="#" onclick="edit(${r.id})" class="text-primary" title="Edit"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>  <a href="#" onclick="print(${r.id})" class="text-warning" title="Print"><i class="fa fa-print"></i></a>`:`<a href="#" onclick="print(${r.id})" class="text-warning" title="Print"><i class="fa fa-print"></i></a>`;
    },
    approve(v, r, i) {
        var status = "";
        if(r.status === "draft") {
            status = `<button class="btn btn-sm btn-success" onclick="approve(${r.id})">APPROVE</button> <button class="btn btn-sm btn-danger" onclick="decline(${r.id})">DECLINE</button>`;
        }
        else if(r.status === "approve") {
            status = `<button class="btn btn-sm btn-light" onclick="release(${r.id})">RELEASE</button> <button class="btn btn-sm btn-light" title="Payment Schedule" onclick="viewSchedule(${r.id})"><i class="fa fa-calendar"></i></button>`;
        }
        else if(r.status === "release") {
            status = `<button class="btn btn-sm btn-light" title="Payment Schedule" onclick="viewSchedule(${r.id})"><i class="fa fa-calendar"></i></button> <button class="btn btn-sm btn-success" title="Payment" onclick="viewPayment(${r.id})"><i class="fa fa-money"></i></button>`;
        }
        return status;
    },
    status(v, r, i) {
        return "<span class='status-"+r.status+"'>" + (r.status === "draft"?"FOR CHECKING":(r.status === "approve"?"APPROVED":(r.status === "decline"?"DECLINED":"RELEASED"))) + "</span>";
    },
    schedule: {
        date(v, r, i) {
            return moment(r.date).format('MMM DD, YYYY');
        },
        amount(v, r, i) {
            return currency(r.amount);
        },
        payment_action(v, r, i) {
            return r.status === "draft"? "<button class='btn btn-sm btn-success' onclick='payLoan("+r.id+")'>PAY</button>":"<span class='text-danger'>PAID</span>"
        }
    }
}
