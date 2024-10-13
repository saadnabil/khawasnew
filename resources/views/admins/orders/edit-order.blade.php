@extends('layout.AdminMaster')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Invoice Logo-->
                    <div class="clearfix">
                        <div class="float-start mb-3">
                            <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo" height="40">
                        </div>
                        <div class="float-end">
                            <h4 class="m-0 d-print-none">{{(__('translation.Order Bills'))}}</h4>
                        </div>
                    </div>

                    <!-- Invoice Detail-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="float-end mt-3">
                                <p><b>Hello, {{ $order->user->name }}</b></p>
                                <p class="text-muted fs-13">{{(__('translation.Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions'))}}.</p>
                            </div>
                        </div><!-- end col -->
                        <div class="col-sm-4 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="fs-13"><strong>{{(__('translation.Order Date'))}}: </strong>
                                    {{($order->created_at->diffForHumans()) }}</p>
                                <p class="fs-13"><strong>{{(__('translation.Order ID'))}}: </strong> <span class="float-end">#<strong>{{ $order->order_id }}</strong></span></p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-6">
                            <h6 class="fs-14">{{(__('translation.Company Info'))}}</h6>
                            <address>
                                Elkhawas Trade<br>
                                Great Russell St, London<br>
                                WC1B 3NA.<br>
                                Phone: (123) 456-7890
                            </address>
                        </div> <!-- end col-->

                        <div class="col-6">
                            <h6 class="fs-14">{{(__('translation.Order To'))}}</h6>
                            <address id="address-details">
                                {{ $order->user->name }}<br>
                                {{ $order->address->address }}, {{ $order->address->city  }}<br>
                                {{ $order->address->state  }},{{ $order->address->zip  }}<br>
                                Phone: {{ $order->user->phone  }}
                            </address>
                            <button class="btn btn-primary btn-sm" onclick="showEditAddressModal()">{{(__('translation.Edit Address'))}}</button>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-centered">
                                    <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{(__('translation.Item'))}}</th>
                                        <th>{{(__('translation.Unit Price'))}}</th>
                                        <th>{{(__('translation.Quantity'))}}</th>
                                        <th class="text-end">{{(__('translation.Total'))}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach($order->order_details as $key => $orderdetail)
                                        <tr>
                                            <td class="">{{$counter}}</td>
                                            <td class="table-user">
                                                <img src="{{ $orderdetail->item->image != null ? url('storage/' . $orderdetail->item->image) : url('item.png') }}" alt="table-user" class="me-2 rounded-circle">
                                                {{$orderdetail->item->title[app()->getLocale()]}}
                                            </td>
                                            <td>${{ $orderdetail->item->unit_price }}</td>
                                            <th>{{ $orderdetail->quantity }}</th>
                                            <td class="text-end">$ {{ $orderdetail->item->total_price }}</td>
                                        </tr>
                                        @php
                                            $counter ++;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6"></div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="float-end mt-3 mt-sm-0">
                                <p><b>{{(__('translation.Sub Total'))}}:</b> <span class="float-end">${{ $order->subtotal }}</span></p>
                                <p style="color: red;"><b>{{(__('translation.Discount'))}}:</b> <span class="float-end">(-) $<span id="discount-value">{{ $order->coupon ? $order->coupon->discount : 0 }}</span></span></p>
                                <p><b>{{(__('translation.VAT'))}} ( 0 %):</b> <span class="float-end">$0.00</span></p>
                                <h3><b>{{(__('translation.Total'))}}:</b> $<span id="total-price">{{ $order->total_price }}</span></h3>
                                <button class="btn btn-primary btn-sm" onclick="showEditDiscountForm()">{{(__('translation.Edit Discount'))}}</button>
                                <form id="edit-discount-form" action="{{ route('orders.updateDiscount', $order->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="discount" value="{{ $order->discount }}" min="0" placeholder="Discount">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row-->

                    <div class="d-print-none mt-4">
                        <div class="text-end">
                            <div class="btn-group">
                                <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="mdi mdi-printer-outline lh-sm"></i> {{(__('translation.Print'))}}</a>
                            </div>
                        </div>
                        @if($order->status == 'pending')
                            <a href="#" onclick="event.preventDefault(); document.getElementById('cancel-order-form-{{ $order->id }}').submit();" class="btn btn-outline-danger float-end mt-4 confirm-cancel">
                                <i data-feather="x-circle" class="me-2 icon-md"></i>{{(__('translation.Cancelled'))}}
                            </a>
                            <form id="cancel-order-form-{{ $order->id }}" action="{{ route('user.orders.cancel', $order) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <!-- end buttons -->

                </div> <!-- end card-body-->
            </div> <!-- end card -->
        </div>
    </div>

    <!-- Edit Address Modal -->
    <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit-address-form" action="{{ route('orders.updateAddress', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAddressModalLabel">{{(__('translation.Edit Address'))}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">{{(__('translation.Add Address'))}}</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $order->address->address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">{{(__('translation.City'))}}</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $order->address->city }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">{{(__('translation.State'))}}</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ $order->address->state }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">{{(__('translation.Zip'))}}</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="{{ $order->address->zip }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('translation.Close'))}}</button>
                        <button type="submit" class="btn btn-primary">{{(__('translation.Confirm'))}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

<script>
    function showEditAddressModal() {
        var myModal = new bootstrap.Modal(document.getElementById('editAddressModal'), {});
        myModal.show();
    }

    function showEditDiscountForm() {
        document.getElementById('edit-discount-form').style.display = 'block';
    }

    document.getElementById('edit-discount-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var url = form.action;
        var formData = new FormData(form);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('discount-value').textContent = formData.get('discount');
                    document.getElementById('total-price').textContent = data.new_total;
                    form.style.display = 'none';
                }
            });
    });

    document.getElementById('edit-address-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var url = form.action;
        var formData = new FormData(form);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    var addressDetails = document.getElementById('address-details');
                    addressDetails.innerHTML = `${data.address}, ${data.city}<br>${data.state}, ${data.zip}<br>Phone: ${data.phone}`;
                    var modal = bootstrap.Modal.getInstance(document.getElementById('editAddressModal'));
                    modal.hide();
                }
            });
    });
</script>
