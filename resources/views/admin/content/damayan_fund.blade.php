@extends('admin.main.index')

@section('page-screen')
Damayan Fund
@endsection

@section('content')

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#memberModal" onclick="create()">ADD FUND</button>
                                <a href="/damayan_expense"  class="btn btn-sm btn-primary">ADD EXPENSE</a>
                            </div>
                            <table id="table" data-toggle="table" data-url="/damayan_fund/get" data-pagination="true" data-search="true" data-side-pagination="server" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="action" data-formatter="formatter.action"></th>
                                        <th data-field="name" data-formatter="formatter.fullname">Fullname</th>
                                        <th data-field="date">Date</th>
                                        <th data-field="amount">Amount</th>
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

<div id="damayanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-m">
            <div class="modal-header">
                <h5>Add Fund</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Member:</label>
                        <div class="input-group" onclick="showMember('member')">
                            <span class="input-group-addon member-acc-number-display" id="addon-wrapping">000</span>
                            <input type="text" class="form-control" style="cursor:pointer !important;" placeholder="Member" aria-label="Member" aria-describedby="addon-wrapping" name="member" id="member" readonly>
                            <input type="hidden" class="form-control" name="member_id" id="member_id" readonly>
                            <span class="input-group-addon" style="cursor:pointer;" id="addon-wrapping"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="amount" name="amount"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Date:</label>
                            <input type="date" class="form-control form-control-sm" id="date" name="date"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveRecord()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h5>Damayan Fund</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">Are you sure you want to delete this record ?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal" >NO</button>
                <button class="btn btn-primary" onclick="yesDelete()">YES</button>
            </div>
        </div>
    </div>
</div>

<div id="selectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-m">
            <div class="modal-header">
                <h5>Member List</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="member_list" data-toggle="table" data-search="true" data-pagination="true">
                            <thead>
                                <tr>
                                    <th data-field="account_number" data-formatter="formatter.account_number">Acc. #</th>
                                    <th data-field="fullname" data-formatter="formatter.fullname_member">Name</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal" >CLOSE</button>
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
<script src="/js/custom/damayan_fund.js"></script>
@endsection