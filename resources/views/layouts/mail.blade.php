<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Summary</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        h1 {
            color: #555;
            font-size: 25px
        }

        .address-section {
            margin-bottom: 20px;
        }

        .address-section h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .address-section p {
            margin: 2px 0;
        }

        img {
            margin: 0;
            padding: 0;
            width: 35px;
            height: 30px;
        }
        
    </style>
    @yield('css')
</head>

<body>
    <div class="container">
        <h1>
            @yield('mail-title')
            . @yield('imoge')</h1>
        {{-- {{ $message->embedData('box')}} --}}
        <!-- Address Section -->
        <div class="address-section">
            <h2>Shipping Address</h2>
            <p>Order ID : <strong>{{ $order_id }}</strong></p>
            <p>Your address is : <strong>{{ $address }}</strong></p>
            <p>your zip_code is: <strong>{{ $zip_code }}</strong></p>
        </div>
        @yield('body')
    </div>
</body>

</html>
