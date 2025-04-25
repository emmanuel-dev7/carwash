@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Appointments') }}</h1>
    <a href="{{ route('appointments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">{{ __('Add Appointment') }}</a>
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-4 text-left">{{ __('Client') }}</th>
                <th class="p-4 text-left">{{ __('Service') }}</th>
                <th class="p-4 text-left">{{ __('Employee') }}</th>
                <th class="p-4 text-left">{{ __('Start Time') }}</th>
                <th class="p-4 text-left">{{ __('Status') }}</th>
                <th class="p-4 text-left">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td class="p-4">{{ $appointment->client->name }}</td>
                    <td class="p-4">{{ $appointment->service->name }}</td>
                    <td class="p-4">{{ $appointment->employee->name }}</td>
                    <td class="p-4">{{ $appointment->start_time }}</td>
                    <td class="p-4">{{ $appointment->status }}</td>
                    <td class="p-4">
                        <a href="{{ route('appointments.edit', $appointment) }}" class="text-blue-600">{{ __('Edit') }}</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
