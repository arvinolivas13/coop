var record = {
    id: null,
    action: 'save'
};

function edit(id) {
    $.get(`/loan-payment/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            if(i === "amount") {
                $('#payment_amount').val(v);
            }
            else if(i === "date") {
                $('#payment_date').val(v);
            }
            else if(i === "member") {
                $('.member-acc-number-display').text(formatNumber(v.id));
                $('#member').val(v.firstname + " " + v.lastname);
                $('#member_id').val(v.id);
            }
            else {
                $(`#${i}`).val(v);
            }
        });
        $('#payLoanModal').modal('show');
    });
}

function pay(type) {
    var data = {};
    if(type === 0) {
        data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
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
            date: $('#payment_date').val(),
            amount: $('#payment_amount').val(),
            penalty: $('#penalty').val(),
            receipt_no: $('#receipt_no').val(),
            loan_balance: $('#loan_balance').val(),
            status: 1,
        };
    }

    $.post('/loan-payment/update/' + record.id, data).done((response)=>{
        $('#table').bootstrapTable('refresh');
        $('#payLoanModal').modal('hide');
    });
}

var formatter = {
    action(v, r, i) {
        return `<a href="#" onclick="edit(${r.id})"><i class="fa fa-edit"></i></a>`;
    },
    account_number(v, r, i) {
        return formatNumber(r.member_id);
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
    received_by(v, r, i) {
        return `${r.user.name}`;
    }
}