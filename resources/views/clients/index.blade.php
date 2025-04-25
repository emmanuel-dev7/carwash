@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Clients') }}</h1>
    <a href="{{ route('clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">{{ __('Add Client') }}</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-4 text-left">{{ __('Name') }}</th>
                <th class="p-4 text-left">{{ __('Email') }}</th>
                <th class="p-4 text-left">{{ __('Phone') }}</th>
                <th class="p-4 text-left">{{ __('Loyalty Points') }}</th>
                <th class="p-4 text-left">{{ __('Discount') }}</th>
                <th class="p-4 text-left">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td class="p-4">{{ $client->name }}</td>
                    <td class="p-4">{{ $client->email }}</td>
                    <td class="p-4">{{ $client->phone }}</td>
                    <td class="p-4">{{ $client->loyalty_points }}</td>
                    <td class="p-4">{{ $client->discount_percentage }}%</td>
                    <td class="p-4">
                        <a href="{{ route('clients.edit', $client) }}" class="text-blue-600">{{ __('Edit') }}</a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">{{ __('Delete') }}</button>
                        </form>
                        <form action="{{ route('clients.apply-discount', $client) }}" method="POST" class="inline">
                            @csrf
                            <input type="number" name="loyalty_points_threshold" placeholder="Points threshold" class="border p-1" required>
                            <input type="number" name="discount_percentage" placeholder="Discount %" class="border p-1" required>
                            <button type="submit" class="text-green-600">Apply Discount</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
