<!DOCTYPE html>
<html>
<head>
    <title>Sign up successful</title>
    <style>
        /* Add inline styles for better email client compatibility */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
        }
        td {
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
        }
        .header {
            background-color: #010101;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #010101;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="header">
                <img src="https://polosoftech.com/staging/morshgolf/public/storage/photos/1/General%20Settings/logo.png" alt="morshgolf">
                <h1>Welcome to morshgolf</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                <h2>Hello, {{ $name }}</h2>
                <p>We are excited to welcome you to morshgolf! Thank you for signing up and becoming a part of our community. We are thrilled to have you on board.</p>
                <p><a href=" {{route('login.form')}} ">Click here</a> to visit our website.</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                &copy; @php echo date('Y'); @endphp MorshGolf | Development: Polosoftech
            </td>
        </tr>
    </table>
</body>
</html>
