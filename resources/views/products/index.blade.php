<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Management</title>
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
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Product Management</h1>
            <p class="text-gray-600">Manage your products efficiently</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-white text-xl font-semibold">Products</h2>
                    <a href="{{ route('products.create') }}" 
                       class="bg-white text-blue-600 px-6 py-2 rounded-full font-medium hover:bg-blue-50 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <span class="mr-2">+</span>Add Product
                    </a>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                @if($products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-gray-100">
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Image</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Title</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Price</th>
                                    <th class="text-left py-4 px-4 font-semibold text-gray-700">Stock</th>
                                    <th class="text-center py-4 px-4 font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors duration-200">
                                        <td class="py-4 px-4">
                                            <div class="w-16 h-16 rounded-xl overflow-hidden shadow-md">
                                                <img src="{{ asset('/storage/products/'.$product->image) }}" 
                                                     class="w-full h-full object-cover" 
                                                     alt="{{ $product->title }}">
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="font-medium text-gray-900">{{ $product->title }}</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-green-600 font-semibold">
                                                {{ "Rp " . number_format($product->price,2,',','.') }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                                   {{ $product->stock > 10 ? 'bg-green-100 text-green-800' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('products.show', $product->id) }}" 
                                                   class="bg-gray-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors duration-200">
                                                    View
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}" 
                                                   class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                                                    Edit
                                                </a>
                                                <form onsubmit="return confirm('Are you sure you want to delete this product?');" 
                                                      action="{{ route('products.destroy', $product->id) }}" 
                                                      method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors duration-200">
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
                    <div class="mt-6 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-4 text-gray-300">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="text-gray-500 text-lg font-medium mb-2">No products found</h3>
                        <p class="text-gray-400 mb-4">Get started by adding your first product</p>
                        <a href="{{ route('products.create') }}" 
                           class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                            <span class="mr-2">+</span>Add Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert notifications
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @endif
    </script>

</body>
</html>