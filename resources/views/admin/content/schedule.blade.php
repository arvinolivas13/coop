@extends('admin.main.index')

@section('content')

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Loan Schedule</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" data-toggle="table" data-url="/loan-schedule/get" data-pagination="true" data-search="true" data-side-pagination="server" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="account_number" data-formatter="formatter.account_number">Acc. #</th>
                                        <th data-field="fullname" data-formatter="formatter.fullname">Full Name</th>
                                        <th data-field="loan_amount" data-formatter="formatter.amount">Amount</th>
                                        <th data-field="date" data-formatter="formatter.date">Due Date</th>
                                        <th data-field="payment_action" data-formatter="formatter.payment_action"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="payLoanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Pay Loan</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Date:</label>
                            <input type="date" class="form-control form-control-sm" id="payment_date" name="payment_date" onchange="checkInterestRate($('#payment_date').val(), $('#schedule_date').val())"/>
                            <input type="date" class="form-control form-control-sm" id="schedule_date" name="schedule_date" style="display:none;"/> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="payment_amount" name="payment_amount"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Receipt No.:</label>
                            <input type="text" class="form-control form-control-sm" id="receipt_no" name="receipt_no"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Loan Balance:</label>
                            <input type="number" class="form-control form-control-sm" id="loan_balance" name="loan_balance" disabled/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Penalty:</label>
                            <input type="number" class="form-control form-control-sm" id="penalty" name="penalty" value="0"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Total Payment:</label>
                            <input type="number" class="form-control form-control-sm" id="payment_total" name="payment_total" value="0" disabled/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-no-penalty" onclick="pay(0)">PAY WITHOUT PENALTY</button>
                <button class="btn btn-primary btn-penalty" onclick="pay(1)">PAY WITH PENALTY</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<link rel="stylesheet" href="/css/morrisjs/morris.css">
<link rel="stylesheet" href="/css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="/css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="/css/custom/loan_request.css">
@endsection

@section('script')
<script src="/js/data-table/bootstrap-table.js"></script>
<script src="/js/data-table/tableExport.js"></script>
<script src="/js/data-table/data-table-active.js"></script>
<script src="/js/data-table/bootstrap-table-editable.js"></script>
<script src="/js/data-table/bootstrap-editable.js"></script>
<script src="/js/data-table/bootstrap-table-resizable.js"></script>
<script src="/js/data-table/colResizable-1.5.source.js"></script>
<script src="/js/data-table/bootstrap-table-export.js"></script>

<script src="/js/editable/jquery.mockjax.js"></script>
<script src="/js/editable/mock-active.js"></script>
<script src="/js/editable/select2.js"></script>
<script src="/js/editable/moment.min.js"></script>
<script src="/js/editable/bootstrap-datetimepicker.js"></script>
<script src="/js/editable/bootstrap-editable.js"></script>
<script src="/js/custom/loan_schedule.js"></script>
@endsection