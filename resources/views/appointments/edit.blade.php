@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Edit Appointment') }}</h1>
    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="client_id" class="block text-sm font-medium">{{ __('Client') }}</label>
            <select name="client_id" id="client_id" class="border p-2 w-full" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $appointment->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="service_id" class="block text-sm font-medium">{{ __('Service') }}</label>
            <select name="service_id" id="service_id" class="border p-2 w-full" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $service->id == $appointment->service_id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="employee_id" class="block text-sm font-medium">{{ __('Employee') }}</label>
            <select name="employee_id" id="employee_id" class="border p-2 w-full" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $appointment->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium">{{ __('Start Time') }}</label>
            <input type="datetime-local" name="start_time" id="start_time" class="border p-2 w-full" value="{{ $appointment->start_time->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium">{{ __('End Time') }}</label>
            <input type="datetime-local" name="end_time" id="end_time" class="border p-2 w-full" value="{{ $appointment->end_time->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium">{{ __('Status') }}</label>
            <select name="status" id="status" class="border p-2 w-full">
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Update') }}</button>
    </form>
@endsection
