@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Services') }}</h1>
    <a href="{{ route('services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">{{ __('Add Service') }}</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-4 text-left">{{ __('Name') }}</th>
                <th class="p-4 text-left">{{ __('Price') }}</th>
                <th class="p-4 text-left">{{ __('Vehicle Type') }}</th>
                <th class="p-4 text-left">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td class="p-4">{{ $service->name }}</td>
                    <td class="p-4">{{ number_format($service->price, 2) }} €</td>
                    <td class="p-4">{{ $service->vehicle_type ?? 'N/A' }}</td>
                    <td class="p-4">
                        <a href="{{ route('services.show', $service) }}" class="text-blue-600">{{ __('View') }}</a>
                        <a href="{{ route('services.edit', $service) }}" class="text-blue-600 ml-2">{{ __('Edit') }}</a>
                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
