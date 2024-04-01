
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
                <h1>New Contact Details</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                
                <h3>Name: {{ $name }}</h3>
                <p>Email: {{ $email }}</p>
                <!-- <p>Company name: {{ $company_name }}</p> -->
                <p>Message: {{ $messages }}</p>
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
