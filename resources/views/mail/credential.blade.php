<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Login Credentials</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        img {
            border: 0;
            display: block;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .content {
                padding: 20px !important;
            }

            .credential-box {
                padding: 20px !important;
            }

            .details-table td {
                display: block;
                width: 100% !important;
                padding: 10px 0 !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <!-- Center the email -->
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        <tr>
            <td align="center" bgcolor="#ffffff" style="padding: 40px 20px;">
                <!-- Header -->
                <h1 style="margin: 0; font-size: 28px; color: #333333;">Welcome to Mero Dokan!</h1>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px; border-top: 1px solid #eeeeee;">
                <!-- Greeting -->
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 20px;">
                    Dear {{ $client->name }},
                </p>
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 20px;">
                    Great news! Your request to list <strong>{{ $client->shop_name }}</strong> on our platform has been
                    <strong>approved</strong>.
                </p>
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 30px;">
                    You can now log in to your client dashboard to manage your store/restaurant details, menu, orders,
                    and more.
                </p>

                <!-- Login Credentials Box -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="background-color: #e8f5e9; border: 1px solid #c8e6c9; border-radius: 8px;"
                    class="credential-box">
                    <tr>
                        <td style="padding: 30px; text-align: center;">
                            <p style="font-size: 18px; margin: 0 0 20px; color: #2e7d32;">
                                <strong>Your Login Credentials</strong>
                            </p>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="details-table">
                                <tr>
                                    <td
                                        style="padding: 12px 20px; font-weight: bold; color: #333333; width: 40%; text-align: left;">
                                        Login URL:</td>
                                    <td style="padding: 12px 20px; color: #007bff; text-align: left;">
                                        <a href="{{url('/client')}}"
                                            target="_blank">{{url('/client')}}</a>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td
                                        style="padding: 12px 20px; font-weight: bold; color: #333333; text-align: left;">
                                        Email:</td>
                                    <td style="padding: 12px 20px; color: #555555; text-align: left;">
                                        {{ $client->email }}</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 12px 20px; font-weight: bold; color: #333333; text-align: left;">
                                        Temporary Password:</td>
                                    <td
                                        style="padding: 12px 20px; color: #d32f2f; font-size: 20px; font-weight: bold; letter-spacing: 2px; text-align: left;">
                                        {{ $password }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Security Notice -->
                <p
                    style="font-size: 15px; line-height: 1.5; color: #d32f2f; margin: 30px 0 20px; padding: 15px; background-color: #fff3e0; border-left: 4px solid #ff9800;">
                    <strong>Important:</strong> For your security, please change your password immediately after logging
                    in for the first time.
                </p>

                <!-- CTA Button -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                    <tr>
                        <td align="center">
                            <a href="{{url('/client')}}" target="_blank"
                                style="display: inline-block; padding: 15px 30px; background-color: #007bff; color: #ffffff; font-size: 16px; font-weight: bold; border-radius: 5px; text-decoration: none;">
                                Log In to Dashboard
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" style="padding: 30px; text-align: center; font-size: 14px; color: #999999;">
                &copy; {{ date('Y') }} [Your Website Name]. All rights reserved.<br>
                If you need assistance, contact us at support@yourwebsite.com
            </td>
        </tr>
    </table>
</body>

</html>
