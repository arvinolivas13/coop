@extends('admin.main.index')

@section('page-screen')
Dashboard
@endsection

@section('content')
<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 bg-primary">
                    <div class="analytics-content">
                        <h5>Total Fund</h5>
                        <h2>₱ <span class="counter">{{number_format($total_fund, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-success">100%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">100% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Loan</h5>
                        <h2>₱ <span class="counter">{{number_format($loan, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-danger">100%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;"> <span class="sr-only">100% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Payment</h5>
                        <h2>₱ <span class="counter">{{number_format($payment, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-danger">{{number_format($percentage['payment'], 2, '.', ',')}}%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentage['payment']}}%;"> <span class="sr-only">230% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                    <div class="analytics-content">
                        <h5>Receivables</h5>
                        <h2>₱ <span class="counter">{{number_format($receivable, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-inverse">{{number_format($percentage['receivable'], 2, '.', ',')}}%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentage['receivable']}}%;"> <span class="sr-only">230% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Principal Amount</h5>
                        <h2>₱ <span class="counter">{{number_format($principal, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-danger">{{number_format($percentage['principal'], 2, '.', ',')}}%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentage['principal']}}%;"> <span class="sr-only">100% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Interest</h5>
                        <h2>₱ <span class="counter">{{number_format($interest, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-danger">{{number_format($percentage['interest'], 2, '.', ',')}}%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentage['interest']}}%;"> <span class="sr-only">100% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Penalty</h5>
                        <h2>₱ <span class="counter">{{number_format($penalty, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                        <span class="text-danger">{{number_format($percentage['penalty'], 2, '.', ',')}}%</span>
                        <div class="progress m-b-0">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentage['penalty']}}%;"> <span class="sr-only">100% Complete</span> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Principal Amount</h5>
                        <h2>₱ <span class="counter">{{number_format($p_principal, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Interest</h5>
                        <h2>₱ <span class="counter">{{number_format($p_interest, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <div class="row">
                            <div class="col-md-6"><img src="/img/logo/DAMAYAN-FUND-LONG.png" alt="DAMAYAN FUND" width="200px"></div>
                            <div class="col-md-6 text-right"><h1>₱ <span class="counter">{{number_format($damayan, 2, '.', ',')}}</span></h1></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10 bg-success"">
                    <div class="analytics-content">
                        <h5>Highest Savings Achievers</h5>
                        <span>year {{date('Y')}}</span>
                        <div class="savers">
                            @if (count($top_loan) === 0)
                                <div class="text-center">No Record</div>
                            @else
                                <ol type="1">
                                @foreach ($top_savings as $item)
                                    <li>
                                        <div class="savers-name">{{$item->fullname}}</div>
                                        <div class="savers-amount">₱ {{number_format($item->total)}}</div>
                                    </li>
                                @endforeach
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10 bg-success"">
                    <div class="analytics-content">
                        <h5>Leading Borrowers</h5>
                        <span>year {{date('Y')}}</span>
                        <div class="savers">
                            @if (count($top_loan) === 0)
                                <div class="text-center">No Record</div>
                            @else
                                <ol type="1">
                                @foreach ($top_loan as $item)
                                    <li>
                                        <div class="savers-name">{{$item->fullname}}</div>
                                        <div class="savers-amount">₱ {{number_format($item->total)}}</div>
                                    </li>
                                @endforeach
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10"">
                    <div class="analytics-content">
                        <h5>Birthday Celebrants</h5>
                        <span>for the month of {{date('F')}}</span>
                        <div class="celebrants">
                            <div class="row">
                                @foreach ($celebrants as $item)
                                <div class="col-lg-4 col-md-4 mb-3">
                                    <div class="celebrants-photo">
                                        @if ($item->details !== null)
                                        <img src="{{$item->details['photo'] !== null && $item->details['photo'] !== ''?"/storage/photo/".$item->details['photo']:"/img/profile/default.png"}}">
                                        @else
                                        <img src="/img/profile/default.png">
                                        @endif
                                    </div>
                                    <div class="celebrants-info">
                                        <span class="c-name">{{$item->firstname." ".$item->lastname}}</span>
                                        <span class="c-date">{{date('M-d', strtotime($item->birthdate))}}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10"">
                    <div class="analytics-content">
                        <h5>Loan Schedule</h5>
                        <span>for the month of {{date('F')}}</span>
                        <div class="schedule-list">
                            @if (count($schedule) !== 0)
                                @foreach ($schedule as $item)
                                <div class="schedule-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <span class="member-name">{{$item->member->firstname." ".$item->member->lastname}}</span>
                                        </div>
                                        <div class="col-md-4 text-right"><span class="member-price">₱ {{number_format($item->amount, 2, '.', ',')}}</span></div>
                                        <div class="col-md-12"><span class="member-date">{{$item->date}}</span></div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="schedule-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        No Records Found
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <a class="btn text-center" style="width:100%;" href="/loan-schedule">View Loan Schedule</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Graph</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10" style="background:rgba(255, 99, 132, 0.2);">
                    <div class="analytics-content">
                        <h5>Share Capital</h5>
                        <h2>₱ <span class="counter">{{number_format($share_capital, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10" style="background:rgba(54, 162, 235, 0.2);">
                    <div class="analytics-content">
                        <h5>Savings</h5>
                        <h2>₱ <span class="counter">{{number_format($savings, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10" style="background:rgba(255, 206, 86, 0.2);">
                    <div class="analytics-content">
                        <h5>Membership Fee</h5>
                        <h2>₱ <span class="counter">{{number_format($membership, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10" style="background:rgba(75, 192, 192, 0.2);">
                    <div class="analytics-content">
                        <h5>Processing Fee</h5>
                        <h2>₱ <span class="counter">{{number_format($processing_fee, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 mg-ub-10" style="background:rgba(153, 102, 255, 0.2);">
                    <div class="analytics-content">
                        <h5>Expense</h5>
                        <h2>₱ <span class="counter">{{number_format($expense, 2, '.', ',')}}</span> <span class="tuition-fees">Total</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('style')
<link rel="stylesheet" href="/css/morrisjs/morris.css">
<link rel="stylesheet" href="/css/data-table/bootstrap-table.css">
<link rel="stylesheet" href="/css/data-table/bootstrap-editable.css">
<link rel="stylesheet" href="/css/custom/dashboard.css">
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
<script src="/js/chart.min.js"></script>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar', // Choose chart type (e.g., bar, line, pie, etc.)
        data: {
            labels: ['Share Capital', 'Savings', 'Membership Fee', 'Processing Fee', 'Expense'],
            datasets: [{
                label: 'Sales',
                data: [{{$share_capital}}, {{$savings}}, {{$membership}}, {{$processing_fee}}, {{$expense}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    // 'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    // 'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false // This hides the legend
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection