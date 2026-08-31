<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:128',
            'category' => 'required|in:Buket,Hampers',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
            'price_small' => 'required|numeric|min:0',
            'price_medium' => 'required|numeric|min:0',
            'price_large' => 'required|numeric|min:0',
            'customization_name.*' => 'nullable|string|max:255',
            'customization_price.*' => 'nullable|numeric|min:0',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 128 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori harus Buket atau Hampers.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'stock.min' => 'Stok tidak boleh kurang dari 0.',
            'price_small.required' => 'Harga ukuran Small wajib diisi.',
            'price_small.numeric' => 'Harga ukuran Small harus berupa angka.',
            'price_medium.required' => 'Harga ukuran Medium wajib diisi.',
            'price_medium.numeric' => 'Harga ukuran Medium harus berupa angka.',
            'price_large.required' => 'Harga ukuran Large wajib diisi.',
            'price_large.numeric' => 'Harga ukuran Large harus berupa angka.',
            'customization_name.*.max' => 'Nama kustomisasi maksimal 255 karakter.',
            'customization_price.*.numeric' => 'Harga kustomisasi harus berupa angka.',
        ]);

        $data = $request->only([
            'name', 'category', 'description', 'stock',
            'price_small', 'price_medium', 'price_large',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $data['customization_options'] = $this->buildCustomizationOptions($request);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail(decrypt($id));

        $request->validate([
            'name' => 'required|string|max:128',
            'category' => 'required|in:Buket,Hampers',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
            'price_small' => 'required|numeric|min:0',
            'price_medium' => 'required|numeric|min:0',
            'price_large' => 'required|numeric|min:0',
            'customization_name.*' => 'nullable|string|max:255',
            'customization_price.*' => 'nullable|numeric|min:0',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 128 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'category.in' => 'Kategori harus Buket atau Hampers.',
            'photo.image' => 'File yang diunggah harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'stock.min' => 'Stok tidak boleh kurang dari 0.',
            'price_small.required' => 'Harga ukuran Small wajib diisi.',
            'price_small.numeric' => 'Harga ukuran Small harus berupa angka.',
            'price_medium.required' => 'Harga ukuran Medium wajib diisi.',
            'price_medium.numeric' => 'Harga ukuran Medium harus berupa angka.',
            'price_large.required' => 'Harga ukuran Large wajib diisi.',
            'price_large.numeric' => 'Harga ukuran Large harus berupa angka.',
            'customization_name.*.max' => 'Nama kustomisasi maksimal 255 karakter.',
            'customization_price.*.numeric' => 'Harga kustomisasi harus berupa angka.',
        ]);

        $data = $request->only([
            'name', 'category', 'description', 'stock',
            'price_small', 'price_medium', 'price_large',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $data['customization_options'] = $this->buildCustomizationOptions($request);

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $product = Product::findOrFail(decrypt($id));

        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function buildCustomizationOptions(Request $request): array
    {
        $names = $request->input('customization_name', []);
        $prices = $request->input('customization_price', []);

        $result = [];
        foreach ($names as $i => $name) {
            if (!empty($name)) {
                $result[] = [
                    'name' => $name,
                    'price' => $prices[$i] ?? 0,
                ];
            }
        }

        return $result;
    }
}
