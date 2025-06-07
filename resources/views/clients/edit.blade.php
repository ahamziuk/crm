@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати клієнта</h1>

    <form action="{{ route('clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Ім’я</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $client->name) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone', $client->phone) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}">
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $client->instagram) }}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Місто</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $client->city) }}">
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
