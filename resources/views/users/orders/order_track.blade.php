@extends('layout.UserMatser')

@section('content')
    <style type="text/css">
        .steps .step {
            display: block;
            width: 100%;
            margin-bottom: 35px;
            text-align: center
        }

        .steps .step .step-icon-wrap {
            display: block;
            position: relative;
            width: 100%;
            height: 80px;
            text-align: center
        }

        .steps .step .step-icon-wrap::before,
        .steps .step .step-icon-wrap::after {
            display: block;
            position: absolute;
            top: 50%;
            width: 50%;
            height: 3px;
            margin-top: -1px;
            background-color: #e1e7ec;
            content: '';
            z-index: 1
        }

        .steps .step .step-icon-wrap::before {
            left: 0
        }

        .steps .step .step-icon-wrap::after {
            right: 0
        }

        .steps .step .step-icon {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            border: 1px solid #e1e7ec;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: #374250;
            font-size: 38px;
            line-height: 81px;
            z-index: 5
        }

        .steps .step .step-title {
            margin-top: 16px;
            margin-bottom: 0;
            color: #606975;
            font-size: 14px;
            font-weight: 500
        }

        .steps .step:first-child .step-icon-wrap::before {
            display: none
        }

        .steps .step:last-child .step-icon-wrap::after {
            display: none
        }

        .steps .step.completed .step-icon-wrap::before,
        .steps .step.completed .step-icon-wrap::after {
            background-color: #0da9ef
        }

        .steps .step.completed .step-icon {
            border-color: #0da9ef;
            background-color: #0da9ef;
            color: #fff
        }


        .bg-faded,
        .bg-secondary {
            background-color: #f5f5f5 !important;
        }
    </style>

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <div class="container padding-bottom-3x mb-1">
        <div class="card mb-3">
            <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">
                    Tracking Order No - </span><span class="text-medium">34VB5540K83</span></div>
            <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Shipped Via:</span> UPS Ground</div>
                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Status:</span> Checking Quality</div>
                <div class="w-100 text-center py-1 px-2"><span class="text-medium">Expected Date:</span> SEP 09, 2017</div>
            </div>
            <div class="card-body">
                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="bi bi-hourglass-split"></i></div>
                        </div>

                        <h4 class="step-title">Pending Order</h4>
                    </div>
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="bi bi-arrow-repeat"></i> </div>
                        </div>
                        <h4 class="step-title">Proccesing Order</h4>
                    </div>
                    {{-- <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="fas fa-cog"></i></div>
                        </div>

                        <h4 class="step-title">Shipped Order</h4>
                    </div> --}}
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="bi bi-truck"></i></div>
                        </div>

                        <h4 class="step-title">On the way</h4>
                    </div>
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="bi bi-box-seam"></i></div>
                        </div>

                        <h4 class="step-title">Order Delivered</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-sm-between align-items-center">
            <div class="custom-control custom-checkbox mr-3">
                <input class="custom-control-input" type="checkbox" id="notify_me" checked>
                <label class="custom-control-label" for="notify_me">Notify me when order is delivered</label>
            </div>
            <div class="text-left text-sm-right">
                <a class="btn btn-outline-primary btn-rounded btn-sm" href="" data-toggle="modal"
                    data-target="#orderDetails">View Order Details</a>
            </div>
        </div>
    </div>
@endsection
