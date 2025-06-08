<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Wedding Plan Recap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <div class="title">Wedding Plan Recap</div>
    <div class="section">
        <strong>Customer Info</strong><br>
        Groom: {{ $customer->grooms_name }}<br>
        Bride: {{ $customer->brides_name }}<br>
        Guests: {{ $customer->guest_count }}<br>
        Wedding Date: {{ $customer->wedding_date }}<br>
        Phone: {{ $customer->phone_number }}<br>
        @if(isset($customer->referral_code))
            Referral: {{ $customer->referral_code }}<br>
        @endif
    </div>

    <div class="section">
        <strong>Venue</strong><br>
        Name: {{ $venue->nama ?? '-' }}<br>
        Type: {{ $venue->type ?? '-' }}<br>
        Description: {{ $venue->deskripsi ?? '-' }}<br>
        Price: Rp {{ isset($venue->harga) ? number_format($venue->harga, 0, ',', '.') : '-' }}<br>
    </div>

    @if($catering)
        <div class="section">
            <strong>Catering</strong><br>
            Name: {{ $catering->nama ?? '-' }}<br>
            @if($catering->type === 'Hotel' || $catering->type === 'Resto')
                Total Buffet: IDR {{ number_format($totalBuffet, 0, ',', '.') }}<br>
                Total Gubugan: IDR {{ number_format($totalGubugan, 0, ',', '.') }}<br>
                Total Dessert: IDR {{ number_format($totalDessert, 0, ',', '.') }}<br>
            @endif
            Total Catering: <strong>IDR {{ number_format($cateringTotal, 0, ',', '.') }}</strong><br>
        </div>
    @endif


    <div class="section">
        <strong>Vendors</strong>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Estimated Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->vendor->nama ?? '-' }}</td>
                        <td>{{ $vendor->vendor->deskripsi ?? '-' }}</td>
                        <td>Rp {{ number_format($vendor->estimated_price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <strong>Total (Venue + Vendors + Catering):</strong>
        <strong>IDR {{ number_format($total, 0, ',', '.') }}</strong>
    </div>
</body>

</html>