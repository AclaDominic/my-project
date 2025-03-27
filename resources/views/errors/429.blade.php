<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f8d7da;
            color: #721c24;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
        }
        #countdown {
            font-size: 20px;
            font-weight: bold;
            color: #d9534f;
        }
    </style>
    <script>
        let countdown = {{ $retryAfter }};
        function updateCountdown() {
            if (countdown > 0) {
                document.getElementById("countdown").innerText = countdown + " seconds";
                countdown--;
                setTimeout(updateCountdown, 1000);
            } else {
                location.reload(); // Refresh when countdown ends
            }
        }
        window.onload = updateCountdown;
    </script>
</head>
<body>
    <div class="container">
        <h1>Too Many Requests</h1>
        <p>You have exceeded the request limit. Please wait before trying again.</p>
        <p>Retry in <span id="countdown">{{ $retryAfter }} seconds</span></p>
    </div>
</body>
</html>
