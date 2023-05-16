<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks Page</title>
    <style>
        body {
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .thanks-container {
            text-align: center;
        }

        .thanks-message {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .thanks-animation {
            width: 150px;
            height: 150px;
            background-color: #ff8080;
            border-radius: 50%;
            position: relative;
            margin: 0 auto;
            animation: spin 2s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
<div class="thanks-container">
    <h1 class="thanks-message">Thank You! "You Will Redirect To See Your Result"</h1>
    <div class="thanks-animation"></div>
</div>

<script>
    // Optional: Redirect to another page after a delay
    setTimeout(function() {
        window.location.href = "http://127.0.0.1:8000/student/result";
    }, 5000);
</script>
</body>
</html>
