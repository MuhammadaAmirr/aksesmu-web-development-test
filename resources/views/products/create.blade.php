@extends('layouts.app')

@section('title', 'Create Product')
@section('breadcrumb', 'Create Product')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl font-semibold tracking-tight text-[#0F172A]">Create Product</h1>
            <p class="mt-1 text-sm text-[#64748B]">Add a new item to your product inventory.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-[#FFFFFF] border border-[#E2E8F0] rounded-xl shadow-2xs overflow-hidden">
            <form action="{{ route('products.store') }}" method="POST" novalidate>
                @csrf

                @include('products._form', [
                    'submitLabel' => 'Save Product',
                ])
            </form>
        </div>
    </div>
@endsection

