var record = {
    id: null,
    action: 'save'
};

function create() {
    $('.form-control').val('');
    $('#damayanModal').modal('show');
}

function saveRecord() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        member_id: $('#member_id').val(),
        date: $('#date').val(),
        amount: $('#amount').val()
    };

    if(record.id === null) {
        $.post('/damayan_fund/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#damayanModal').modal('hide');
        });
    }
    else {
        $.post('/damayan_fund/update/'+record.id, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#damayanModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
}

function edit(id) {
    $.get(`/damayan_fund/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            if(i === "member") {
                $('.member-acc-number-display').text(formatNumber(v.id));
                $('#member').val(`${v.firstname} ${v.middlename} ${v.lastname}`);
                $('#member_id').val(`${v.id}`);
            }
            else {
                $(`#${i}`).val(v);
            }
        });
        $('#damayanModal').modal('show');
    });
}

function destroy(id, item){
    module = item;

    record.id = id;
    record.action = 'delete';

    $('#deleteModal').modal('show');
}

function yesDelete() {
    $.get(`/damayan_fund/destroy/${record.id}`, function() {
        $('#table').bootstrapTable('refresh');
        $('#deleteModal').modal('hide');
    });
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

var formatter = {
    account_number(v, r, i) {
        return formatNumber(r.id);
    },
    fullname(v, r, i) {
        return `${r.member.firstname} ${r.member.middlename} ${r.member.lastname}`;
    },
    fullname_member(v, r, i) {
        return `${r.firstname} ${r.middlename} ${r.lastname}`;
    },
    action(v, r, i) {
        return `<a href="#" onclick="edit(${r.id})"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    },
}