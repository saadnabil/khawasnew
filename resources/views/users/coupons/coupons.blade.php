@extends('layout.UserMatser')

@section('content')
<div class="row">
    @php
    use Carbon\Carbon;
    $user = auth()->user()->with('coupons')->first();
    $coupons = $user->coupons;
    @endphp
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="h5 mb-0 pt-2 pb-2">
                    <i class="bi bi-bookmark-star me-3 fs-20"></i>
                    {{ __('translation.Coupons') }}
                </h2>
            </div>
            <div class="card-body p-4">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @forelse ($coupons as $coupon)

                    <div class="col mb-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary coupon-code">{{ $coupon->code }}</h5>
                                <p class="card-text">
                                    <span class="badge bg-info">{{ __('translation.Valid To') }}:
                                        {{ Carbon::parse($coupon->valid_to)->format('Y M d, h:i a') }}</span>
                                </p>
                                <p class="card-text">
                                    <span class="badge bg-primary">{{ __('translation.Discount') }}:
                                        {{ $coupon->discount }}{{ $coupon->type == 'percent' ? '%' : '$' }}
                                    </span>
                                </p>

                                <p class="card-text">
                @if($coupon->is_expired)
                    <span class="badge bg-danger">Discount Expired</span>
                @else
                    <span class="badge bg-success">Valid until
                     {{ $coupon->valid_to }} </span>
                @endif
            </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <button data-coupon="{{ $coupon->code }}" class="btn btn-outline-primary btn-sm copy-coupon-btn">
                                    <i class="ri-file-copy-line"></i>Copy
                                </button>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="col">
                        <div class="alert alert-info" role="alert">
                            {{ __('translation.No coupons found.') }}
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.copy-coupon-btn', function(e) {
            e.preventDefault();
            var text = $(this).data('coupon');
            navigator.clipboard.writeText(text)
                .then(function() {
                    // Optional: Show a toast message or notification for successful copy
                    alert('{{ __('
                        translation.Coupon copied successfully ') }}');
                })
                .catch(function(err) {
                    console.error('Error copying text: ', err);
                });
        });
    });

</script>

@endsection
