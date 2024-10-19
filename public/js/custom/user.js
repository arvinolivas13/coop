var record = {
    id: null,
    action: 'save'
};

function create() {
    $('.form-control').val('');
    $('#userModal').modal('show');
}

function saveRecord() {
    var data = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        name: $('#name').val(),
        email: $('#email').val(),
        role_id: $('#role_id').val(),
    };

    if(record.id === null) {
        $.post('/setup/user/save', data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#userModal').modal('hide');
        });
    }
    else {
        $.post('/setup/user/update/'+record.id, data).done(function(response) {
            $('#table').bootstrapTable('refresh');
            $('#userModal').modal('hide');
        }).fail(function(response) {
            $.each(response.responseJSON.errors, (i,v) => {
                $('#'+i).addClass('error');
            });
        });
    }
}

function edit(id) {
    $.get(`/setup/user/edit/${id}`, function(response) {
        var html = '';

        record.id = response.record.id;
        record.action = 'update';

        $.each(response.record, (i, v) => {
            if(i === "has_role") {
                $(`#role_id`).val(v !== null ? v.role_id:'');
            }
            else {
                $(`#${i}`).val(v);
            }
        });
        $('#userModal').modal('show');
    });
}

function destroy(id, item){
    module = item;

    record.id = id;
    record.action = 'delete';

    $('#deleteModal').modal('show');
}

function yesDelete() {
    $.get(`/setup/user/destroy/${record.id}`, function() {
        $('#table').bootstrapTable('refresh');
        $('#deleteModal').modal('hide');
    });
}


var formatter = {
    action(v, r, i) {
        return `<a href="#" onclick="edit(${r.id})"><i class="fa fa-edit"></i></a> <a href="#" onclick="destroy(${r.id}, 'member')" class="text-danger" title="Delete"><i class="fa fa-trash"></i></a>`;
    },
}