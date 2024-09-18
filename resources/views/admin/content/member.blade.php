@extends('admin.main.index')

@section('content')

<div class="data-table-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Members</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#memberModal" onclick="create()">ADD MEMBER</button>
                            </div>
                            <table id="table" data-toggle="table" data-url="/member/get" data-pagination="true" data-search="true" data-side-pagination="server" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                <thead>
                                    <tr>
                                        <th data-field="action" data-formatter="formatter.action">Action</th>
                                        <th data-field="account_number" data-formatter="formatter.account_number">#</th>
                                        <th data-field="fullname" data-formatter="formatter.fullname">Full Name</th>
                                        {{-- <th data-field="email_address">Email</th> --}}
                                        <th data-field="mobile_no">Mobile Number</th>
                                        {{-- <th data-field="address">Address</th> --}}
                                        <th data-field="birthdate" data-formatter="formatter.birthdate">Birthday</th>
                                        <th data-field="gender" data-formatter="formatter.gender">Gender</th>
                                        <th data-field="benefeciaries" data-formatter="formatter.beneficiary">Beneficiary</th>
                                        <th data-field="capital" data-formatter="formatter.share_capital">Capital</th>
                                        <th data-field="savings" data-formatter="formatter.savings">Savings</th>
                                        <th data-field="fund" data-formatter="formatter.total_fund">Total Funds</th>
                                        <th data-field="status" data-formatter="formatter.status">Status</th>
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

<div id="memberModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Application Form</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">Kindly provide the following details.</div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Lastname:</label>
                            <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Firstname:</label>
                            <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Middlename:</label>
                            <input type="text" class="form-control form-control-sm" id="middlename" name="middlename" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nickname:</label>
                            <input type="text" class="form-control form-control-sm" id="nickname" name="nickname" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group required">
                            <label>Address:</label>
                            <input type="text" class="form-control form-control-sm" id="address" name="address" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Religion:</label>
                            <input type="text" class="form-control form-control-sm" id="religion" name="religion" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Birthdate:</label>
                            <input type="date" class="form-control form-control-sm" id="birthdate" name="birthdate"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Birth Place:</label>
                            <input type="text" class="form-control form-control-sm" id="birthplace" name="birthplace" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Gender:</label>
                            <select name="gender" id="gender" class="form-control form-control-sm">
                                <option value="male">MALE</option>
                                <option value="female">FEMALE</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Mobile Number:</label>
                            <input type="text" class="form-control form-control-sm" id="mobile_no" name="mobile_no"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Email:</label>
                            <input type="email" class="form-control form-control-sm" id="email_address" name="email_address"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Occupation:</label>
                            <input type="text" class="form-control form-control-sm" id="occupation" name="occupation" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Civil Status:</label>
                            <select name="civil_status" id="civil_status" class="form-control form-control-sm" onchange="selectCivil()">
                                <option value="single">SINGLE</option>
                                <option value="married">MARRIED</option>
                                <option value="divorced">DIVORCED</option>
                                <option value="widowed">WIDOWED</option>
                                <option value="separated">SEPARATED</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Spouse:</label>
                            <input type="text" class="form-control form-control-sm" id="spouse" name="spouse" oninput="this.value = this.value.toUpperCase()" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Spouse Occupation:</label>
                            <input type="text" class="form-control form-control-sm" id="spouse_occupation" name="spouse_occupation" oninput="this.value = this.value.toUpperCase()" disabled/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>No. of Children:</label>
                            <input type="number" class="form-control form-control-sm" id="no_children" name="no_children" min="0" value="0"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Mothers Maiden Name:</label>
                            <input type="text" class="form-control form-control-sm" id="mothers_name" name="mothers_name" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Fathers Name:</label>
                            <input type="text" class="form-control form-control-sm" id="fathers_name" name="fathers_name" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group required">
                            <label>Company/ Employer:</label>
                            <input type="text" class="form-control form-control-sm" id="company" name="company" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Company/ Employer's Phone Number:</label>
                            <input type="text" class="form-control form-control-sm" id="company_phone_no" name="company_phone_no"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Company Address:</label>
                            <input type="text" class="form-control form-control-sm" id="company_address" name="company_address" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Source of Income:</label>
                            <input type="text" class="form-control form-control-sm" id="source_of_income" name="source_of_income" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Monthly Income:</label>
                            <input type="number" class="form-control form-control-sm" id="monthly_income" name="monthly_income"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Educational Attainment:</label>
                            <select name="educational_attainment" id="educational_attainment" class="form-control form-control-sm">
                                <option value="elementary">ELEMENTARY</option>
                                <option value="highschool">HIGHSCHOOL</option>
                                <option value="college">COLLEGE</option>
                                <option value="masters">MASTERS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                        <h5>Beneficiary</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Name:</label>
                            <input type="text" class="form-control form-control-sm" id="beneficiary_name" name="beneficiary_name" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group required">
                            <label>Age:</label>
                            <input type="number" class="form-control form-control-sm" id="beneficiary_age" name="beneficiary_age"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group required">
                            <label>Relationship:</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" id="relationship" name="relationship" oninput="this.value = this.value.toUpperCase()"/>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-secondary btn-block" onclick="addBeneficiary()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="existing_beneficiary"></div>
                    <div class="col-md-12" id="beneficiary_list"></div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Contact Person:</label>
                            <input type="text" class="form-control form-control-sm" id="contact_person" name="contact_person" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Contact Person Phone Number:</label>
                            <input type="text" class="form-control form-control-sm" id="contact_person_no" name="contact_person_no" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Contact Person Address:</label>
                            <input type="text" class="form-control form-control-sm" id="contact_person_address" name="contact_person_address" oninput="this.value = this.value.toUpperCase()"/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Status:</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                <option value="regular">REGULAR</option>
                                <option value="srscc">ASSOCIATE MEMBER OF THE SRSCC</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-dismiss="modal" >CANCEL</button>
                <button class="btn btn-primary" onclick="saveRecord()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div id="memberDetailsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Details</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="profile_photo" class="profile_photo">
                            Profile Picture (1x1 photo):
                            <div class="image-view">
                                <div id="" class="image-previewer" data-cropzee="profile_photo" for="profile_photo" style="background:url('/img/profile/default.png');"></div>
                            </div>
                            <input id="profile_photo" type="file" name="" style="display: none;" accept="image/png, image/jpg, image/jpeg">
                        </label>
                    </div>
                    <div class="col-md-9">
                        <label for="signature" class="signature">
                            Signature:
                            <div class="image-view">
                                <div id="" class="image-previewer-2" data-cropzee="signature" for="signature"></div>
                            </div>
                            <input id="signature" type="file" name="" style="display: none;" accept="image/png, image/jpg, image/jpeg">
                        </label>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="resolution_no">
                            Resolution No.:
                        </label>
                        <input type="text" class="form-control form-control-sm" id="resolution_no" name="resolution_no"/>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="resolution_date">
                            Date:
                        </label>
                        <input type="date" class="form-control form-control-sm" id="resolution_date" name="resolution_date"/>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="member_fee">
                            Type
                        </label>
                        <select name="member_fee" id="member_fee" class="form-control form-control-sm" onchange="memberType()">
                            <option value="1">Member</option>
                            <option value="0">Incorporator</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-2 membership">
                        <label for="membership">
                            Membership fee
                        </label>
                        <input type="number" class="form-control form-control-sm" id="member_amount" name="member_amount" value="200.00" disabled/>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="resolution_no">
                            OR No.:
                        </label>
                        <input type="text" class="form-control form-control-sm" id="or_no" name="or_no"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveDetails()">SAVE & APPROVE</button>
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
                    <div style="padding:15px 20px;font-family:system-ui;width: 8in;height: 11.7in;">
                        <table style="width:100%;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/img/logo/logo.png" style="width:1.2in;height:1.2in;"/>
                                    </td>
                                    <td style="text-align:center;">
                                        <h3 style="font-size: 15pt;font-weight: bold !important;padding: 0 15px;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;">APLIKASYON UPANG MAGING KASAPI</h5>
                                    </td>
                                    <td>
                                        <div class="photo" style="width:1.2in;height:1.2in;border:1px solid #000;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="display:flex;">
                                            <div style="font-weight:bold;">PANGALAN</div>
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">APELYIDO</label>
                                                <div class="p_lastname" style="font-weight: normal !important;"></div>
                                            </div>
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">PANGALAN</label>
                                                <div class="p_firstname" style="font-weight: normal !important;"></div>
                                            </div>
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">GITNANG APELYIDO</label>
                                                <div class="p_middlename" style="font-weight: normal !important;"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PALAYAW</div>
                                        <div class="p_nickname" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TIRAHAN</div>
                                        <div class="p_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">RELIHIYON</div>
                                        <div class="p_religion" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PETSA NG KAPANGANAKAN</div>
                                        <div class="p_birthdate" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">LUGAR NG KAPANGANAKAN</div>
                                        <div class="p_birthplace" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="1" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">KASARIAN</div>
                                        <div class="p_gender" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">MOBILE NUMBER</div>
                                        <div class="p_mobile_no" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">EMAIL ADDRESS</div>
                                        <div class="p_email_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">HANAPBUHAY</div>
                                        <div class="p_occupation" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">ESTADO-SIBIL</div>
                                        <div class="p_civil_status" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PANGALAN NG ASAWA</div>
                                        <div class="p_spouse" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PANGALAN NG INA(SA PAGKADALAGA)</div>
                                        <div class="p_mothers_name" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">PANGALAN NG AMA</div>
                                        <div class="p_fathers_name" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">KUMPANYA / EMPLOYER</div>
                                        <div class="p_company" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO SA TRABAHO</div>
                                        <div class="p_company_phone_no" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">ADRES NG OPISINA O LUGAR NG HANAPBUHAY</div>
                                        <div class="p_company_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">SOURCE OF INCOME</div>
                                        <div class="p_source_of_income" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="1" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BUWANANG KITA</div>
                                        <div class="p_monthly_income" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">ANTAS NG PINAG ARALAN (EDUCATIONAL ATTAINMENT)</div>
                                        <div class="p_educational_attainment" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">BENEPISYARYO</div>
                                        <div style="display:flex;">
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">PANGALAN</label>
                                            </div>
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">EDAD</label>
                                            </div>
                                            <div style="width:100%;text-align:center;">
                                                <label style="font-weight:normal;font-style:italic;font-size:10pt;">RELASYON</label>
                                            </div>
                                        </div>
                                        <div id="print_beneficiary"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">SA PANAHON NG EMERGENCY, KONTAKIN SI:</div>
                                        <div class="p_contact_person" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                    <td colspan="2" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TELEPONO</div>
                                        <div class="p_contact_person_no" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="padding:5px 10px;border:1px solid #000;vertical-align: top;">
                                        <div style="font-weight:bold;">TIRAHAN</div>
                                        <div class="p_contact_person_address" style="font-weight: normal !important;text-align:center;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table style="width: 100%;text-transform:uppercase;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td style="text-transform: none;text-indent: 50px;font-size: 11pt;color: #000;">
                                        Ako, ang aplikanteng may detalye sa itaas ng pahinang ito, ay nabigyan ng oryentasyon ukol sa mga hangarin ng San Roque Savings and Credit Cooperative (SRSCC) at sa mga tungkulin ng bawat kasapi nito. <br> Naniniwala ako sa mabuting idudulot ng pakikiisa sa nasabing  kooperatiba kaya't ngayo'y ninanais kong maging <br>
                                        [ <span class="p_regular"></span> ] Regular    [ <span class="p_associate"></span> ] Associate na kasapin ng SRSCC.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="padding:15px 20px;font-family:system-ui;width: 8in;">
                        <table style="width: 100%;text-transform:normal;margin-bottom:20px;border-spacing: 0px;">
                            <tbody>
                                <tr>
                                    <td style="text-transform: none;font-size: 11pt;color: #000;" colspan="2">
                                        Lubos kong auunawaan at ako ay pumapayag sa mga sumusunod na kondisyon:
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <ol type="1">
                                            <li style="margin-bottom: 15px;">
                                                Na ako’y susunod sa mga isinasaad ng Articles of Cooperation at By-Laws ng SRSCC gayundin sa mga tuntuning itatakda ng General Assembly, Board Members, at mga awtorisadong opisyal ng kooperatiba. Sa anumang paglabag na aking gagawin ay may opsyon ang SRSCC na ako’y patawan ng kaukulang multa at/o suspension, o kaya nama’y tiwalay ako sa kooperatiba na kung saan ang aking shareholdings ay gagamiting pambayad sa aking mga pagkakautang sa kooperatiba kung mayroon man.
                                            </li>
                                            <li style="margin-bottom: 15px;">
                                                Na ako’y magbabayad ng membership fee ba Php200.
                                            </li>
                                            <li style="margin-bottom: 15px;">
                                                <div style="margin-bottom: 15px;">Na ako’y makikiisa sa programang pag iimpok ng SRSCC sa pamamgitang ng:</div>
                                                <ol type="A">
                                                    <li style="margin-bottom: 15px;">Pagsu-subscribe ng hindi kukulangin isandaan sa shares na nagkakahalaga ng isandaang piso bawat share.</li>
                                                    <li style="margin-bottom: 15px;">Pagpapanatili ng aktibong savings account sa SRSCC na may balanseng hindi bababa sa Php1000</li>
                                                </ol>
                                            </li>
                                            <li style="margin-bottom: 15px;">
                                                (Sa mga regular na kasapi) Na ako’y dadlo sa lahat ng mga pagpupulong at seminar para sa mga regular na kasapi.
                                            </li>
                                            <li style="margin-bottom: 15px;">
                                                Na ako’y makikiisa sa mga aktibidad ng SRSCC upang mapalago ang kakayahan ng mga kasapi at maisulong ang kapakinabangan ng aming komunidad.
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        Pinatitibayan ko na lahat ng impormasyong nakalahad sa aplikasyong ito ay tama at ito ay aking isinusumite ayon sa aking sariling kagustuhan.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"></td>
                                    <td style="text-transform: none;font-size: 11pt;color: #000;padding: 20px 0px;width:50%;text-align:right;">
                                        <div style="display:inline-block;border-top:1px solid #000;margin-top: 20px;">Lagda sa ibabaw ng pangalan ng aplikante</div><br>
                                        <div style="margin-top: 10px;">Petsa: _______________</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border-top: 1px dashed #000;">
                                        <div style="padding:10px;text-align:center;font-weight:bold;">FOR OFFICE USE ONLY</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div>[ ] 2pcs 1x1 photo</div>
                                        <div>[ ] Photocopy of Valid ID</div>
                                        <div>[ ] Membership Fee ( OR No. _______________)</div>
                                        <div>[ ] Share Capital: __________ shares (OR No. ______________)</div>
                                        <div>[ ] Approved by the Board of Directors: Resolution No: __________ Date: __________</div>
                                        <div>[ ] Membership No: ___________</div>
                                        <div>[ ] Type of Membership</div>
                                        <div style="text-indent:50px;">[ ] Regular</div>
                                        <div style="text-indent:50px;">[ ] Associate</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="printFile('printable_area')">PRINT</button>
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
                    <div class="col-md-3">
                        <div class="form-group required">
                            <label>Account Number:</label>
                            <input type="text" class="form-control form-control-sm" id="account_number" name="account_number" disabled/>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group required">
                            <label>Name:</label>
                            <input type="text" class="form-control form-control-sm" id="account_name" name="account_name" disabled/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Income Type:</label>
                            <select name="income_type" id="income_type" class="form-control form-control-sm">
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
                            <input type="number" class="form-control form-control-sm" id="income_amount" name="income_amount"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Payment Frequency:</label>
                            <select name="payment_frequency" id="payment_frequency" class="form-control form-control-sm">
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
                            <input type="number" class="form-control form-control-sm" id="no_of_payment" name="no_of_payment"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Requested Loan Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="loan_amount" name="loan_amount" value="0"/>
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
                    <div class="col-md-12">
                        <label>Co-maker:</label>
                        <div class="input-group" onclick="showMember()">
                            <span class="input-group-addon acc-number-display" id="addon-wrapping">000</span>
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

<div id="capitalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Share Capital</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div id="print_capital">
                    <div class="header-print">
                        <table style="width:100%;margin-bottom:20px;border-spacing: 0px;font-family:system-ui;">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/img/logo/logo.png" style="width:1.2in;height:1.2in;"/>
                                    </td>
                                    <td style="text-align:center;">
                                        <h3 style="font-size: 14pt;font-weight: bold !important;padding: 0 15px;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;">SHARE CAPITAL</h5>
                                    </td>
                                    <td>
                                        <div style="width:1.2in;height:1.2in;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3 text-right" style="font-family:system-ui;text-align:right;font-size: 12px;"><b>Account Number: </b> <span id="cap_account_no" style="font-size: 20px;font-weight: bold;">-</span></div>
                    <div class="row" style="font-family:system-ui;">
                        <div class="col-md-12">
                            <div style="font-size:12px;"><b>Name: </b> <span id="cap_name">-</span></div>
                            <div style="font-size:12px;"><b>Contact Number: </b> <span id="cap_contact">-</span></div>
                            <div style="font-size:12px;"><b>Address: </b> <span id="cap_address">-</span></div>
                            <div style="font-size:12px;"><b>Email Address: </b> <span id="cap_email">-</span></div>
                            <div style="font-size:12px;"><b>Birthday: </b> <span id="cap_birthday">-</span></div>
                        </div>
                        <div class="col-md-12 body-print">
                            <table style="width:100%;margin-top:20px;border-spacing:0px;" id="table_capital">
                                <thead>
                                    <tr>
                                        <th colspan="4" style="border:1px solid #000;font-size:10px;font-weight:bold;padding: 3px 8px !important;text-align:left;">SHARE CAPITAL</th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000;font-size:10px;padding: 3px 8px !important;font-weight:normal;">DATE</th>
                                        <th style="border:1px solid #000;font-size:10px;padding: 3px 8px !important;font-weight:normal;">AMOUNT</th>
                                        <th style="border:1px solid #000;font-size:10px;padding: 3px 8px !important;font-weight:normal;">RECEIPT NUMBER</th>
                                        <th style="border:1px solid #000;font-size:10px;padding: 3px 8px !important;font-weight:normal;">BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <div class="text-right" style="font-size:18px;">
                            <b>Total: </b> <span class="total"></span>
                        </div>
                        <div class="col-md-12">
                            <br/>
                        </div>
                        <table id="capital" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="action" data-formatter="formatter.action_2"></th>
                                    <th data-field="date">Date</th>
                                    <th data-field="receipt_number">Receipt No.</th>
                                    <th data-field="amount" data-formatter="formatter.amount">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" onclick="printFile('print_capital')">PRINT CAPITAL</button>
                <button class="btn btn-primary" onclick="addCapital()">ADD CAPITAL</button>
            </div>
        </div>
    </div>
</div>

<div id="addCapitalModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Share Capital</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">Kindly provide the following details.</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Receipt No.:</label>
                            <input type="text" class="form-control form-control-sm" id="cap_receipt_number" name="cap_receipt_number"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Date:</label>
                            <input type="date" class="form-control form-control-sm" id="cap_date" name="cap_date"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="cap_amount" name="cap_amount" value="0" min="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveCapital()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div id="savingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Savings Deposit</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div id="print_savings">
                    <div class="header-print">
                        <table style="width:100%;margin-bottom:20px;border-spacing: 0px;font-family:system-ui;">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="/img/logo/logo.png" style="width:1.2in;height:1.2in;"/>
                                    </td>
                                    <td style="text-align:center;">
                                        <h3 style="font-size: 14pt;font-weight: bold !important;padding: 0 15px;">SAN ROQUE CREDIT COOPERATIVE</h3>
                                        <h5 style="font-size: 13pt;font-weight: bold !important;padding: 0 15px;">SAVINGS DEPOSIT</h5>
                                    </td>
                                    <td>
                                        <div style="width:1.2in;height:1.2in;"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3 text-right" style="font-family:system-ui;text-align:right;font-size: 12px;"><b>Account Number: </b> <span id="sav_account_no" style="font-size: 20px;font-weight: bold;">-</span></div>
                    <div class="row" style="font-family:system-ui;">
                        <div class="col-md-12">
                            <div style="font-size:12px;"><b>Name: </b> <span id="sav_name">-</span></div>
                            <div style="font-size:12px;"><b>Contact Number: </b> <span id="sav_contact">-</span></div>
                            <div style="font-size:12px;"><b>Address: </b> <span id="sav_address">-</span></div>
                            <div style="font-size:12px;"><b>Email Address: </b> <span id="sav_email">-</span></div>
                            <div style="font-size:12px;"><b>Birthday: </b> <span id="sav_birthday">-</span></div>
                        </div>
                        <div class="col-md-12 body-print">
                            <table style="width:100%;margin-top:20px;border-spacing:0px;" id="table_savings">
                                <thead>
                                    <tr>
                                        <th colspan="4" style="border:1px solid #000;font-size:10px;font-weight:bold;padding: 3px 8px !important;text-align:left;">SAVINGS DEPOSIT</th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000;font-size:12px;padding: 3px 8px !important;font-weight:normal;text-align:left;">DATE</th>
                                        <th style="border:1px solid #000;font-size:12px;padding: 3px 8px !important;font-weight:normal;text-align:left;">AMOUNT</th>
                                        <th style="border:1px solid #000;font-size:12px;padding: 3px 8px !important;font-weight:normal;text-align:left;">RECEIPT NUMBER</th>
                                        <th style="border:1px solid #000;font-size:12px;padding: 3px 8px !important;font-weight:normal;text-align:left;">BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                    <div class="col-md-12">
                        <div class="text-right" style="font-size:18px;">
                            <b>Total: </b> <span class="sav_total"></span>
                        </div>
                        <div class="col-md-12">
                            <br/>
                        </div>
                        <table id="savings" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="action" data-formatter="formatter.action_3"></th>
                                    <th data-field="date">Date</th>
                                    <th data-field="receipt_number">Receipt No.</th>
                                    <th data-field="amount" data-formatter="formatter.amount">Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" onclick="printFile('print_savings')">PRINT SAVINGS</button>
                <button class="btn btn-primary" onclick="addSavings()">ADD SAVINGS</button>
            </div>
        </div>
    </div>
</div>

<div id="addSavingsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5>Savings Deposit</h5>
            </div>
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="mb-3">Kindly provide the following details.</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            <label>Receipt No.:</label>
                            <input type="text" class="form-control form-control-sm" id="sav_receipt_number" name="sav_receipt_number"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Date:</label>
                            <input type="date" class="form-control form-control-sm" id="sav_date" name="sav_date"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group required">
                            <label>Amount:</label>
                            <input type="number" class="form-control form-control-sm" id="sav_amount" name="sav_amount" value="0" min="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveSavings()">SAVE</button>
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
                                    <th data-field="fullname" data-formatter="formatter.fullname">Name</th>
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
<link rel="stylesheet" href="/css/custom/member.css">
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
<script src="/js/plugins/cropzee.js"></script>

<script src="/js/custom/member.js"></script>
@endsection