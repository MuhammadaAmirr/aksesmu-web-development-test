@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-xl sm:text-2xl font-semibold tracking-tight text-[#0F172A]">Products</h1>
        </div>

        <div class="shrink-0">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-medium text-white shadow-2xs hover:bg-[#172554] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Add Product</span>
            </a>
        </div>
    </div>

    <!-- Products Table Card -->
    <div class="bg-[#FFFFFF] border border-[#E2E8F0] rounded-xl shadow-2xs overflow-hidden">
        @if ($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-[#E2E8F0] bg-[#F8FAFC]">
                            <th scope="col" class="py-3.5 pl-6 pr-3 text-xs font-semibold uppercase tracking-wider text-[#64748B] w-16">
                                No.
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#64748B]">
                                Product Name
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#64748B]">
                                Description
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#64748B] whitespace-nowrap">
                                Price
                            </th>
                            <th scope="col" class="px-4 py-3.5 text-xs font-semibold uppercase tracking-wider text-[#64748B] whitespace-nowrap">
                                Stock
                            </th>
                            <th scope="col" class="py-3.5 pl-3 pr-6 text-right text-xs font-semibold uppercase tracking-wider text-[#64748B] whitespace-nowrap">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E2E8F0] text-sm">
                        @foreach ($products as $index => $product)
                            <tr class="hover:bg-[#F8FAFC]/80 transition-colors">
                                <!-- No. -->
                                <td class="py-4 pl-6 pr-3 text-[#64748B] font-medium whitespace-nowrap">
                                    {{ $products->firstItem() + $index }}
                                </td>

                                <!-- Product Name -->
                                <td class="px-4 py-4 font-medium text-[#0F172A] whitespace-nowrap">
                                    <a href="{{ route('products.show', $product) }}"
                                       class="hover:text-[#2563EB] transition-colors">
                                        {{ $product->name }}
                                    </a>
                                </td>

                                <!-- Description -->
                                <td class="px-4 py-4 text-[#64748B] max-w-xs sm:max-w-md">
                                    @if ($product->description)
                                        <p class="line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                                    @else
                                        <span class="text-[#64748B]/60 italic">No description</span>
                                    @endif
                                </td>

                                <!-- Price -->
                                <td class="px-4 py-4 font-medium text-[#0F172A] whitespace-nowrap">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <!-- Stock -->
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if ($product->stock > 0)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#15803D]/10 border border-[#15803D]/20 px-2.5 py-0.5 text-xs font-medium text-[#15803D]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#15803D]"></span>
                                            {{ number_format($product->stock, 0, ',', '.') }} in stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#DC2626]/10 border border-[#DC2626]/20 px-2.5 py-0.5 text-xs font-medium text-[#DC2626]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#DC2626]"></span>
                                            Out of stock
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="py-4 pl-3 pr-6 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center justify-end gap-2">
                                        <a href="{{ route('products.show', $product) }}"
                                           class="inline-flex items-center rounded-md border border-[#E2E8F0] bg-[#FFFFFF] px-2.5 py-1.5 text-xs font-medium text-[#0F172A] hover:bg-[#F8FAFC] hover:border-[#64748B]/40 transition-colors">
                                            View
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}"
                                           class="inline-flex items-center rounded-md border border-[#2563EB]/25 bg-[#2563EB]/5 px-2.5 py-1.5 text-xs font-medium text-[#2563EB] hover:bg-[#2563EB] hover:text-white transition-colors">
                                            Edit
                                        </a>

                                        <form action="{{ route('products.destroy', $product) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center rounded-md border border-[#DC2626]/25 bg-[#DC2626]/5 px-2.5 py-1.5 text-xs font-medium text-[#DC2626] hover:bg-[#DC2626] hover:text-white transition-colors cursor-pointer">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="border-t border-[#E2E8F0] bg-[#F8FAFC]/50 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="px-6 py-16 text-center">
                <div class="mx-auto w-12 h-12 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] flex items-center justify-center text-[#172554] mb-4">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-[#0F172A]">No products found</h2>
                <p class="mt-1 text-sm text-[#64748B] max-w-sm mx-auto">
                    Your product inventory is currently empty. Get started by adding your first product.
                </p>
                <div class="mt-6">
                    <a href="{{ route('products.create') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-medium text-white shadow-2xs hover:bg-[#172554] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Add Product</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

