<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multi Shop | Order Created</title>
    <style>
        .confirmation-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .center-gif {
            max-width: 50%;
            /* Set width to 50% of the container */
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="confirmation-page">
        <img src="{{ asset('theme/img/orderCreated.gif') }}" alt="order">
        <h2>Your order has been created successfully!</h2>
        <p>Thank you for shopping with us! We'll notify you when it's on the way.</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location.href = "{{ route('home') }}";
            }, 4000);
        });
    </script>
</body>

</html>
