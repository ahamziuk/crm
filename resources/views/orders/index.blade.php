@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список замовлень</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Клієнт</th>
                <th>Місто</th>
                <th>Відділення</th>
                <th>Сума</th>
                <th>Дата</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->client->full_name ?? '—' }}</td>
                    <td>{{ $order->city_ref }}</td>
                    <td>{{ $order->warehouse_ref }}</td>
                    <td>{{ number_format($order->total, 2) }} грн</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Переглянути</a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning">Редагувати</a>
                        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Видалити замовлення?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Замовлень ще немає</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
