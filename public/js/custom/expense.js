var record = {
    id: null,
    action: 'save'
};

function create() {
    $('.form-control').val('');
    $('#expenseModal').modal('show');
}

function saveRecord() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        title: $('#title').val(),
        details: $('#details').val(),
        date: $('#date').val(),
        amount: $('#amount').val()
    };

    if(record.id === null) {
        $.post('/expense/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#expenseModal').modal('hide');
        });
    }
    else {
        $.post('/expense/update/'+record.id, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#expenseModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
}

function edit(id) {
    $.get(`/expense/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            $(`#${i}`).val(v);
        });
        $('#expenseModal').modal('show');
    });
}

function destroy(id, item){
    module = item;

    record.id = id;
    record.action = 'delete';

    $('#deleteModal').modal('show');
}

function yesDelete() {
    $.get(`/expense/destroy/${record.id}`, function() {
        $('#table').bootstrapTable('refresh');
        $('#deleteModal').modal('hide');
    });
}


var formatter = {
    action(v, r, i) {
        return `<a href="#" onclick="edit(${r.id})"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    },
}