var record = {
    id: null,
    action: 'save'
};

function create() {
    $('.form-control').val('');
    $('#roleModal').modal('show');
}

function saveRecord() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        name: $('#name').val()
    };

    if(record.id === null) {
        $.post('/setup/role/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#roleModal').modal('hide');
        });
    }
    else {
        $.post('/setup/role/update/'+record.id, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#roleModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
}

function edit(id) {
    $.get(`/setup/role/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            $(`#${i}`).val(v);
        });
        $('#roleModal').modal('show');
    });
}

function destroy(id, item){
    module = item;

    record.id = id;
    record.action = 'delete';

    $('#deleteModal').modal('show');
}

function yesDelete() {
    $.get(`/setup/role/destroy/${record.id}`, function() {
        $('#table').bootstrapTable('refresh');
        $('#deleteModal').modal('hide');
    });
}


var formatter = {
    action(v, r, i) {
        return `<a href="#" onclick="edit(${r.id})"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    },
}