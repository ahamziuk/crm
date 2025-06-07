@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати клієнта</h1>

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Ім’я</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (необов’язково)</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="instagram" class="form-label">Instagram (необов’язково)</label>
            <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Місто</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>

        <button type="submit" class="btn btn-success">Зберегти</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
