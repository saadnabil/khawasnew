@extends('layout.UserMatser')

@section('content')

<div class="row">



    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <!-- Contact Info Box -->
                <div class="box">
                    <div class="t-purple font-bold-700 font-18 my-1"><strong>Contact Us Info</strong></div>
                    <!-- Phone Information -->
                    <div class="my-2">
                        <span class="font-14 t-black">
                            <i class="link-icon" data-feather="phone"></i> Ring
                        </span>
                        <span class="font-14 t-black mx-3">

                            @if ($contact)
                            {{ $contact->phone }}
                            @else
                            No contact information available
                            @endif



                        </span>
                    </div>
                    <!-- Email Information -->
                    <div class="my-2">
                        <span class="font-14 t-black">
                            <i class="link-icon" data-feather="mail"></i> Email
                        </span>
                        <span class="font-14 t-black mx-3">

                            <a href="mailto:email "> @if ($contact)
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                @else
                                Email not available
                                @endif </a>



                        </span>
                    </div>
                </div>
                <!-- Company Details Box -->
                <div class="box">
                    <!-- Company Name -->
                    <div class="t-purple font-bold-700 font-18 my-3"><strong>Company Name : @if ($contact)
                            <strong style="color:#ac8511"> {{ $contact->CompanyName }}</strong>
                            @else
                            Company Name not available
                            @endif</strong></div>

                    <!-- Company Address -->
                    <div class="my-2 font-14 t-black">
                        <div class="t-purple font-bold-700 font-18 my-3"><strong>Company Address</strong></div>

                        @if ($contact)
                        {{ $contact->address }}<br>
                        {{ $contact->street }}<br>
                        {{ $contact->zip }}
                        @else
                        Address not available
                        @endif

                    </div>
                    <!-- Company Site -->
                    <div class="my-2 font-14 t-black">
                        <div class="t-purple font-bold-700 font-18 my-3"><strong>Site : <a href="" target="_blank"> @if ($contact)
                                    <a href="{{ $contact->UrlLink }}" target="_blank">{{ $contact->UrlLink }}</a>
                                    @else
                                    URL not available
                                    @endif </a></strong></div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="col-md-8 my-4 my-md-0">
        <div class="row m-1 m-md-0">
            <form class="m-0 p-0 pr-0" action="" method="POST">

                <!-- Form Container -->
                <div class="row justify-content-between container-form pb-3 m-0">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Form Title -->
                                <div class="font-18 font-bold-700 t-purple mb-3"><strong>Contact Us Directly</strong></div>
                                <!-- Form Fields -->
                                <div class="d-flex flex-wrap">
                                    <!-- Email Field -->
                                    <div class="col-12 col-lg-6">
                                        <div class="px-2">
                                            <div class="mb-3 d-flex flex-column">
                                                <label class="font-16 form-label font-bold-700">Email Address</label>
                                                <input type="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden User ID -->
                                    <input type="hidden" name="user_id" value="">

                                    <!-- Subject Field -->
                                    <div class="col-12 col-lg-6">
                                        <div class="px-2">
                                            <div class="mb-3 d-flex flex-column">
                                                <label class="font-16 form-label font-bold-700">Enter Subject Header</label>
                                                <input type="text" name="subject" class="form-control" placeholder="Enter Subject Header" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message Field -->
                                    <div class="col-12">
                                        <div class="px-2">
                                            <div class="mb-3 d-flex flex-column">
                                                <label class="font-16 form-label font-bold-700">Enter Subject / Matter</label>
                                                <textarea name="message" class="form-control" style="resize: none;" placeholder="Enter Message" required></textarea>
                                            </div>
                                        </div>
                                        <!-- Send Message Button -->
                                        <div class="d-flex justify-content-end my-4">
                                            <button type="submit" class="btn btn-outline-dark">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
        </div>
    </div>

</div>


@endsection
