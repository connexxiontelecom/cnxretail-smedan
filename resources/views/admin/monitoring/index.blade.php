@extends('layouts.admin-layout')
@section('active-page')
    Performance
@endsection
@section('title')
    Performance
@endsection
@section('extra-styles')


@endsection
@section('breadcrumb-action-btn')
    <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-money"></i>
        </span> Go Back
    </a>

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary mr-1">Revenue Growth</a>
                                    <a href="{{route('revenue-per-client', $business->slug)}}" class="btn btn-primary mr-1">Revenue per Client</a>
                                    <a href="#" class="btn btn-primary mr-1">Profit Margin</a>
                                    <a href="#" class="btn btn-primary mr-1">Client Retention Rate</a>
                                    <a href="{{route('business-customer-satisfaction', ['tenant'=>$business->slug,])}}" class="btn btn-primary mr-1">Customer Satisfaction</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h3 class="card-title">{{$business->company_name ?? '' }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3 ">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-phone fs-16 mr-2 "></i></span>
                                            </div>
                                            <div> <p class="mb-0">{{$business->phone_no  ?? ''}} </p></div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3  mr-2">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-mail fs-16"></i></span>
                                            </div>
                                            <div>
                                                <p class="mb-0">{{$business->email ?? '' }} </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 ">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-map fs-16 mr-2"></i></span>
                                            </div>
                                            <div>
                                                <p class="mb-0">{{$business->address ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3  mr-2">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-map-pin fs-16"></i></span>
                                            </div>
                                            <div>
                                                <p class="mb-0">{{$business->getBusinessCategory->category_name ?? ''}}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Revenue
                                </div>
                                <div class="card-body">
                                    <div class="chart-wrapper">
                                        <canvas id="myChart" width="400" height="400" class="h-300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Margin
                                </div>
                                <div class="card-body">
                                    <div class="chart-wrapper">
                                        <canvas id="pie_chart" width="400" height="400" class="h-300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Revenue Per Client
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Client</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $n = 1; @endphp
                                                @foreach ($receipts as $receipt)
                                                    <tr>
                                                        <td>{{$n++}}</td>
                                                        <td>{{date('d M, Y', strtotime($receipt->created_at))}}</td>
                                                        <td>{{$receipt->getContact->company_name ?? ''}}</td>
                                                        <td>{{$receipt->counter > 1 ? 'Repeat' : 'New'}}</td>
                                                        <td class="text-right">{{ number_format($receipt->amount,2) }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Customer Satisfaction
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                <i class="fe fe-star" style="color:#f1c40f"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                            </div>
                                            <div class="col-md-2">
                                                {{count($surveyResponse) > 0 ? ceil($surveyResponse->where('rating',5)->count()/count($surveyResponse) * 100 ) : 0}}%
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                <i class="fe fe-star" style="color:#f1c40f"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16); "></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                            </div>
                                            <div class="col-md-2">
                                                {{count($surveyResponse) > 0 ? ceil($surveyResponse->where('rating',4)->count()/count($surveyResponse) * 100 ) : 0}}%
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                <i class="fe fe-star" style="color:#f1c40f"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                            </div>
                                            <div class="col-md-2">
                                                {{count($surveyResponse) > 0 ? ceil($surveyResponse->where('rating',3)->count()/count($surveyResponse) * 100 ) : 0}}%
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                <i class="fe fe-star" style="color:#f1c40f"></i>
                                                <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                            </div>
                                            <div class="col-md-2">
                                                {{count($surveyResponse) > 0 ? ceil($surveyResponse->where('rating',2)->count()/count($surveyResponse) * 100 ) : 0}}%
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                <i class="fe fe-star" style="color:#f1c40f"></i>
                                            </div>
                                            <div class="col-md-2">
                                                {{count($surveyResponse) > 0 ? ceil($surveyResponse->where('rating',1)->count()/count($surveyResponse) * 100 ) : 0}}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/assets/js/chart.min.js"></script>
    <script src="/assets/plugins/rating/jquery.rating-stars.js"></script>
    <script>

        $(document).ready(function(){
            const result = [];
            const profitMargin = [];
            const months = ['Jan','Feb','Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const url = "{{route('ajax-performance', $tenantId)}}";
            let i = 1;
            axios.get(url)
                .then(res=> {
                    for(i = 1; i<=12; i++){
                    res.data.map(entry => {
                        if(i === parseInt(entry.month)){
                            result.push(entry.creditAmount);
                            profitMargin.push(entry.creditAmount - entry.debitAmount);
                        }else{
                            result.push(0);
                            profitMargin.push(0);
                        }

                    });
                }
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: 'Revenue',
                                data: result,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 89, 32, 0.2)',
                                    'rgba(255, 77, 189, 0.2)',
                                    'rgba(167, 230, 56, 0.2)',
                                    'rgba(49, 12, 186, 0.2)',
                                    'rgba(207, 167, 204, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 103, 76, 1)',
                                    'rgba(255, 201, 81, 1)',
                                    'rgba(45, 180, 69, 1)',
                                    'rgba(120, 34, 86, 1)',
                                    'rgba(78, 21, 173, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    const ctxPie = document.getElementById('pie_chart').getContext('2d');
                    const myChartPie = new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Jan','Feb','Mar','Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Profit Margin',
                                data: profitMargin,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 190, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 89, 32, 0.2)',
                                    'rgba(255, 77, 189, 0.2)',
                                    'rgba(167, 230, 56, 0.2)',
                                    'rgba(49, 12, 289, 0.2)',
                                    'rgba(207, 167, 204, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 190, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 103, 76, 1)',
                                    'rgba(255, 201, 81, 1)',
                                    'rgba(45, 180, 69, 1)',
                                    'rgba(120, 34, 289, 1)',
                                    'rgba(78, 21, 173, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    var chart_data = {
                        labels:language,
                        datasets:[
                            {
                                label:'Vote',
                                backgroundColor:color,
                                color:'#fff',
                                data:total
                            }
                        ]
                    };
                    var group_chart1 = $('#pie_chart');

                    var graph1 = new Chart(group_chart1, {
                        type:"pie",
                        data:chart_data
                    });
                })
                .catch(err=>{
                  //  console.log(err);
                })

console.log(months)
        });
    </script>
@endsection
