@extends('layouts.mail')

@section('mail-styles')
    <style>
        .mail-body{
            display: flex;
            flex-direction: column;
            align-items: center;
            color: black;
            min-height: 80vh;
            background: white;
            padding: 20px 300px;
        }

        .mail-header span{
            font-size: 1.7rem;
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        footer {
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            min-height: 9.5vh;
        }

        .mail{
            background: orangered;
            min-height: 100vh;
        }

        .mail-header{
            background: orangered;
            height: 10vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
    </style>
@endsection
@section('mail-body')
 <div class="mail">
        <header class="mail-header">
            <svg xmlns="http://www.w3.org/2000/svg"  height="30px" fill="white" viewBox="0 0 472.87 474.5"><title>GREGSITELOGO</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M144,52.84H0V.35H206.61V474.5H144Z"/><path d="M265.73,0H472.87V52.7H329.05V474.36H265.73Z"/><path d="M140.8,88.94c0,15.35.28,30.37-.24,45.36-.1,2.95-2.86,6.17-5.1,8.62C88.28,194.76,87.77,279.65,133.94,332c3.89,4.41,6.24,11.39,6.68,17.37,1,13.38.31,26.88.31,40.7-56.1-14.39-100.7-81.16-101-149.15C39.57,173.48,86,102.64,140.8,88.94Z"/><path d="M331.12,87.25c61.15,21.82,100.71,81,100.79,148.7C432,309,393.48,369.26,331.16,391.76c0-15.81-.27-31.12.23-46.41.1-2.92,2.79-6.14,5-8.56,48.84-53.25,49.19-137.84,1.14-191.67-3.64-4.07-5.78-10.67-6.14-16.25C330.53,115.37,331.12,101.77,331.12,87.25Z"/><path d="M261.43,408.15h-50.9V373h50.9Z"/><path d="M210.34,68.46h51v34.81h-51Z"/></g></g></svg>
            <span> Tony On The Track </span>
        </header>
    <div class=" mail-body ">

        <h2>RE : DM - {{ $subject ?? 'FORWARDED MAIL' }}</h2>
        <p>{{ $msg ?? 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.'}}</p>
        <br><br>
        <h4>From </h4>
        <h5>{{ $name ?? 'Mail Test'}}</h5>
    </div>
     <footer>
         www.tonyonthetrack.com
     </footer>
 </div>
@endsection
