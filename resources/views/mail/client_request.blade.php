<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Client Listing Request</title>
    <style type="text/css">
        /* Basic reset and client-specific fixes */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

        /* Responsive media query */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .content {
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

<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
    <!-- Center the email -->
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
        <tr>
            <td align="center" bgcolor="#ffffff" style="padding: 40px 20px;">
                <!-- Header/Logo (replace with your logo URL if available) -->
                <h1 style="margin: 0; font-size: 28px; color: #333333;">New Listing Request</h1>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px; border-top: 1px solid #eeeeee;">
                <!-- Main content -->
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 20px;">
                    Hello Admin,
                </p>
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 20px;">
                    A new client has submitted a request to have their store/restaurant listed on our website.
                </p>
                <p style="font-size: 16px; line-height: 1.5; color: #555555; margin: 0 0 30px;">
                    Please review the details below and take the necessary action.
                </p>

                <!-- Client Details Table -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="background-color: #f9f9f9; border: 1px solid #dddddd;">
                    <tr>
                        <td colspan="2"
                            style="padding: 20px; font-size: 18px; font-weight: bold; color: #333333; background-color: #eeeeee;">
                            Client Information
                        </td>
                    </tr>
                    <tr class="details-table">
                        <td style="padding: 15px 20px; font-weight: bold; color: #333333; width: 40%;">Client Name:</td>
                        <td style="padding: 15px 20px; color: #555555;">{{ $client->name }}</td>
                    </tr>
                    <tr class="details-table" bgcolor="#ffffff">
                        <td style="padding: 15px 20px; font-weight: bold; color: #333333;">Shop/Restaurant Name:</td>
                        <td style="padding: 15px 20px; color: #555555;">{{ $client->shop_name }}</td>
                    </tr>
                    <tr class="details-table">
                        <td style="padding: 15px 20px; font-weight: bold; color: #333333;">Contact Number:</td>
                        <td style="padding: 15px 20px; color: #555555;">{{ $client->contact }}</td>
                    </tr>
                    <tr class="details-table" bgcolor="#ffffff">
                        <td style="padding: 15px 20px; font-weight: bold; color: #333333;">Email:</td>
                        <td style="padding: 15px 20px; color: #555555;">{{ $client->email }}</td>
                    </tr>
                    <tr class="details-table">
                        <td style="padding: 15px 20px; font-weight: bold; color: #333333;">Address:</td>
                        <td style="padding: 15px 20px; color: #555555;">{{ $client->address }}</td>
                    </tr>
                </table>

                <!-- Optional CTA (e.g., link to admin dashboard) -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
                    <tr>
                        <td align="center">
                            <a href="{{ url('/admin') }}" target="_blank"
                                style="display: inline-block; padding: 15px 30px; background-color: #007bff; color: #ffffff; font-size: 16px; font-weight: bold; border-radius: 5px;">
                                Review Requests in Dashboard
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" style="padding: 30px; text-align: center; font-size: 14px; color: #999999;">
                &copy; {{ date('Y') }} Your Website Name. All rights reserved.<br>
                If you have any questions, contact support at support@yourwebsite.com
            </td>
        </tr>
    </table>
</body>

</html>
