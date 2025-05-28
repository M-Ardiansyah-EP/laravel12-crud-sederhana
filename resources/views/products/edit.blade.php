<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product - {{ $product->title }}</title>
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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Edit Product</h1>
            <p class="text-gray-600">Update product information</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Navigation Breadcrumb -->
        <div class="max-w-4xl mx-auto mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors duration-200">Products</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('products.show', $product->id) }}" class="hover:text-blue-600 transition-colors duration-200">{{ $product->title }}</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">Edit</span>
            </nav>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                    <h2 class="text-white text-xl font-semibold">Update Product Information</h2>
                </div>

                <!-- Current Image Preview -->
                <div class="p-6 bg-gray-50 border-b">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Current Product Image</h3>
                    <div class="w-32 h-32 rounded-xl overflow-hidden shadow-md bg-white p-2">
                        <img src="{{ asset('/storage/products/'.$product->image) }}" 
                             class="w-full h-full object-cover rounded-lg" 
                             alt="{{ $product->title }}">
                    </div>
                </div>

                <!-- Form -->
                <div class="p-8">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Image Upload -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Update Product Image</label>
                            <div class="relative">
                                <input type="file" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror" 
                                       name="image"
                                       accept="image/*">
                            </div>
                            <p class="text-sm text-gray-500">Leave empty to keep current image</p>
                            @error('image')
                                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Product Title</label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('title') border-red-500 @enderror" 
                                   name="title" 
                                   value="{{ old('title', $product->title) }}" 
                                   placeholder="Enter product title">
                            @error('title')
                                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Description</label>
                            <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('description') border-red-500 @enderror" 
                                      name="description" 
                                      rows="5" 
                                      placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Price and Stock Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Price -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Price (Rp)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500">Rp</span>
                                    </div>
                                    <input type="number" 
                                           class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('price') border-red-500 @enderror" 
                                           name="price" 
                                           value="{{ old('price', $product->price) }}" 
                                           placeholder="0"
                                           min="0"
                                           step="0.01">
                                </div>
                                @error('price')
                                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Stock Quantity</label>
                                <input type="number" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 @error('stock') border-red-500 @enderror" 
                                       name="stock" 
                                       value="{{ old('stock', $product->stock) }}" 
                                       placeholder="0"
                                       min="0">
                                @error('stock')
                                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            <button type="submit" 
                                    class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Update Product
                            </button>
                            <button type="reset" 
                                    class="flex-1 bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition-colors duration-200">
                                Reset Changes
                            </button>
                            <a href="{{ route('products.show', $product->id) }}" 
                               class="flex-1 text-center bg-white border-2 border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            toolbar: [
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'tools', items: ['Maximize'] }
            ],
            height: 200,
            removePlugins: 'elementspath',
            resize_enabled: false
        });
    </script>

</body>
</html>