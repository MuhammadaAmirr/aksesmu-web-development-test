@php
    $isEdit = isset($product);
@endphp

<div class="p-6 sm:p-8 space-y-6">
    <!-- Product Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-[#0F172A] mb-1.5">
            Product Name <span class="text-[#DC2626]">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               value="{{ old('name', $product->name ?? '') }}"
               placeholder="e.g. Wireless Mechanical Keyboard"
               maxlength="100"
               required
               class="block w-full rounded-lg border {{ $errors->has('name') ? 'border-[#DC2626] focus:border-[#DC2626] focus:ring-[#DC2626]/15' : 'border-[#E2E8F0] focus:border-[#2563EB] focus:ring-[#2563EB]/15' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder:text-[#64748B]/60 focus:outline-none focus:ring-2 transition-colors">
        @error('name')
            <p class="mt-1.5 text-xs font-medium text-[#DC2626]">{{ $message }}</p>
        @enderror
    </div>

    <!-- Description -->
    <div>
        <div class="flex items-center justify-between mb-1.5">
            <label for="description" class="block text-sm font-medium text-[#0F172A]">
                Description
            </label>
            <span class="text-xs text-[#64748B]">Optional</span>
        </div>
        <textarea id="description"
                  name="description"
                  rows="4"
                  placeholder="Provide a brief description of the product specifications or details..."
                  class="block w-full rounded-lg border {{ $errors->has('description') ? 'border-[#DC2626] focus:border-[#DC2626] focus:ring-[#DC2626]/15' : 'border-[#E2E8F0] focus:border-[#2563EB] focus:ring-[#2563EB]/15' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder:text-[#64748B]/60 focus:outline-none focus:ring-2 transition-colors">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1.5 text-xs font-medium text-[#DC2626]">{{ $message }}</p>
        @enderror
    </div>

    <!-- Price & Stock Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-[#0F172A] mb-1.5">
                Price (IDR) <span class="text-[#DC2626]">*</span>
            </label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-sm font-medium text-[#64748B]">
                    Rp
                </span>
                <input type="number"
                       id="price"
                       name="price"
                       value="{{ old('price', isset($product) ? (float) $product->price : '') }}"
                       placeholder="0"
                       min="0"
                       max="99999999.99"
                       step="any"
                       required
                       class="block w-full rounded-lg border {{ $errors->has('price') ? 'border-[#DC2626] focus:border-[#DC2626] focus:ring-[#DC2626]/15' : 'border-[#E2E8F0] focus:border-[#2563EB] focus:ring-[#2563EB]/15' }} bg-[#FFFFFF] pl-10 pr-3.5 py-2.5 text-sm text-[#0F172A] placeholder:text-[#64748B]/60 focus:outline-none focus:ring-2 transition-colors">
            </div>
            @error('price')
                <p class="mt-1.5 text-xs font-medium text-[#DC2626]">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stock -->
        <div>
            <label for="stock" class="block text-sm font-medium text-[#0F172A] mb-1.5">
                Stock Quantity <span class="text-[#DC2626]">*</span>
            </label>
            <input type="number"
                   id="stock"
                   name="stock"
                   value="{{ old('stock', $product->stock ?? '') }}"
                   placeholder="0"
                   min="0"
                   step="1"
                   required
                   class="block w-full rounded-lg border {{ $errors->has('stock') ? 'border-[#DC2626] focus:border-[#DC2626] focus:ring-[#DC2626]/15' : 'border-[#E2E8F0] focus:border-[#2563EB] focus:ring-[#2563EB]/15' }} bg-[#FFFFFF] px-3.5 py-2.5 text-sm text-[#0F172A] placeholder:text-[#64748B]/60 focus:outline-none focus:ring-2 transition-colors">
            @error('stock')
                <p class="mt-1.5 text-xs font-medium text-[#DC2626]">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Form Footer Actions -->
<div class="px-6 sm:px-8 py-4 bg-[#F8FAFC] border-t border-[#E2E8F0] flex items-center justify-end gap-3">
    <a href="{{ route('products.index') }}"
       class="inline-flex items-center justify-center rounded-lg border border-[#E2E8F0] bg-[#FFFFFF] px-4 py-2.5 text-sm font-medium text-[#0F172A] hover:bg-[#F8FAFC] hover:border-[#64748B]/40 focus:outline-none focus:ring-2 focus:ring-[#E2E8F0] transition-colors">
        Cancel
    </a>

    <button type="submit"
            class="inline-flex items-center justify-center rounded-lg bg-[#2563EB] px-4 py-2.5 text-sm font-medium text-white shadow-2xs hover:bg-[#172554] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 transition-colors cursor-pointer">
        {{ $submitLabel ?? ($isEdit ? 'Update Product' : 'Save Product') }}
    </button>
</div>

