@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Інформація про замовлення</h2>

        <ul class="list-group">
            <li class="list-group-item"><strong>ПІБ:</strong> {{ $order->name }}</li>
            <li class="list-group-item"><strong>Телефон:</strong> {{ $order->phone }}</li>
            <li class="list-group-item"><strong>Instagram:</strong> {{ $order->instagram }}</li>
            <li class="list-group-item"><strong>Місто (Ref):</strong> {{ $order->city }}</li>
            <li class="list-group-item"><strong>Відділення (Ref):</strong> {{ $order->warehouse }}</li>
            <li class="list-group-item"><strong>Примітка:</strong> {{ $order->note }}</li>
        </ul>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Назад до списку</a>
    </div>
@endsection

