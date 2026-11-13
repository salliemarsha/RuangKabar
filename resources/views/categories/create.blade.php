@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
                <ol class="crumbs" aria-label="Breadcrumb"><li>Admin</li><li>Kategori</li><li>Tambah</li></ol>
                    <section class="hero" aria-labelledby="page-title">
                        <div class="hero-inner">
                            <a class="back-link" href="/categories"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 8H3M7 4L3 8l4 4"/></svg> Kembali ke daftar kategori</a>
                            <span class="hero-label">KATEGORI</span>
                            <h1 class="hero-title" id="page-title">Tambah Kategori</h1>
                            <p class="hero-lead">Berikan nama yang singkat dan jelas agar mudah dikenali pembaca.</p>
                        </div>
                    </section>

                    @if ($errors->any())
                        <div class="flash flash--error" role="alert">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
                            <div>
                                <strong>Terjadi kesalahan</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="form-layout">
                        <form class="card" action="/categories" method="POST">
                                @csrf

                            <div class="field">
                                <label for="name">Nama Kategori</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    maxlength="100"
                                    required
                                    data-empty="Nama Kategori"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    aria-describedby="name-hint{{ $errors->has('name') ? ' name-error' : '' }}"
                                    autofocus
                                    {!! $errors->has('name') ? 'aria-invalid="true"' : '' !!}
                                >
                                @error('name')
                                    <p class="field-error" id="name-error">{{ $message }}</p>
                                @enderror
                                <p class="hint" id="name-hint">Slug dibuat otomatis dari nama kategori.</p>
                            </div>

                            <div class="form-actions">
                                <button class="btn" type="submit">Simpan Kategori</button>
                                <a class="btn btn--ghost" href="/categories">Batal</a>
                            </div>
                        </form>

                        <aside class="aside-card" aria-label="Pratinjau">
                            <p class="aside-title">Pratinjau</p>
                            <p class="preview" id="preview-name">Nama Kategori</p>
                            <span class="preview-slug" id="preview-slug">-</span>
                            <p class="aside-note">Nama kategori harus unik, maksimal 100 karakter.</p>
                        </aside>
                    </div>
@endsection

@push('scripts')
<script>
(function () {
            var nameInput = document.getElementById('name');
            var preview = document.getElementById('preview-name');
            var previewSlug = document.getElementById('preview-slug');

            if (nameInput && preview && previewSlug) {
                var empty = nameInput.getAttribute('data-empty');

                var slugify = function (value) {
                    return value
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                };

                var update = function () {
                    var value = nameInput.value.trim();
                    preview.textContent = value || empty;
                    previewSlug.textContent = slugify(value) || '-';
                };

                nameInput.addEventListener('input', update);
                update();
            }
})();
</script>
@endpush