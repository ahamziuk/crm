@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Клієнти</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Додати клієнта</a>

    <table class="table">
        <thead>
            <tr>
                <th>Ім’я</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Instagram</th>
                <th>Місто</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->instagram }}</td>
                <td>{{ $client->city }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Редагувати</a>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
