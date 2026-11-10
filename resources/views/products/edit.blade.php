@extends('layouts.app')

@section('title', 'Edit Product')
@section('breadcrumb', 'Edit Product')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl font-semibold tracking-tight text-[#0F172A]">Edit Product</h1>
            <p class="mt-1 text-sm text-[#64748B]">Update information and inventory details for <span class="font-medium text-[#0F172A]">{{ $product->name }}</span>.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-[#FFFFFF] border border-[#E2E8F0] rounded-xl shadow-2xs overflow-hidden">
            <form action="{{ route('products.update', $product) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                @include('products._form', [
                    'product' => $product,
                    'submitLabel' => 'Update Product',
                ])
            </form>
        </div>
    </div>
@endsection

