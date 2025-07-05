@extends('admin.main.index')

@section('page-screen')
Loan Request
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
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#memberModal" onclick="create()">ADD REQUEST</button>
                            </div>
                            <table id="table" data-toggle="table" data-url="/loan-request/get" data-pagination="true" data-search="true" data-side-pagination="server" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="action" data-formatter="formatter.action">Action</th>
                                        <th data-field="account_number" data-formatter="formatter.account_no">Acc. #</th>
                                        <th data-field="fullname" data-formatter="formatter.fullname">Full Name</th>
                                        <th data-field="loan_type" data-formatter="formatter.loan_type">Loan Type</th>
                                        <th data-field="loan_date" data-formatter="formatter.loan_date">Date</th>
                                        <th data-field="loan_amount" data-formatter="formatter.loan_amount">Loan Amount</th>
                                        <th data-field="interest" data-formatter="formatter.interest">Interest</th>
                                        <th data-field="terms" data-formatter="formatter.terms">Term</th>
                                        <th data-field="comaker" data-formatter="formatter.comaker">Co-Maker</th>
                                        <th data-field="status" data-formatter="formatter.status">
                                            
                                        </th>
                                        <th data-field="approve" class="approve-tbl" data-formatter="formatter.approve"></th>
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

<div id="printModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-xl">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div id="printable_area">
                    <div style="padding:15px;font-family:system-ui;">
                        <table style="width:100%;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/img/logo/logo.png" style="width:1.2in;height:1.2in;"/>
                                    </td>
                                    <td style="text-align:center;">
                                        <h3 style="font-size: 18pt;font-weight: bold !important;padding: 0 15px;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;">KAHILINGAN SA PAG-UTANG</h5>
                                    </td>
                                    <td>
                                        <div style="width:1.2in;height:1.2in;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;font-size: 8pt;">
                            <tbody>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;text-align:center;">PANGUNAHING UMUUTANG (PRINCIPAL BORROWER)</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BUONG PANGALAN</div>
                                        <div class="p_fullname" style="font-weight: normal !important;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">ACCOUNT NUMBER</div>
                                        <div class="p_account_number" style="font-weight: bold !important;text-align:center;color:green;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TIRAHAN</div>
                                        <div class="p_address" style="font-weight: normal !important;text-align:left;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO SA BAHAY</div>
                                        <div class="p_h_phone" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO SA TRABAHO</div>
                                        <div class="p_o_phone" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">MOBILE PHONE</div>
                                        <div class="p_mobile" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">HANAPBUHAY</div>
                                        <div class="p_occupation" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">LUGAR NG HANAPBUHAY</div>
                                        <div class="p_company_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PANGALAN NG ASAWA</div>
                                        <div class="p_spouse" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">HANAPUHAY NG ASAWA</div>
                                        <div class="p_spouse_occupation" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BILANG NG ANAK</div>
                                        <div class="p_no_children" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top; width:50%;">
                                        <div style="font-weight:bold;">MALINIS NA KINIKITA</div>
                                        <div style="display:flex;">
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_daily" style="font-weight:bold;"></span> ] araw
                                            </div>
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_weekly" style="font-weight:bold;"></span> ] linggo
                                            </div>
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_monthly" style="font-weight:bold;"></span> ] buwan
                                            </div>
                                            <div style="text-align:right; font-weight:bold;width:100%;">
                                                <span class="p_income"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="3" rowspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align:top;width:50%;">
                                        <div style="font-weight:bold;">PAGGAGAMITAN NG HINIRAM NA HALAGA</div>
                                        <div class="purpose-list" style="min-height: 50px;"></div>
                                        <div style="font-weight:bold;">KABUUANG HINIRAM <span class="p_loan_amount"></span></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;width:50%;">
                                        <div style="font-weight:bold;">PAGBABAYAD NG UTANG</div>
                                        <div style="display:flex;width:100%;">
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_f_daily" style="font-weight:bold;"></span> ] ARAWAN 
                                            </div>
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_f_weekly" style="font-weight:bold;"></span> ] LINGGUHAN 
                                            </div>
                                            <div style="text-align:left;padding-right:10px;width:100%;">
                                                [ <span class="p_f_semi_monthly" style="font-weight:bold;"></span> ] KINSENAS 
                                            </div>
                                            <div style="text-align:left;width:100%;">
                                                [ <span class="p_f_monthly" style="font-weight:bold;"></span> ] BUWANAN 
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">MGA TAONG MAKAPAGBIBIGAY IMPORMASYON SA IYONG KREDITO:</div>
                                        <div style="display:flex;width:100%;">
                                            <div style="width:100%;text-align:left;padding-right:10px;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">REFERENCE 1:</label>
                                                <div>Pangalan <span class="p_reference_1" style="font-weight:bold;"></span></div>
                                                <div>Telepono <span class="p_reference_no_1" style="font-weight:bold;"></span></div>
                                                <div>Kaugnayan <span class="p_reference_relationship_1" style="font-weight:bold;"></span></div>
                                            </div>
                                            <div style="width:100%;text-align:left;padding-right:10px;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">REFERENCE 2:</label>
                                                <div>Pangalan <span class="p_reference_2" style="font-weight:bold;"></span></div>
                                                <div>Telepono <span class="p_reference_no_2" style="font-weight:bold;"></span></div>
                                                <div>Kaugnayan <span class="p_reference_relationship_2" style="font-weight:bold;"></span></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;font-size: 8pt;">
                            <tbody>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;text-align:center;">KAAKO (CO-MAKER)</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BUONG PANGALAN</div>
                                        <div class="c_fullname" style="font-weight: normal !important;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">ACCOUNT NUMBER</div>
                                        <div class="c_account_number" style="font-weight: bold !important;text-align:center;color:green;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TIRAHAN</div>
                                        <div class="c_address" style="font-weight: normal !important;text-align:left;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO SA BAHAY</div>
                                        <div class="c_h_phone" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO SA TRABAHO</div>
                                        <div class="c_o_phone" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">MOBILE PHONE</div>
                                        <div class="c_mobile" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">HANAPBUHAY</div>
                                        <div class="c_occupation" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">LUGAR NG HANAPBUHAY</div>
                                        <div class="c_company_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PANGALAN NG ASAWA</div>
                                        <div class="c_spouse" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">HANAPUHAY NG ASAWA</div>
                                        <div class="c_spouse_occupation" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BILANG NG ANAK</div>
                                        <div class="c_no_children" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td style="text-transform: none;text-indent: 50px;font-size: 11pt;color: #000;">
                                        KAMI, ang pangunahing umuutang at ka-ako, ay nagnanais na humiram ng halagang nabanggit sa itaas. Pinatutunayan namin na ang lahat ng nakasaad sa kahilingang ito ay tama. Pinahihintulutan namin ang SRSCC na magtanong sa bangko at iba pang kreditor ukol sa aming kredito. <br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="text-transform: none;font-size: 11pt;color: #000;padding-top: 20px;">
                                        <div style="display:inline-block;border-top:1px solid #000;margin-top: 20px;">Pangalan at Lagda ng Umuutang</div><br>
                                        <div style="margin-top: 10px;">Petsa: </div>
                                    </td>
                                    <td colspan="2" style="text-transform: none;font-size: 11pt;color: #000;padding-top: 20px;">
                                        <div style="display:inline-block;border-top:1px solid #000;margin-top: 20px;">Pangalan at Lagda ng Ka-ako</div><br>
                                        <div style="margin-top: 10px;">Petsa: </div>
                                    </td>
                                    <td colspan="2" style="text-transform: none;font-size: 11pt;color: #000;padding-top: 20px;">
                                        <div style="display:inline-block;border-top:1px solid #000;margin-top: 20px;">BOD Signature</div><br>
                                        <div style="margin-top: 10px;">Petsa: </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="printFile()">PRINT</button>
            </div>
        </div>
    </div>
</div>

<div id="loanApplicationModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Loan Request</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">Kindly provide the following details.</div>
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
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Loan Type:</label>
                            <select name="loan_type_id" id="loan_type_id" class="form-control form-control-sm" onchange="getRate()">
                                <option value=""></option>
                                @foreach ($loan_type as $item)
                                    <option value="{{$item->id}}">{{$item->name}} ({{$item->rate}}%)</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="loan_type_rate" value="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Income Type:</label>
                            <select name="income_type" id="income_type" class="form-control form-control-sm" disabled>
                                <option value=""></option>
                                <option value="daily">DAILY</option>
                                <option value="weekly">WEEKLY</option>
                                <option value="monthly">MONTHLY</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Income Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="income_amount" name="income_amount" disabled/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Payment Frequency:</label>
                            <select name="payment_frequency" id="payment_frequency" class="form-control form-control-sm" onchange="selectFrequency()">
                                <option value=""></option>
                                <option value="daily">DAILY</option>
                                <option value="weekly">WEEKLY</option>
                                <option value="semi_monthly">SEMI-MONTHLY</option>
                                <option value="monthly">MONTHLY</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>No. of Payment:</label>
                            <div class="input-group" style="width: 100%;">
                                <input type="number" class="form-control form-control-sm" id="no_of_payment" name="no_of_payment"/>
                                <span class="input-group-addon" style="cursor:pointer;" id="chart_btn" onclick="viewChart()"><i class="fa fa-table"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Requested Loan Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="loan_amount" name="loan_amount" oninput="countwithInterest()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>with interest:</label>
                            <input type="number" class="form-control form-control-sm" id="with_interest" name="with_interest" disabled/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Requested Date:</label>
                            <input type="date" class="form-control form-control-sm" id="loan_date" name="loan_date" value="{{date('Y-m-d')}}"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        Purpose of the borrowed amount
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group required">
                                    <input type="text" class="form-control form-control-sm" style="width:50%;" id="loan_purpose" name="loan_purpose" placeholder="PURPOSE" oninput="this.value = this.value.toUpperCase()"//>
                                    <input type="number" class="form-control form-control-sm" style="width:50%;"  placeholder="AMOUNT" aria-describedby="addon-wrapping" name="purpose_amount" id="purpose_amount">
                                    <span class="input-group-addon" style="cursor:pointer;" id="addon-wrapping" onclick="addPurpose()"><i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div id="purpose_exist"></div>
                        <div id="purpose_list"></div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">People who can provide information about your credit.</div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>REFERENCE 1</label>
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_name_1" name="reference_name_1" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                                <div class="form-group">
                                    <label>Contact #:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_phone_1" name="reference_phone_1" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                                <div class="form-group">
                                    <label>Relationship:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_relationship_1" name="reference_relationship_1" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>REFERENCE 2</label>
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_name_2" name="reference_name_2" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                                <div class="form-group">
                                    <label>Contact #:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_phone_2" name="reference_phone_2" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                                <div class="form-group">
                                    <label>Relationship:</label>
                                    <input type="text" class="form-control form-control-sm" id="reference_relationship_2" name="reference_relationship_2" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Co-maker:</label>
                        <div class="input-group" onclick="showMember('co_maker')">
                            <span class="input-group-addon co_maker-acc-number-display" id="addon-wrapping">000</span>
                            <input type="text" class="form-control" style="cursor:pointer !important;" placeholder="Co-maker" aria-label="Co-maker" aria-describedby="addon-wrapping" name="co_maker" id="co_maker" readonly>
                            <input type="hidden" class="form-control" name="co_maker_id" id="co_maker_id" readonly>
                            <span class="input-group-addon" style="cursor:pointer;" id="addon-wrapping"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveLoanRequest()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h5>Application Form</h5>
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

<div id="approvalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h5>Loan Request</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">Are you sure you want to <span class="status-modal"></span> this Loan Request?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal" >NO</button>
                <button class="btn btn-primary" onclick="yesApprove()">YES</button>
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

<div id="loanScheduleModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-xl">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div id="printable_area_2">
                    <div style="padding:15px;font-family:system-ui;">
                        <table style="width:100%;margin-bottom:10px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td style="width:200px;">
                                        <img src="/img/logo/logo.png" style="width:1in;height:1in;"/>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;">
                                        <h3 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;margin:0px !important;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 10pt;font-weight: bold !important;padding: 0 15px;margin:0px !important;">LOAN DETAILS</h5>
                                    </td>
                                    <td style="vertical-align:bottom;text-align:right;width:200px;">
                                        <div style="font-size:15px;font-weight:bold;">
                                            ACCOUNT NO: <span id="ld_account_no"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="display: flex; border-bottom: dashed 2px #000;padding-bottom:10px;margin-bottom:10px;">
                            <div style="width: 100%;padding:5px 10px;">
                                <table style="width: 100%;border-spacing: 0px;font-size:10px;">
                                    <thead>
                                        <th colspan="2" style="border:1px solid #000;padding:0 5px;width:50%;text-align:left;">
                                            Borrower: <span id="ld_borrower"></span>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Loan Amount Request</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Terms</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_terms"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Interest Rate</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_interest_rate"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Penalty Rate</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_penalty_rate"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Date Availed</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_date"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Date of First Payment</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_first"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Due Date</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_due"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table style="width: 100%;border-spacing: 0px;margin-top:10px; font-size:10px;">
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Loan Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_loan_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Total Interest</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_interest"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold">Total Loan Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_total_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Net Proceeds</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_net_proceeds"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Payment</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_payment"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Penalty Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="ld_penalty"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="margin-top: 10px; font-size: 10px;">
                                    <div>BREAKDOWN:</div>
                                    <div>Net Proceeds: <span id="br_net_proceeds"></span></div>
                                    <div>Less Processing fee: <span id="br_processing_fee"></span></div>
                                    <div style="margin-top: 10px;">Take Home Cash: <span style="font-weight:bold;" id="br_take_home"></span></div>
                                </div>
                            </div>
                            <div style="width: 100%;padding:5px 10px;">
                                <table style="width: 100%;border-spacing: 0px;font-size:10px;">
                                    <thead>
                                        <th colspan="3" style="border:1px solid #000;padding:0 5px;width:50%;text-align:left;">
                                            SCHEDULE OF PAYMENT
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">DATE</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">AMOUNT</td>
                                        </tr>
                                    </tbody>
                                    <tbody id="ld_schedule">
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:5%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:19px;"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" style="padding:5px 5px;border:1px solid #000;text-align:right;font-size: 11px;">Total: <span id="total_payment" style="font-weight: bold;"></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <table style="width:100%;margin-bottom:10px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td style="width: 200px;">
                                        <img src="/img/logo/logo.png" style="width:1in;height:1in;"/>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;">
                                        <h3 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;margin:0px !important;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 10pt;font-weight: bold !important;padding: 0 15px;margin:0px !important;">LOAN PAYMENTS</h5>
                                    </td>
                                    <td style="vertical-align:bottom;text-align:right;width:200px;">
                                        <div style="font-size:15px;font-weight:bold;">
                                            ACCOUNT NO: <span id="lp_account_no"></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div style="display: flex;margin-bottom:10px;">
                            <div style="width: 100%;padding:5px 10px;">
                                <table style="width: 100%;border-spacing: 0px;font-size:10px;">
                                    <thead>
                                        <th colspan="2" style="border:1px solid #000;padding:0 5px;width:50%;text-align:left;">
                                            Borrower: <span id="lp_borrower"></span>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Loan Amount Request</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Terms</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_terms"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Interest Rate</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_interest_rate"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Penalty Rate</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_penalty_rate"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Date Availed</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_date"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Date of First Payment</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_first"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Due Date</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_due"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="width: 100%;padding:5px 10px;">
                                
                                <table style="width: 100%;border-spacing: 0px;font-size:10px;">
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Loan Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_loan_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Total Interest</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_interest"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold">Total Loan Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_total_amount"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;height:16px;" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Net Proceeds</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_net_proceeds"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Payment</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_payment"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;">Penalty Amount</td>
                                            <td style="border:1px solid #000;padding:0 5px;width:50%;font-weight:bold;" id="lp_penalty"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div style="padding:0px 10px;">
                            <table style="width: 100%;border-spacing: 0px;font-size:10px;">
                                <thead>
                                    <th style="border:1px solid #000;padding:0 5px;width:5%;"></th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">DATE</th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">AMOUNT</th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">PENALTY</th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">RECEIVED BY</th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">RECEIPT NO</th>
                                    <th style="border:1px solid #000;padding:0 5px;width:auto;">LOAN BALANCE</th>
                                </thead>
                                <tbody id="lp_payment_table">
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000;padding:0 5px;width:5%;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                        <td style="border:1px solid #000;padding:0 5px;width:auto;height:16px;"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" style="padding:5px 5px;border:1px solid #000;text-align:right;font-size: 11px;">Total: <span id="lp_total_payment" style="font-weight: bold;"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="printSchedule()">PRINT</button>
            </div>
        </div>
    </div>
</div>

<div id="loanPaymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-xl">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <h2>SCHEDULE OF PAYMENT</h2>
                <div class="row">
                    <div class="col-md-8">
                        <h5>ACCOUNT #: <span id="schd_account_no"></span></h5>
                        <h5>NAME: <span id="schd_account_name"></span></h5>
                    </div>
                    
                    <div class="col-md-4 text-right">
                        <button class="btn btn-sm btn-primary" onclick="editSched()">EDIT</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-title">TOTAL LOAN AMOUNT</div>
                            <div class="card-amount" id="schd_loan_amount"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-title">PAYMENT</div>
                            <div class="card-amount" id="schd_payment"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content">
                            <div class="card-title">BALANCE</div>
                            <div class="card-amount" id="schd_balance"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="schedule" data-toggle="table">
                    <thead>
                        <tr>
                            <th data-field="date" data-formatter="formatter.schedule.date">Date</th>
                            <th data-field="payment.receipt_no">Receipt No.</th>
                            <th data-field="amount" data-formatter="formatter.schedule.amount">Amount</th>
                            <th data-field="amount" data-formatter="formatter.schedule.payment">Payment</th>
                            <th data-field="amount" data-formatter="formatter.schedule.penalty">Penalty</th>
                            <th data-field="amount" data-formatter="formatter.schedule.balance">Balance</th>
                            <th data-field="payment_action" data-formatter="formatter.schedule.payment_action"></th>
                        </tr>
                    </thead>
                </table>
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
                            <input type="number" class="form-control form-control-sm" id="payment_amount" name="payment_amount" oninput="checkInterestRate($('#payment_date').val(), $('#schedule_date').val())"/>
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
                            <input type="number" class="form-control form-control-sm" id="penalty" name="penalty" value="0" oninput="checkInterestRate2($('#payment_date').val(), $('#schedule_date').val())"/>
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

<div id="editLoanModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Edit Schedule</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="editable_schedule">
                            <thead>
                                <th>DATE</th>
                                <th>PRINCIPAL <a href="#" onclick="applyAll(1)">Apply All</a></th>
                                <th>INTEREST <a href="#" onclick="applyAll(2)">Apply All</a></th>
                                <th>TOTAL</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveEdit()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div id="viewChartModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h5>Convert</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Month</label>
                        <input type="number" class="form-control" name="convert_month" id="convert_month" oninput="convertMonth()" value="0"/>
                    </div>
                    <div class="col-md-6">
                        <label>Weeks</label>
                        <input type="number" class="form-control" name="convert_week" id="convert_week" value="0" disabled/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal" >Cancel</button>
                <button class="btn btn-primary" onclick="useConvert()">Use</button>
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
<script src="/js/custom/loan_request.js"></script>
@endsection