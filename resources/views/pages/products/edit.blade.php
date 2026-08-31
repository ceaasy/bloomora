@extends('layouts.app')

@section('title', 'Update - Product Page')
@section('page-title', 'PRODUCT PAGE')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update - Product page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.products.update', encrypt($product->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="photo" class="form-label">Product Photo</label>

                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img id="photo-preview"
                                    src="{{ $product->photo ? asset('storage/' . $product->photo) : asset('img/default.png') }}"
                                    alt="Preview" width="80" height="80" class="rounded border"
                                    style="object-fit: cover;">
                            </div>

                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="form-control @error('photo') is-invalid @enderror" onchange="previewPhoto(event)">

                            @error('photo')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category"
                                class="form-control @error('category') is-invalid @enderror">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Buket"
                                    {{ old('category', $product->category) == 'Buket' ? 'selected' : '' }}>Buket</option>
                                <option value="Hampers"
                                    {{ old('category', $product->category) == 'Hampers' ? 'selected' : '' }}>Hampers
                                </option>
                            </select>

                            @error('category')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                min="0" class="form-control @error('stock') is-invalid @enderror">

                            @error('stock')
                                <div class="invalid-feedack d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="price_small" class="form-label">Price (S)</label>
                                    <input type="number" step="0.01" name="price_small" id="price_small"
                                        value="{{ old('price_small', $product->price_small) }}"
                                        class="form-control @error('price_small') is-invalid @enderror">

                                    @error('price_small')
                                        <div class="invalid-feedack d-block">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="price_medium" class="form-label">Price (M)</label>
                                    <input type="number" step="0.01" name="price_medium" id="price_medium"
                                        value="{{ old('price_medium', $product->price_medium) }}"
                                        class="form-control @error('price_medium') is-invalid @enderror">

                                    @error('price_medium')
                                        <div class="invalid-feedack d-block">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="price_large" class="form-label">Price (L)</label>
                                    <input type="number" step="0.01" name="price_large" id="price_large"
                                        value="{{ old('price_large', $product->price_large) }}"
                                        class="form-control @error('price_large') is-invalid @enderror">

                                    @error('price_large')
                                        <div class="invalid-feedack d-block">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <label class="form-label">Customization Options (opsional)</label>
                        <div id="customization-wrapper">
                            @php
                                $customizations = old(
                                    'customization_name',
                                    collect($product->customization_options ?? [])
                                        ->pluck('name')
                                        ->toArray(),
                                );
                                $customizationPrices = old(
                                    'customization_price',
                                    collect($product->customization_options ?? [])
                                        ->pluck('price')
                                        ->toArray(),
                                );
                            @endphp
                            @foreach ($customizations as $i => $name)
                                <div class="row mb-2 customization-row">
                                    <div class="col-md-6">
                                        <input type="text" name="customization_name[]" value="{{ $name }}"
                                            class="form-control" placeholder="Nama kustomisasi">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" step="0.01" name="customization_price[]"
                                            value="{{ $customizationPrices[$i] ?? '' }}" class="form-control"
                                            placeholder="Harga tambahan">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-customization">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-customization" class="btn btn-sm btn-secondary mb-3">
                            <span class="fa fa-plus"></span> Tambah Kustomisasi
                        </button>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-save"></span>
                                Save
                            </button>

                            <a href="{{ route('admin.products.index') }}" class="btn text-white"
                                style="background-color: #6c757d; border-color: #6c757d;">
                                <span class="fa fa-times-circle"></span>
                                Cancle
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            if (file) {
                document.getElementById('photo-preview').src = URL.createObjectURL(file);
            }
        }

        document.getElementById('add-customization').addEventListener('click', function() {
            const wrapper = document.getElementById('customization-wrapper');
            const row = document.createElement('div');
            row.className = 'row mb-2 customization-row';
            row.innerHTML = `
                <div class="col-md-6">
                    <input type="text" name="customization_name[]" class="form-control" placeholder="Nama kustomisasi">
                </div>
                <div class="col-md-4">
                    <input type="number" step="0.01" name="customization_price[]" class="form-control" placeholder="Harga tambahan">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-customization">
                        <span class="fa fa-trash"></span>
                    </button>
                </div>
            `;
            wrapper.appendChild(row);
        });

        document.getElementById('customization-wrapper').addEventListener('click', function(e) {
            if (e.target.closest('.remove-customization')) {
                e.target.closest('.customization-row').remove();
            }
        });
    </script>
@endsection
