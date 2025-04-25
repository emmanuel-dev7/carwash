@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ __('Add Employee') }}</h1>
    <form action="{{ route('employees.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium">{{ __('Role') }}</label>
            <input type="text" name="role" id="role" class="border p-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="hours_worked" class="block text-sm font-medium">{{ __('Hours Worked') }}</label>
            <input type="number" name="hours_worked" id="hours_worked" class="border p-2 w-full" value="0" step="0.01">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Save') }}</button>
    </form>
@endsection
