<?php

require_once 'vendor/autoload.php';

function valData($data){
    if(isset($_REQUEST[$data]))
        return $_REQUEST[$data];
    else
        return '';
}

$fname = valData('fname');
$lname = valData('lname');
$email = valData('email');
$phone = valData('phone');
$city = valData('city');

$m = new SimpleEmailServiceMessage();
//$m->addTo(array('sridhar.rajaram@justbooksclc.com','akhil.kamalasan@justbooksclc.com'));
$m->addTo(array('vasim@freenet.zone'));
$m->setFrom('customercare@justbooksclc.com');
$m->setSubject('Franchisee Request');
//$m->setMessageFromString("Recieved Franchisee Request from below person.<br><p>First Name:</p> $fname<br>");
$text = "Recieved franchisee request from below person";
$html = '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css"> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .x-gmail-data-detectors,    /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
       }
       /* If the above doesnt work, add a .g-img class to any image in question. */
       img.g-img + div {
           display: none !important;
       }

       /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size youd like to fix */
        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>
    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
                line-height: 22px !important;
            }
        }

    </style>
    <!-- Progressive Enhancements : END -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<body width="100%" bgcolor="#f2f5f7" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #f2f5f7; text-align: left;">

        

        <!-- Email Header : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
            <tr>
                <td style="padding: 20px 0; text-align: center">
                    <img src="https://www.justbooks.in/assets/img/logo.png" width="250" height="50" alt="alt_text" border="0" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                </td>
            </tr>
        </table>
        <!-- Email Header : END -->

        <!-- Email Body : BEGIN -->
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">

            

          <tr>
              <td bgcolor="#ffffff" style="padding: 40px 40px 20px; text-align: center;">
                  <h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;">Have you checked out these new additions to your library?</h1>
              </td>
          </tr>

          <!-- 3 Even Columns : BEGIN -->
          <tr>
            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 10px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center">
                                        <img src="https://images-eu.ssl-images-amazon.com/images/I/51rJ6-nCPsL._SL160_.jpg" width="170" alt="alt_text" border="0" class="fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                        <p style="margin: 0;">SITA WARRIOR OF MITHILA BOOK 2 OF THE RAM CHANDRA SERIES</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        
                       
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center">
                                        <img src="https://images-eu.ssl-images-amazon.com/images/I/51Lx2f-xWeL._SL160_.jpg" width="170" alt="alt_text" border="0" class="fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                        <p style="margin: 0;">GERONIMO STILTON SPACEMICE #11:WELL BITE YOUR TAIL, GERONIMO!</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center">
                                        <img src="https://images-eu.ssl-images-amazon.com/images/I/51cCNz-Q2JL._SL160_.jpg" width="170" alt="alt_text" border="0" class="fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                        <p style="margin: 0;">SHOO CAVEFLIES GERONIMO STILTON CAVEMICE 14</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->

                        

                    </tr>


                </table>

                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                  <tr>
                    
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center">
                                        <img src="https://images-eu.ssl-images-amazon.com/images/I/61DlN4DGWvL._SL160_.jpg" width="170" alt="alt_text" border="0" class="fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                        <p style="margin: 0;">TOM GATES 12 FAMILY FRIENDS AND FURRY CREATURES</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                         <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center">
                                        <img src="https://images-eu.ssl-images-amazon.com/images/I/51DWBGQl5gL._SL160_.jpg" width="170" alt="alt_text" border="0" class="fluid">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                        <p style="margin: 0;">CAMINO ISLAND</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                  </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                    <tr>
                        <td style="border-radius: 3px; background: #D32F2E; text-align: center;" class="button-td">
                            <a href="https://justbooks.in" style="background: #D32F2E; border: 15px solid #D32F2E; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff;">Rent Now!</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            </a>
                        </td>
                    </tr>
                </table>
                <!-- Button : END -->
            </td>
        </tr>
        <!-- 3 Even Columns : END -->

        

        <!-- Thumbnail Right, Text Left : BEGIN -->
        <tr>
            <td bgcolor="#0254d8" dir="rtl" align="center" valign="top" width="100%" style="padding: 10px;">
                <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td dir="ltr" valign="top" style="padding: 0 10px;">
                                        <a href="https://play.google.com/store/apps/details?id=com.justbooks.in&hl=en"><img src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" width="170" height="170" alt="alt_text" border="0" class="center-on-narrow" style="height: auto; background: #0254d8; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td width="66.66%" class="stack-column-center">
                            <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td dir="ltr" valign="top" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px; text-align: left;" class="center-on-narrow">
                                        <a href="https://justbooks.in"><h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 18px; line-height: 21px; color: #fff; font-weight: bold;">JustBooks.in</h2></a>
                                        
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Thumbnail Right, Text Left : END -->

        <!-- Clear Spacer : BEGIN -->
        <tr>
            <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">
                &nbsp;
            </td>
        </tr>
        <!-- Clear Spacer : END -->

       

    </table>

    </center>
</body>
</html>';
$m->setMessageFromString($text, $html);

$ses = new SimpleEmailService('AKIAJUYFFWPTDDSSNO3Q', 'Z+8AGSX8z3lWAhmHXVgISHkOwcKD3O9TSfkvImfX');
print_r($ses->sendEmail($m));

?>