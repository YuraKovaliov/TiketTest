@extends('layouts.app')

@section('style')
    <style>
        .ticket-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .ticket-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #007bff;
        }
        .ticket-card p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        .ticket-card small {
            font-size: 12px;
            color: #999;
        }
        .ticket-card .btn {
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        @if($userToken->email)
          <h3>Для Api запроса используйте вашу почту для входа</h3>  {{ $userToken->email }}
        @else
            <p>Токен отсутствует.</p>
        @endif
    </div>
    <div class="container mt-5">
        <h2>Пример</h2>
        <p><strong></strong></p>
        <p><strong></strong></p>
        <p><strong></strong></p>
    </div>

@endsection
