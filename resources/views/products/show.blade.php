@extends('layouts.app')

@section('title', $product->name)
@section('breadcrumb', 'Product Details')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-semibold tracking-tight text-[#0F172A]">Product Details</h1>
                <p class="mt-1 text-sm text-[#64748B]">Detailed specification and inventory record.</p>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#E2E8F0] bg-[#FFFFFF] px-4 py-2.5 text-sm font-medium text-[#0F172A] hover:bg-[#F8FAFC] hover:border-[#64748B]/40 transition-colors">
                    <svg class="w-4 h-4 text-[#64748B]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    <span>Back to Products</span>
                </a>

                <a href="{{ route('products.edit', $product) }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-medium text-white shadow-2xs hover:bg-[#172554] transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    <span>Edit Product</span>
                </a>
            </div>
        </div>

        <!-- Product Detail Card -->
        <div class="bg-[#FFFFFF] border border-[#E2E8F0] rounded-xl shadow-2xs overflow-hidden">
            <!-- Card Top Banner / Title -->
            <div class="px-6 sm:px-8 py-6 border-b border-[#E2E8F0] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Product Name</span>
                    <h2 class="mt-1 text-lg sm:text-xl font-semibold text-[#0F172A]">{{ $product->name }}</h2>
                </div>

                <div>
                    @if ($product->stock > 0)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#15803D]/10 border border-[#15803D]/20 px-3 py-1 text-xs font-medium text-[#15803D]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#15803D]"></span>
                            In Stock ({{ number_format($product->stock, 0, ',', '.') }})
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#DC2626]/10 border border-[#DC2626]/20 px-3 py-1 text-xs font-medium text-[#DC2626]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#DC2626]"></span>
                            Out of Stock (0)
                        </span>
                    @endif
                </div>
            </div>

            <!-- Details List -->
            <dl class="divide-y divide-[#E2E8F0]">
                <!-- Price & Stock Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-[#E2E8F0]">
                    <div class="px-6 sm:px-8 py-5">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Price</dt>
                        <dd class="mt-1.5 text-lg font-semibold text-[#172554]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </dd>
                    </div>

                    <div class="px-6 sm:px-8 py-5">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Stock</dt>
                        <dd class="mt-1.5 text-lg font-semibold text-[#0F172A]">
                            {{ number_format($product->stock, 0, ',', '.') }} <span class="text-sm font-normal text-[#64748B]">units</span>
                        </dd>
                    </div>
                </div>

                <!-- Description -->
                <div class="px-6 sm:px-8 py-5">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Description</dt>
                    <dd class="mt-2 text-sm text-[#0F172A] leading-relaxed whitespace-pre-line">
                        @if ($product->description)
                            {{ $product->description }}
                        @else
                            <span class="text-[#64748B] italic">No description provided for this product.</span>
                        @endif
                    </dd>
                </div>

                <!-- Timestamps -->
                <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-[#E2E8F0] bg-[#F8FAFC]/60">
                    <div class="px-6 sm:px-8 py-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Created At</dt>
                        <dd class="mt-1 text-sm font-medium text-[#0F172A]">
                            {{ $product->created_at ? $product->created_at->format('d M Y, H:i') : '-' }}
                        </dd>
                    </div>

                    <div class="px-6 sm:px-8 py-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-[#64748B]">Updated At</dt>
                        <dd class="mt-1 text-sm font-medium text-[#0F172A]">
                            {{ $product->updated_at ? $product->updated_at->format('d M Y, H:i') : '-' }}
                        </dd>
                    </div>
                </div>
            </dl>
        </div>
    </div>
@endsection

