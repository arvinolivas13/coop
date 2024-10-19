@extends('admin.main.index')

@section('content')

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>User Account</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#memberModal" onclick="create()">ADD USER</button>
                            </div>
                            <table id="table" data-toggle="table" data-url="/setup/user/get" data-pagination="true" data-search="true" data-side-pagination="server" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="action" data-formatter="formatter.action"></th>
                                        <th data-field="name">Name</th>
                                        <th data-field="email">Email</th>
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

<div id="userModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-m">
            <div class="modal-header">
                <h5>Add Account</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Name:</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name"/>
                        </div>
                        <div class="form-group required">
                            <label>Email:</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"/>
                        </div>
                        <div class="form-group required">
                            <label>Role:</label>
                            <select name="role_id" id="role_id" class="form-control form-control-sm">
                                <option value=""></option>
                                @foreach ($roles as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
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
                <h5>User Account</h5>
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
<script src="/js/custom/user.js"></script>
@endsection