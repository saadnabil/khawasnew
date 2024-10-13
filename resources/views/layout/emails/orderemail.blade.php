<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .order-details {
            margin-bottom: 20px;
        }

        .order-details h2 {
            margin-bottom: 10px;
        }

        .company-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-logo img {
            max-width: 200px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
        }

        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            table {
                font-size: 12px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="company-logo">
            <img src="{{asset('assets/images/tree logo.png')}}" alt="Company Logo">
        </div>
        <div class="order-details">
            <h2>{{ __('translation.Order Invoice') }}</h2>
            <p><strong>{{ __('translation.Order ID') }}:</strong> #{{ $details['order']['order_id'] }}</p>
            <p><strong>{{ __('translation.Date') }}:</strong>{{ Carbon\Carbon::parse($details['order']['created_at'])->format('M d, Y') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>{{ __('translation.Item') }}</th>
                    <th>{{ __('translation.Quantity') }}</th>
                    <th>{{ __('translation.Unit Price') }}</th>
                    <th>{{ __('translation.Price') }}</th>
                    <th>{{ __('translation.Total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details['order']['order_details'] as $item)
                <tr>
                    <td>{{ $item['item']['title'][app()->getLocale()]}} </td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>€{{ $item['item']['unit_price']}}</td>
                    <td>€{{ $item['item']['total_price']}}</td>
                    <td>€{{ $item['total_price'] }}</td>
                </tr>
                @endforeach

                <thead>
                    <tr>
                        <th>{{ __('translation.Sub Total') }}</th>
                        <th colspan="4">€{{ $details['order']['subtotal'] }}</th>
                    </tr>
                </thead>

                @if($details['order']['coupon'])
                <thead>
                    <tr>
                        <th>{{ __('translation.Discount') }}</th>
                        <th colspan="4">{{ $details['order']['coupon']['discount'] }}{{ $details['order']['coupon']['type'] == 'percent' ? '%' : '€' }}</th>
                    </tr>

                </thead>
                <thead>
                    <tr>
                        <th>{{ __('translation.Total') }}</th>
                        <th colspan="4">€{{ $details['order']['total_price'] }}</th>
                    </tr>
                </thead>
                @endif

                <!-- Add more rows for additional items -->
            </tbody>
        </table>
        <div class="total">
            <p><strong>{{ __('translation.Total') }}:</strong> €{{ $details['order']['total_price'] }}</p>
        </div>
    </div>
</body>
</html>
