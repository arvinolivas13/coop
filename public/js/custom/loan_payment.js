var record = {
    id: null,
    action: 'save'
};

var filterParams = {};

function queryParams(params) {
    params.date_from = $('#date_from').val() || '';
    params.date_to = $('#date_to').val() || '';
    return params;
}

function filterByDate() {
    $('#table').bootstrapTable('refresh', { url: '/loan-payment/get' });
}

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
                $('.member-acc-number-display').text(v.acc_no!==null?formatNumber(v.acc_no):'-');
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
        return r.member.acc_no !== null?formatNumber(r.member.acc_no):'-';
    },
    fullname(v, r, i) {
        return `${r.member.firstname} ${r.member.middlename} ${r.member.lastname}`;
    },
    date(v, r, i) {
        return moment(r.date).format('MMM DD, YYYY');
    },
    principal(v, r, i) {
        var principal = parseFloat(r.schedule.principal_amount);
        var amount = parseFloat(r.amount);
        var interest = parseFloat(r.schedule.interest_amount);
        var exceed = (amount - principal) - interest;
        var total = (exceed + principal);
        console.log(principal, amount, exceed, total);
        return currency(total);
    },
    interest(v, r, i) {
        return currency(r.schedule.interest_amount);
    },
    amount(v, r, i) {
        return currency(r.amount);
    },
    received_by(v, r, i) {
        return `${r.user.name}`;
    }
}

function exportToExcel() {
    var $table = $('#table');
    var opts = $table.bootstrapTable('getOptions');

    function buildAndDownload(data) {
        if(!data || !data.length) {
            alert('No data to export');
            return;
        }

        var rows = [];
        var headers = ['Account Number','Full Name','Date','Principal','Interest','Penalty','Amount','Received By'];
        rows.push(headers);

        data.forEach(function(r) {
        var acc = r.member && r.member.acc_no !== null ? formatNumber(r.member.acc_no) : '-';
        var fullname = `${r.member? r.member.firstname || '': ''} ${r.member? r.member.middlename || '': ''} ${r.member? r.member.lastname || '': ''}`.replace(/\s+/g,' ').trim();
        var date = r.date ? moment(r.date).format('MMM DD, YYYY') : '';

        var principal = '';
        try {
            var p = parseFloat(r.schedule.principal_amount || 0);
            var amount = parseFloat(r.amount || 0);
            var interest = parseFloat(r.schedule.interest_amount || 0);
            var exceed = (amount - p) - interest;
            var total = (exceed + p);
            principal = currency(total);
        } catch(e) {
            principal = '';
        }

        var interest = r.schedule? currency(r.schedule.interest_amount || 0) : '';
        var penalty = r.penalty ? currency(r.penalty) : '';
        var amount = r.amount ? currency(r.amount) : '';
        var received_by = r.user? r.user.name : '';

        rows.push([acc, fullname, date, principal, interest, penalty, amount, received_by]);
    });
        // Convert to CSV
        var csvContent = '\uFEFF' + rows.map(function(row){
            return row.map(function(cell){
                if(cell === null || cell === undefined) return '';
                var out = String(cell).replace(/"/g,'""');
                return '"' + out + '"';
            }).join(',');
        }).join('\n');

        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        var filename = 'loan_payments_' + moment().format('YYYYMMDD_HHmmss') + '.csv';

        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(blob, filename);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) { // feature detection
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    }

    // If table is server-side paginated, request all data from the server using the table's url and queryParams
    if(opts && opts.sidePagination === 'server' && opts.url) {
        var url = opts.url;
        var qparams = { limit: 1000000, offset: 0 };
        
        // Add date filters
        var dateFrom = $('#date_from').val();
        var dateTo = $('#date_to').val();
        if(dateFrom) qparams.date_from = dateFrom;
        if(dateTo) qparams.date_to = dateTo;
        
        if(typeof opts.queryParams === 'function') {
            try {
                qparams = opts.queryParams(qparams);
            } catch(e) {
                // qparams already set above
            }
        }

        // attempt GET (some endpoints expect POST; adjust if needed)
        $.get(url, qparams).done(function(response){
            var rows = [];
            if(response && Array.isArray(response)) rows = response;
            else if(response && (response.rows || response.data)) rows = response.rows || response.data;
            else if(response && response.data && response.data.rows) rows = response.data.rows;

            buildAndDownload(rows);
        }).fail(function() {
            alert('Failed to fetch full data for export.');
        });
    } else {
        var data = $table.bootstrapTable('getData');
        buildAndDownload(data);
    }
}

// expose globally so buttons can call it: <button onclick="exportToExcel()">Export</button>
window.exportToExcel = exportToExcel;

function exportAllToExcel() {
    var $table = $('#table');
    var opts = $table.bootstrapTable('getOptions');

    function buildAndDownload(data) {
        if(!data || !data.length) {
            alert('No data to export');
            return;
        }

        var rows = [];
        var headers = ['Account Number','Full Name','Date','Principal','Interest','Penalty','Amount','Received By'];
        rows.push(headers);

        data.forEach(function(r) {
            var acc = r.member && r.member.acc_no !== null ? formatNumber(r.member.acc_no) : '-';
            var fullname = `${r.member? r.member.firstname || '': ''} ${r.member? r.member.middlename || '': ''} ${r.member? r.member.lastname || '': ''}`.replace(/\s+/g,' ').trim();
            var date = r.date ? moment(r.date).format('MMM DD, YYYY') : '';

            var principal = '';
            try {
                var p = parseFloat(r.schedule.principal_amount || 0);
                var amount = parseFloat(r.amount || 0);
                var interest = parseFloat(r.schedule.interest_amount || 0);
                var exceed = (amount - p) - interest;
                var total = (exceed + p);
                principal = currency(total);
            } catch(e) {
                principal = '';
            }

            var interest = r.schedule? currency(r.schedule.interest_amount || 0) : '';
            var penalty = r.penalty ? currency(r.penalty) : '';
            var amount = r.amount ? currency(r.amount) : '';
            var received_by = r.user? r.user.name : '';

            rows.push([acc, fullname, date, principal, interest, penalty, amount, received_by]);
        });
        // Convert to CSV
        var csvContent = '\uFEFF' + rows.map(function(row){
            return row.map(function(cell){
                if(cell === null || cell === undefined) return '';
                var out = String(cell).replace(/"/g,'""');
                return '"' + out + '"';
            }).join(',');
        }).join('\n');

        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        var filename = 'loan_payments_all_' + moment().format('YYYYMMDD_HHmmss') + '.csv';

        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(blob, filename);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) { // feature detection
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    }

    // Export ALL records without date filters
    if(opts && opts.sidePagination === 'server' && opts.url) {
        var url = opts.url;
        var qparams = { limit: 1000000, offset: 0 };
        
        // Do NOT add date filters for export all
        if(typeof opts.queryParams === 'function') {
            try {
                qparams = opts.queryParams(qparams);
            } catch(e) {
                // qparams already set above
            }
        }

        $.get(url, qparams).done(function(response){
            var rows = [];
            if(response && Array.isArray(response)) rows = response;
            else if(response && (response.rows || response.data)) rows = response.rows || response.data;
            else if(response && response.data && response.data.rows) rows = response.data.rows;

            buildAndDownload(rows);
        }).fail(function() {
            alert('Failed to fetch full data for export.');
        });
    } else {
        var data = $table.bootstrapTable('getData');
        buildAndDownload(data);
    }
}

window.exportAllToExcel = exportAllToExcel;