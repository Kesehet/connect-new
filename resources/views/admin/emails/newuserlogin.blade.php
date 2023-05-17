<!DOCTYPE html>
<html>
    <head>
        <title>Email Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/53ed2048a8.js" crossorigin="anonymous"></script>
    </head>
    <body bgcolor="#e3e8e3">
       <!--Email-2-->
        <table cellpadding="0" cellspacing="0" style="max-width: 602px; width: 100%;" align="center">

            <tr>
                <td style="background-color:#afccdb; padding:15px;" align="center" valign="middle">
                    <a href="#"><img src="https://thinknyx.com/wp-content/uploads/2020/03/logo_thinknyx.png" width="200px" height="48px"></a>
                </td>
            </tr>

            <tr>
                <td style="background-color:#25abe1; padding: 100px 30px; background-image:linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)), url('https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg'); background-size: cover; background-position: center;" align="center" valign="middle">
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white; text-transform: capitalize;">Dear {{ $title }},</p>
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white;">{{ $msg }}. </p>
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white;">Email ID: {{ $email }} </p>
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white;">Password: {{ $pass }} </p>
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white;">URL: https://connect.thinknyx.com </p>
                    <p style="font-size: 20px; font-family: 'Roboto Condensed', sans-serif; text-align: left; color: white;">Regards,<br>People's Team</p>
                    
                </td>
            </tr>

            <tr>
                <td align="center" valign="top">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; background-color: #afccdb">
                        <tr>
                            <td valign="middle">
                                <div style="display: block;width: 100%;height: 1px;background-color: #afccdb"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">
                                <h2 style="color: black;font-family: 'Roboto Condensed', sans-serif; margin: 20px 0px;">Contact Us</h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle">
                                <a href="https://www.facebook.com/thinknyx" target="_blank" style="color:#2d498a; margin: 10px;"><i class="fab fa-facebook-square fa-2x"></i></a>
                                <a href="https://www.instagram.com/thinknyx/" target="_blank" style="color:#e01d31; margin: 10px;"><i class="fab fa-instagram fa-2x"></i></a>
                                <a href="https://www.youtube.com/channel/UCtkE2OJMLcX7UNf1G-RbQfA"target="_blank"  style="color:#e32620; margin: 10px;"><i class="fab fa-youtube fa-2x"></i></a>
                                <a href="https://twitter.com/thinknyx" target="_blank" style="color:#1ea7eb; margin: 10px;"><i class="fab fa-twitter fa-2x"></i></a>
                                <a href="https://www.linkedin.com/company/thinknyx-technologies" target="_blank" style="color:#1ea7eb; margin: 10px;"><i class="fab fa-linkedin fa-2x"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" align="center">
                                <p style="font-size: 14px;color:white;font-family: 'Roboto Condensed', sans-serif; margin: 25px 0px 20px;">606 & 607, PURI 81 BUSINESS HUB, Sector 81, Faridabad</p>
                                <p style="font-size: 10px;color:white;font-family: 'Roboto Condensed', sans-serif ;margin: 25px 0px 20px ">© {{ date('Y') }} Thinknyx Technologies LLP. All Rights Reserved</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
