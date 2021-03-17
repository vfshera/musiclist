@extends('layouts.mail')

@section('mail-content')
    <html lang="en" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
    <head>
        <!-- TEMPLATE MADE BY FRANKLIN SHERA FOR TONY GREGORY | www.tonyonthetrack.com   -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TOTT NEWSLETTER</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@600;700;800;900&display=swap" rel="stylesheet">

        <style>
            @media (max-width: 600px) {
                .image-wrapper {
                    height: 35% !important;
                }
                .content-wrapper {
                    height: 65% !important;
                }
                .big-par {
                    font-size: 22px !important;
                }
                .small-par p {
                    margin-top: 120px !important;
                }
                .thanks {
                    font-size: 14px !important;
                }
            }
        </style>

    </head>

    <body style="border: 0; font-family: 'Catamaran', sans-serif; margin: 0 auto; padding: 2%; background-color: #d8dbdb; max-width: 800px;">
        <div class="mail-body" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; height: 1080px; max-width: 800px; background-color: #f6faff;">
            <div class="image-wrapper" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; height: 40%; width: 100%; background-image: url('/storage/site-img/newsbg.jpg'); background-repeat: no-repeat; background-position: center center; background-size: cover;">
                <div class="brand" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; height: 80px; background: linear-gradient(180deg,#ffffff,#ffffffee ,#ffffffdd ,#ffffffdd , transparent); text-align: center; padding-top: 15px;">
                        <span style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                            <img src="/storage/site-img/adminlogo.png" height="25px" alt="" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                        <p class="brand-name" style="padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin: auto; color: orangered; font-weight: bold;">
                            TONY ON THE TRACK NEWSLETTER
                        </p>
                        </span>
                </div>

            </div>
            <!-- image-wrapper/ -->

            <div class="content-wrapper" style="padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin: auto; height: 60%;">
                <div class="thanks" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; height: 50px; background-color: orangered; color: white; box-shadow: 2px 2px 5px #11111155; font-weight: bold; font-size: 18px; text-align: center; vertical-align: middle; line-height: 50px;">THANKS FOR YOUR SUBSCRIPTION!</div>
                <div class="big-par" style="padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin: auto; width: 100%; height: 10%; line-height: 1.4; margin-top: 40px; font-size: 24px; font-weight: bold;">
                    <p style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; text-align: center; color: #111111cc;">
                        You Will From Now On Be Updated With <br style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                        Latest Blogs , Kits and Beats
                    </p>
                </div>
                <!-- big-paragraph/ -->

                <div class="small-par" style="padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin: auto; width: 100%; height: 10%; line-height: 1.4;">
                    <p style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; text-align: center; color: #111111cc; margin-top: 70px; font-size: 20px; font-weight: 500;">
                        If You Are Interested In Any Track <br style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                        Make Sure To <a href="/#contact" class="cont-me" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; text-decoration: none; color: #2680EB;">Contact Me</a> and <br style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                        Also Check The <br style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif;">
                        <a href="/terms-and-conditions" class="temrslink" target="_blank" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; text-decoration: none; color: #46F233;">Terms & Conditions</a>
                    </p>
                </div>
                <!-- small-paragraph/ -->
                <div class="unsub" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin-top: 110px;">
                    <p style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; text-align: center;">You Want To Opt Out?</p>
                    <div style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin-top: 10px; text-align: center; display: block;">
                        <a href="/newsletter/{{ $info['nid'] ?? '1428' }}/cancel/{{ $info['email'] ?? 'sc@xyz.com' }}" target="_blank" style="margin: 0; border: 0; font-family: 'Catamaran', sans-serif; padding: 7px 30px; text-decoration: none; background-color: #2680EB; border-radius: 30px; color: white;">Unsubscribe</a>
                    </div>
                </div>

                <footer style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; margin-top: 60px;">
                    <p class="email" style="padding: 0; border: 0; font-family: 'Catamaran', sans-serif; width: 100%; margin: 5px 0; color: #111111cc; text-align: center;">info@tonyonthetrack.com</p>
                    <p class="site" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; width: 100%; color: #111111; font-weight: bold; font-size: 20px; text-align: center; margin-bottom: 4px;">www.tonyonthetrack.com</p>
                    <p class="copyright" style="margin: 0; padding: 0; border: 0; font-family: 'Catamaran', sans-serif; width: 100%; color: #111111; font-weight: bold; font-size: 20px; text-align: center; margin-bottom: 4px;">&copy;2021</p>
                </footer>
                <!-- footer/ -->
            </div>
        </div>
        <!-- emal-body/ -->
    </body>
    </html>
@endsection
