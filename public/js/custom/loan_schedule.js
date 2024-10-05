
var schedule_id = null;
var penalty_amount = null;
var selected_request = null

function payLoan(id) {
    schedule_id = id;

    $.get('/loan-request/get-schedule/'+id, function(response) {
        var d = response.record;
        var total_loan_amount = (parseFloat(d.details.loan_amount) + parseFloat(d.details.total_interest));
        var balance = parseFloat(total_loan_amount) - parseFloat(response.total_payment);
        selected_request = d.details;

        $('#receipt_no').val('');
        $('#schedule_date').val(d.date);
        $('#payment_date').val(d.date);
        $('#payment_amount').val(parseFloat(d.amount).toFixed(2));
        $('#loan_balance').val(balance.toFixed(2));
        penalty_amount = d.details.penalty_amount;
        
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

            var penalty = (parseFloat(penalty_amount)*parseFloat(daysDiff));

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
        $('#table').bootstrapTable('refresh');
        $('#payLoanModal').modal('hide');
    });
}

var formatter = {
    account_number(v, r, i) {
        return r.member.acc_no !== null ? formatNumber(r.member.acc_no):'-';
    },
    fullname(v, r, i) {
        return `${r.member.firstname} ${r.member.middlename} ${r.member.lastname}`;
    },
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