var record = {
    id: null,
    action: 'save',
    capital: {
        id: null,
        action: 'save'
    },
    savings: {
        id: null,
        action: 'save'
    }
};

var total_savings = 0;
var total_capital = 0;
var member_id = null;

var store_img = {
    signature: null,
    profile_photo: null
};

var module = 'member';
$(document).ready(function(){
    $("#profile_photo").cropzee({
        allowedInputs: ['png','jpg','jpeg'],
        imageExtension:'image/jpeg',
        allowSelect: false,
        aspectRatio: 1, 
        returnImageMode:'data-url',
    });
    
    $("#signature").cropzee({
        allowedInputs: ['png','jpg','jpeg'],
        imageExtension:'image/jpeg',
        allowSelect: false,
        aspectRatio: 6/ 16, 
        returnImageMode:'data-url'
    });

    $(document).on('click', function (event) {
        var target = $(event.target);

        if (!target.closest($('#cropzee-modal')).length) {
            event.stopPropagation();
        }
    });
});

// Member

function saveRecord() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        acc_no: $('#acc_no').val(),
        firstname: $('#firstname').val(),
        middlename: $('#middlename').val(),
        lastname: $('#lastname').val(),
        nickname: $('#nickname').val(),
        address: $('#address').val(),
        religion: $('#religion').val(),
        birthdate: $('#birthdate').val(),
        birthplace: $('#birthplace').val(),
        gender: $('#gender').val(),
        mobile_no: $('#mobile_no').val(),
        email_address: $('#email_address').val(),
        occupation: $('#occupation').val(),
        civil_status: $('#civil_status').val(),
        spouse: $('#spouse').val(),
        spouse_occupation: $('#spouse_occupation').val(),
        no_children: $('#no_children').val(),
        mothers_name: $('#mothers_name').val(),
        fathers_name: $('#fathers_name').val(),
        company: $('#company').val(),
        company_phone_no: $('#company_phone_no').val(),
        company_address: $('#company_address').val(),
        source_of_income: $('#source_of_income').val(),
        monthly_income: $('#monthly_income').val(),
        educational_attainment: $('#educational_attainment').val(),
        contact_person: $('#contact_person').val(),
        contact_person_no: $('#contact_person_no').val(),
        contact_person_address: $('#contact_person_address').val(),
        status: $('#status').val(),
        beneficiary: []
    };

    $.each($('#beneficiary_list>div'), (i, v) => {
        data.beneficiary.push({
            name: $('#beneficiary_list>div .name')[i].textContent,
            age: $('#beneficiary_list>div .age')[i].textContent,
            relationship: $('#beneficiary_list>div .relationship')[i].textContent,
        });
    });

    if(record.id === null) {
        $.post('/member/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('.form-control').val('');
            $('#lastname').focus();
            $('#beneficiary_list').html('');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
    else {
        $.post(`/member/update/${record.id}`, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#memberModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }

}

function create() {
    record.id = null;
    record.action = 'save';
    $('.form-control').val('');
    $('#existing_beneficiary').html('');
    $('#beneficiary_list').html('');
}

function edit(id) {
    $.get(`/member/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            if(i === "beneficiaries") {
                $.each(v, (i, v) => {
                    html += `<div class="row mb-2 bg-light" id="existing_${v.id}">`;
                        html += `<div class="col-md-6 name">${v.name}</div>`;
                        html += `<div class="col-md-2 age">${v.age}</div>`;
                        html += `<div class="col-md-3 relationship">${v.relationship}</div>`;
                        html += `<div class="col-md-1"><button class="btn btn-danger" onclick="removeExisting(${v.id})"><i class="fa fa-times"></i></button></div>`;
                    html += `</div>`;
                });

                $('#existing_beneficiary').html(html);
            }
            else {
                $(`#${i}`).val(v);
            }
        });
        $('#beneficiary_list').html('');
        $('#memberModal').modal('show');
    });
}

function destroy(id, item){
    module = item;

    if(module === "member") {
        record.id = id;
        record.action = 'delete';
    }
    else if(module === "capital") {
        record.capital.id = id;
        record.capital.action = 'delete';
    }
    else if(module === "savings") {
        record.savings.id = id;
        record.savings.action = 'delete';
    }

    $('#deleteModal').modal('show');
}

function yesDelete() {
    if(module === "member") {
        $.get(`/member/destroy/${record.id}`, function() {
            $('#table').bootstrapTable('refresh');
            $('#deleteModal').modal('hide');
        });
    }
    else if(module === "capital") {
        $.get(`/capital/destroy/${record.capital.id}`, function() {
            $('#table').bootstrapTable('refresh');
            loadCapital();
            $('#deleteModal').modal('hide');
        });
    }
    else if(module === "savings") {
        $.get(`/savings/destroy/${record.savings.id}`, function() {
            $('#table').bootstrapTable('refresh');
            loadSavings();
            $('#deleteModal').modal('hide');
        });
    }
}

function selectCivil() {
    if($('#civil_status').val() === 'single') {
        $('#spouse').prop('disabled', true);
        $('#spouse_occupation').prop('disabled', true);
    }
    else {
        $('#spouse').prop('disabled', false);
        $('#spouse_occupation').prop('disabled', false);
    }
}

function addBeneficiary() {
    var html = '';

    if($('#beneficiary_name').val() !== '' && $('#beneficiary_age').val() !== '' && $('#relationship').val() !== '') {
        html += `<div class="row mb-2">`;
            html += `<div class="col-md-6 name">${$('#beneficiary_name').val()}</div>`;
            html += `<div class="col-md-2 age">${$('#beneficiary_age').val()}</div>`;
            html += `<div class="col-md-3 relationship">${$('#relationship').val()}</div>`;
            html += `<div class="col-md-1"><button class="btn btn-danger" onclick="removeBeneficiary(this)"><i class="fa fa-times"></i></button></div>`;
        html += `</div>`;

        $('#beneficiary_name').val('');
        $('#beneficiary_age').val('');
        $('#relationship').val('');

        $('#beneficiary_list').append(html);
    }
    else {
        alert('Please provide the beneficiary information.');
    }
}

function removeBeneficiary(val) {
    $($(val).parent()[0]).parent().remove()
}

function removeExisting(id) {
    $.get(`/member/destroy-beneficiary/${id}`, function() {
        $(`#existing_${id}`).remove();
    });
}

function print(id) {
    var html = '';
    $.get(`/member/edit/${id}`, function(response) {
        
        record.id = response.record.id;

        $.each(response.record, (i, v) => {
            if(i === "beneficiaries") {
                $.each(v, (i, v) => {
                    html += `<div style="display:flex;">`;
                        html += `<div style="width:100%;text-align:center;">${v.name}</div>`;
                        html += `<div style="width:100%;text-align:center;">${v.age}</div>`;
                        html += `<div style="width:100%;text-align:center;">${v.relationship}</div>`;
                    html += `</div>`;
                });
                $('#print_beneficiary').html(html);
            }
            else if(i === 'status') {
                $('.p_regular').text(v === 'regular'?'✓':'');
                $('.p_associate').text(v === 'srscc'?'✓':'');
            }
            
            else if(i === 'details') {
                if(v !== null) {
                    $('.photo').css('background', `url("storage/photo/${v.photo}")no-repeat`);
                    $('.photo').css('background-position', 'center center');
                    $('.photo').css('background-size', 'cover');
                }
            }
            else {
                $(`.p_${i}`).text(v !== null?v:'-');
            }
        });
    });
    $('#printModal').modal('show');
}

function printFile(id) {
    var divContents = document.getElementById(id).innerHTML;
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

function addDetails(id) {
    record.id = id;
    $('#memberDetailsModal').modal('show');
    $.get('/member/get-details/' + id, function(response) {
        if(response.details !== null) {
            record.action = 'update';

            store_img.profile_photo = null;
            store_img.signature = null;

            $('.image-previewer').css('background', `url("/storage/photo/${response.details.photo}")`);
            $('.image-previewer-2').css('background', `url("/storage/signature/${response.details.signature}")`);

            $('#resolution_no').val(response.details.resolution_no);
            $('#member_fee').val(response.details.member_fee);
            $('#resolution_date').val(response.details.date);
            $('#or_no').val(response.details.or_no);
            memberType();
        }
        else {
            record.action = 'save';

            store_img.profile_photo = null;
            store_img.signature = null;

            $('.image-previewer').css('background', `url("/img/profile/default.png")`);
            $('.image-previewer-2').css('background', '#eee');
            
            $('#resolution_no').val('');
            $('#resolution_date').val('');
            $('#member_fee').val("1");
            $('#or_no').val('');
        }
    });
}

function saveDetails() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: record.id,
        photo: store_img.profile_photo,
        signature: store_img.signature,
        or_no: $('#or_no').val(),
        member_fee: $('#member_fee').val(),
        resolution_no: $('#resolution_no').val(),
        date: $('#resolution_date').val(),
        action: record.action
    };

    $.post('/member/save-details', data).done((response)=>{
        $('#memberDetailsModal').modal('hide');
    }).fail((response)=>{
    });
}

function memberType() {
    if($('#member_fee').val() === "1") { 
        $('.membership').css('display', 'block');
    }
    else {
        $('.membership').css('display', 'none');
    }
}

// Loan
function applyLoan(id, name, monthly, acc_no) {
    record.id = id;

    $('#account_number').val(acc_no !== null?formatNumber(acc_no):'-');
    $('#account_name').val(name);
    $('#income_type').val('monthly');
    $('#income_amount').val(monthly);

    $('#purpose_list').html('');
    $('#loanApplicationModal').modal('show');
}

function getRate() {
    $.get('/loan-type/edit/' + $('#loan_type_id').val(), function(response) {
        $('#loan_type_rate').val(response.record.rate);
        countwithInterest();
    });
}

function saveLoanRequest() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: record.id,
        loan_type_id: $('#loan_type_id').val(),
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

// Capital
function viewCapital(id) {
    record.id = id;

    loadCapital();
}

function loadCapital() {
    $.get(`/capital/get/${record.id}`, function(response) {
        var row = 28;
        var table = '';

        row = parseInt(row - response.rows.length);

        $.each(response.rows, (i,v) => {
            var balance = 0;
            balance += parseFloat(v.amount);

            table += `<tr>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;font-weight: bold;text-align:left;">${moment(v.date).format('MMM DD, YYYY')}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${currency(v.amount)}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${v.receipt_number}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${currency(v.balance)}</td>
                </tr>`;
        });
        
        for(var i = 1; i <= row; i++) {
            table += `<tr>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                </tr>`;
        }

        $('#table_capital tbody').html(table);
        
        $('#cap_account_no').text(response.record.acc_no !== null?formatNumber(parseInt(response.record.acc_no)):'-');
        $('#cap_name').text(`${response.record.firstname} ${response.record.middlename} ${response.record.lastname}`);
        $('#cap_contact').text(`${response.record.mobile_no}`);
        $('#cap_address').text(`${response.record.address}`);
        $('#cap_email').text(`${response.record.email_address}`);
        $('#cap_birthday').text(`${moment(response.record.birthdate).format('MMM DD, YYYY')}`);

        $('#capital').bootstrapTable('load', response.rows);
        $('.total').text(currency(response.sum));

        $('#capitalModal').modal('show');
    });
}

function printCapital() {
}

function addCapital() {
    record.capital.id = null;
    record.capital.action = 'save';

    $('.form-control').val('');
    $('#addCapitalModal').modal('show');
}

function saveCapital() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: record.id,
        receipt_number: $('#cap_receipt_number').val(),
        amount: $('#cap_amount').val(),
        date: $('#cap_date').val()
    };
    
    if(record.capital.id === null) {
        $.post('/capital/save', data).done(function(response) {
            loadCapital();
            $('#table').bootstrapTable('refresh');
            $('#addCapitalModal').modal('hide');
            $('#addCapitalModal .form-control').val('');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#cap_'+i).addClass('error');
            });
        });
    }
    else {
        $.post(`/capital/update/${record.capital.id}`, data).done(function(response) {
            loadCapital();
            $('#table').bootstrapTable('refresh');
            $('#addCapitalModal').modal('hide');
            $('#addCapitalModal .form-control').val('');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#cap_'+i).addClass('error');
            });
        });
    }
}

function editCapital(id) {
    $.get(`/capital/edit/${id}`, function(response) {

        record.capital.id = response.record.id;
        record.capital.action = 'update';

        $.each(response.record, (i, v) => {
            $(`#cap_${i}`).val(v);
        });
        
        $('#addCapitalModal').modal('show');
    });
}

// Savings
function viewSavings(id) {
    record.id = id;

    loadSavings();
}

function loadSavings() {
    $.get(`/savings/get/${record.id}`, function(response) {
        var row = 28;
        var table = '';

        row = parseInt(row - response.rows.length);

        $.each(response.rows, (i,v) => {
            var balance = 0;
            balance += parseFloat(v.amount);

            table += `<tr>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;font-weight: bold;text-align:left;">${moment(v.date).format('MMM DD, YYYY')}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${currency(v.amount)}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${v.receipt_number}</td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;text-align:left;">${currency(v.balance)}</td>
                </tr>`;
        });
        
        for(var i = 1; i <= row; i++) {
            table += `<tr>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                    <td style="padding: 3px 10px;height: 25px;border: 1px solid;font-size: 10px;"></td>
                </tr>`;
        }

        $('#table_savings tbody').html(table);
        
        $('#sav_account_no').text(response.record.acc_no !== null?formatNumber(parseFloat(response.record.acc_no)):'-');
        $('#sav_name').text(`${response.record.firstname} ${response.record.middlename} ${response.record.lastname}`);
        $('#sav_contact').text(`${response.record.mobile_no}`);
        $('#sav_address').text(`${response.record.address}`);
        $('#sav_email').text(`${response.record.email_address}`);
        $('#sav_birthday').text(`${moment(response.record.birthdate).format('MMM DD, YYYY')}`);

        $('#savings').bootstrapTable('load', response.rows);
        $('.sav_total').text(currency(response.sum));

        $('#savingsModal').modal('show');
    });
}

function addSavings() {
    record.savings.id = null;
    record.savings.action = 'save';
    
    $('.form-control').val('');
    $('#addSavingsModal').modal('show');
}

function saveSavings() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: record.id,
        receipt_number: $('#sav_receipt_number').val(),
        amount: $('#sav_amount').val(),
        date: $('#sav_date').val()
    };
    
    if(record.savings.id === null) {
        $.post('/savings/save', data).done(function(response) {
            loadSavings();
            $('#table').bootstrapTable('refresh');
            $('#addSavingsModal').modal('hide');
            $('#addSavingsModal .form-control').val('');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#sav_'+i).addClass('error');
            });
        });
    }
    else {
        $.post(`/savings/update/${record.savings.id}`, data).done(function(response) {
            loadSavings();
            $('#table').bootstrapTable('refresh');
            $('#addSavingsModal').modal('hide');
            $('#addSavingsModal .form-control').val('');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#sav_'+i).addClass('error');
            });
        });
    }
}

function addDamayanFund() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: record.id,
        receipt_number: "-",
        amount: "200",
        date: moment().format("YYYY-MM-DD"),
        damayan_status: 1
    };
    $.post('/savings/save', data).done(function(response) {
        loadSavings();
        $('#table').bootstrapTable('refresh');
        $('#addSavingsModal').modal('hide');
        $('#addSavingsModal .form-control').val('');
    }).fail(function(response) {
        $.each(response.responseJSON.errors, (i,v) => {
            $('#sav_'+i).addClass('error');
        });
    });
}

function editSavings(id) {
    $.get(`/savings/edit/${id}`, function(response) {

        record.savings.id = response.record.id;
        record.savings.action = 'update';

        $.each(response.record, (i, v) => {
            $(`#sav_${i}`).val(v);
        });
        
        $('#addSavingsModal').modal('show');
    });
}

// Other

function onDblClickRow(row) {
    $('.acc-number-display').text(row.acc_no !== null?formatNumber(row.acc_no):'-');
    $('#co_maker').val(`${row.firstname} ${row.middlename} ${row.lastname}`);
    $('#co_maker_id').val(row.id);
    $('#selectModal').modal('hide');
}

function showMember() {
    
    $('#selectModal .search>input').val('');

    $.get(`/member/get-lookup`, {search: $('#selectModal .search>input').val(), id: record.id}, function(response) {

        $('#member_list').bootstrapTable('load', response.rows).off('dbl-click-row.bs.table').on('dbl-click-row.bs.table', function(e, row) {
            onDblClickRow(row);
        });

        $('#selectModal').modal('show');
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
    var interest_rate = parseFloat($('#loan_type_rate').val());;

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

function closedAccount(id, savings, capital) {
    total_capital = capital;
    total_savings = savings;
    member_id = id;

    $('#closedAccountModal').modal('show');
}

function yesClose() {
    const today = new Date();
    const formattedDate = today.toLocaleDateString('en-CA');
    
    if(total_savings > 0) {
        var savings_data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            member_id: member_id,
            receipt_number: '-',
            amount: "-"+total_savings,
            date: formattedDate
        };
        
        $.post('/savings/save', savings_data).done(function(response) {
            loadSavings();
            $('#table').bootstrapTable('refresh');
        });
    }

    if(total_capital > 0) {
        var capital_data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            member_id: member_id,
            receipt_number: '-',
            amount: "-"+total_capital,
            date: formattedDate
        };
    
        $.post('/capital/save', capital_data).done(function(response) {
            loadCapital();
            $('#table').bootstrapTable('refresh');
        });
    }

    $.post('/member/close-account', { _token: $('meta[name="csrf-token"]').attr('content'), id: member_id }).done(function(response) {
        $('#table').bootstrapTable('refresh');
    });
    
}

var formatter = {
    account_number(v, r, i) {
        return r.acc_no !== null ? formatNumber(r.acc_no):'-';
    },
    fullname(v, r, i) {
        return `<div class="member_${r.member_status}">${r.firstname} ${r.middlename} ${r.lastname}</div>`;
    },
    gender(v, r, i) {
        return `${r.gender.toUpperCase()}`;
    },
    birthdate(v, r, i) {
        return `${moment(r.birthdate).format('MMM DD, YYYY')}`;
    },
    beneficiary(v, r, i) {
        return `<i class="fa fa-users"></i> ${r.beneficiaries.length}`;
    },
    status(v, r, i) {
        return `<span class="${r.status==="regular"?'text-success':'text-warning'}" style="font-weight:bold;">${r.status==="regular"?'REGULAR':'ASSOCIATE MEMBER OF THE SRSCC'}</span>`;
    },
    amount(v, r, i) {
        
        return `<span class="${r.amount < 0?'withdraw':''} damayan_${r.damayan_status}">` + currency(r.amount) + `</span>`;
    },
    balance(v, r, i) {
        return currency(r.balance);
    },
    share_capital(v, r, i) {
        var amount = 0;

        if(r.share_capital !== null) {
            r.share_capital.forEach(item => {
                amount += parseFloat(item.amount);
            });
        }

        return `<button class="btn btn-light btn-sm" onclick="viewCapital(${r.id})">${currency(amount)}</button>`;
    },
    savings(v, r, i) {
        var amount = 0;

        if(r.savings !== null) {
            r.savings.forEach(item => {
                amount += parseFloat(item.amount);
            });
        }

        return `<button class="btn btn-light btn-sm" onclick="viewSavings(${r.id})">${currency(amount)}</button>`;
    },
    total_fund(v, r, i) {
        var amount = 0;

        if(r.savings !== null) {
            r.savings.forEach(item => {
                amount += parseFloat(item.amount);
            });
        }

        if(r.share_capital !== null) {
            r.share_capital.forEach(item => {
                amount += parseFloat(item.amount);
            });
        }

        return `<span class="btn btn-light btn-sm" style="font-weight: bold;">${currency(amount)}</span>`;
    },
    action(v, r, i) {
        var savings = 0;
        var capital = 0;

        if(r.savings !== null) {
            r.savings.forEach(item => {
                savings += parseFloat(item.amount);
            });
        }
        if(r.share_capital !== null) {
            r.share_capital.forEach(item => {
                capital += parseFloat(item.amount);
            });
        }

        return (r.member_status === 0?`<a href="#" onclick="edit(${r.id})" class="text-primary" title="Edit"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>  <a href="#" onclick="print(${r.id})" class="text-warning" title="Print"><i class="fa fa-print"></i></a>  <a href="#" onclick="applyLoan(${r.id}, '${r.firstname} ${r.middlename} ${r.lastname}', '${r.monthly_income}', ${r.acc_no},)" class="text-primary" title="Request Loan"><i class="fa fa-credit-card"></i></a> <a href="#" onclick="addDetails(${r.id})"><i class="fa fa-check text-success" aria-hidden="true"></i></a> <a href="#" onclick="closedAccount(${r.id}, ${savings}, ${capital})"><i class="fa fa-ban text-danger" aria-hidden="true"></i></a>`:`<a href="#"><i class="fa fa-lock text-warning" aria-hidden="true"></i></a>`);
    },
    action_2(v, r, i) {
        return `<a href="#" onclick="editCapital(${r.id})" class="text-primary" title="Edit"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'capital')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    },
    action_3(v, r, i) {
        return `<a href="#" onclick="editSavings(${r.id})" class="text-primary" title="Edit"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'savings')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    }
}
