<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify your Kessy Brothers Food account</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f5f8; color:#273244; font-family:Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color:#f3f5f8; padding:32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:12px; overflow:hidden;">
                    <tr>
                        <td style="padding:26px 32px; background-color:#111b2b; text-align:center;">
                            <div style="color:#ffffff; font-size:20px; font-weight:700; letter-spacing:1px;">KESSY BROTHERS <span style="color:#20a9d4;">FOOD</span></div>
                            <div style="margin-top:8px; color:#f39a1e; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase;">Fresh meals, made with care</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 32px 24px;">
                            <h1 style="margin:0 0 18px; color:#111b2b; font-size:24px; line-height:1.3;">Welcome, {{ $user->name }}!</h1>
                            <p style="margin:0 0 16px; font-size:16px; line-height:1.6;">Thanks for creating an account with Kessy Brothers Food. Please verify your email address to finish setting up your account and start enjoying our freshly prepared meals.</p>
                            <p style="margin:28px 0; text-align:center;">
                                <a href="{{ $verificationUrl }}" style="display:inline-block; padding:14px 26px; border-radius:7px; background-color:#f39a1e; color:#111b2b; font-size:15px; font-weight:700; text-decoration:none;">Verify My Email</a>
                            </p>
                            <p style="margin:0 0 10px; color:#596579; font-size:13px; line-height:1.6;">If the button does not work, copy and paste this link into your browser:</p>
                            <p style="margin:0; overflow-wrap:anywhere; font-size:13px; line-height:1.6;"><a href="{{ $verificationUrl }}" style="color:#147da3;">{{ $verificationUrl }}</a></p>
                            <p style="margin:24px 0 0; color:#596579; font-size:14px; line-height:1.6;">If you did not create this account, you can safely ignore this email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 32px; border-top:1px solid #e8edf2; color:#687386; text-align:center; font-size:12px; line-height:1.6;">
                            <strong style="color:#111b2b;">Kessy Brothers Food</strong><br>
                            Freshly prepared. Always made with care.<br>
                            &copy; {{ date('Y') }} Kessy Brothers Food. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
