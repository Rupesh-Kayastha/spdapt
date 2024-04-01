<!DOCTYPE html>
<html>
<head>
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
                <h2>Hello, sir/ma'am</h2>
                <p>We wanted to take a moment to express our gratitude for subscribing to Newsletter. Welcome to our community!</p>
                <p>Thank you again for choosing Newsletter. We're excited to have you with us!</p>
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
