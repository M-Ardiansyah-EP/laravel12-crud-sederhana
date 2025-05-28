<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->title }} - Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E293B',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Product Details</h1>
            <p class="text-gray-600">View complete product information</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Navigation Breadcrumb -->
        <div class="max-w-6xl mx-auto mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors duration-200">Products</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $product->title }}</span>
            </nav>
        </div>

        <!-- Product Detail Card -->
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    
                    <!-- Product Image Section -->
                    <div class="bg-gray-50 p-8 flex items-center justify-center">
                        <div class="w-full max-w-md">
                            <div class="aspect-square rounded-2xl overflow-hidden shadow-lg bg-white p-4">
                                <img src="{{ asset('/storage/products/'.$product->image) }}" 
                                     class="w-full h-full object-cover rounded-xl" 
                                     alt="{{ $product->title }}">
                            </div>
                        </div>
                    </div>

                    <!-- Product Information Section -->
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <!-- Title -->
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                            {{ $product->title }}
                        </h1>

                        <!-- Price -->
                        <div class="mb-6">
                            <div class="text-3xl font-bold text-green-600">
                                {{ "Rp " . number_format($product->price,2,',','.') }}
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-8">
                            <div class="flex items-center space-x-3">
                                <span class="text-gray-700 font-medium">Stock:</span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                                       {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock }} 
                                    @if($product->stock > 0)
                                        units available
                                    @else
                                        out of stock
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Description</h3>
                            <div class="prose prose-sm max-w-none text-gray-700 bg-gray-50 p-6 rounded-xl">
                                {!! $product->description !!}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-4">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('products.edit', $product->id) }}" 
                                   class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-medium text-center hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    Edit Product
                                </a>
                                <form onsubmit="return confirm('Are you sure you want to delete this product?');" 
                                      action="{{ route('products.destroy', $product->id) }}" 
                                      method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition-colors duration-200">
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                            <a href="{{ route('products.index') }}" 
                               class="block w-full text-center bg-white border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200">
                                Back to Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Cards -->
        <div class="max-w-6xl mx-auto mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Product ID Card -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Product ID</h3>
                <p class="text-gray-600">#{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

            <!-- Stock Status Card -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Inventory</h3>
                <p class="text-gray-600">{{ $product->stock }} units</p>
            </div>

            <!-- Category Card (if you have categories) -->
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Status</h3>
                <p class="text-gray-600">
                    @if($product->stock > 0)
                        Available
                    @else
                        Out of Stock
                    @endif
                </p>
            </div>
        </div>
    </div>

</body>
</html>