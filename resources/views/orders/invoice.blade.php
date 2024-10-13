<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #{{ $order->id }}</title>
    <style>
        /* Add custom CSS styles here */
    </style>
</head>
<body>
    <h1>Order #{{ $order->order_id }}</h1>
    <p><b>Order Date:</b> {{ $order->created_at }}</p>
    <p><b>Customer:</b> {{ $order->user->name }}</p>
    <p><b>Address:</b> {{ $order->user->addresses->first() ? $order->user->addresses->first()->city->name : 'Unknown' }}</p>

    <h3>Order Details</h3>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->order_details as $key => $detail)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><td>{{ $detail->item->title[app()->getLocale()] ?? 
                    $detail->item->title[app()->getLocale()] ?? 'No title available' }}</td></td>
                    <td>${{ $detail->item->unit_price }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ $detail->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Summary</h3>
    <p><b>Subtotal:</b> ${{ $order->subtotal }}</p>
    <p><b>Discount:</b> ${{ $order->coupon ? $order->coupon->discount : 0 }}</p>
    <p><b>Total:</b> ${{ $order->total_price }}</p>
</body>
</html>
