<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    <style>
        .row{
            text-align: center;
            padding-top: 5%;
        }

        /* .row h1{
            font-family: 'Pacifico';
            font-size: 80px;
            color: transparent;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: white;
            text-shadow: white 2px 2px 2px;
        } */

        .row h1{
            font-family: 'Pacifico';
            font-size: 80px;
            color: white;
            animation: neon 4s infinite;
        }

        @keyframes neon{
            0%, 39%, 41%, 59%, 61%, 64%, 66%, 100%{
                text-shadow:
                    white 0 0 12px,
                    blue 0 0 24px,
                    blue 0 0 36px;
            }

            40%, 60%, 65%{
                text-shadow: none;
            }
        }
    </style>
    <div class="row">
            <h1>
                Laravel Project
            </h1>
    </div>
    <!-- <img src="img/banner.jpg" alt="Banner"> -->
    {{-- Exemplo de comentário do Blade --}}
@endsection