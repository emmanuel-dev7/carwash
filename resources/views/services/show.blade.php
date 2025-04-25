@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Service Details') }}</h1>
    <div class="bg-white p-6 rounded shadow">
        <p><strong>{{ __('Name') }}:</strong> {{ $service->name }}</p>
        <p><strong>{{ __('Description') }}:</strong> {{ $service->description ?? 'N/A' }}</p>
        <p><strong>{{ __('Price') }}:</strong> {{ number_format($service->price, 2) }} €</p>
        <p><strong>{{ __('Vehicle Type') }}:</strong> {{ $service->vehicle_type ?? 'N/A' }}</p>
        <a href="{{ route('services.edit', $service) }}" class="bg-blue-600 text-white px-4 py-2 rounded inline-block mt-4">{{ __('Edit') }}</a>
        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded mt-4 ml-2">{{ __('Delete') }}</button>
        </form>
    </div>
@endsection
