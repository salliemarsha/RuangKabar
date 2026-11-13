@php
    $editing = isset($article) && $article;
    $hasImage = $editing && $article->image;
    $statusValue = old('status', $editing ? $article->status : 'draft');
    $categoryValue = (string) old('category_id', $editing ? $article->category_id : '');
    $selectedTags = collect(old('tags', session()->hasOldInput() ? [] : ($editing ? $article->tags->pluck('id')->all() : [])))
        ->map(fn ($id) => (int) $id)
        ->all();
    $initialSlug = $editing ? (string) $article->slug : '';
@endphp

@if ($errors->any())
    <div class="flash flash--error" role="alert">
        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
        <div>
            <strong>Artikel belum bisa disimpan</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<p class="form-note"><span class="req" aria-hidden="true">*</span> Kolom bertanda bintang wajib diisi.</p>

<form class="editor" id="article-form" action="{{ $editing ? route('articles.update', $article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($editing)
        @method('PUT')
    @endif

    <div class="editor-main">
        <section class="ecard" aria-label="Konten artikel">
            <div class="field">
                <label for="title">Judul <span class="req" aria-hidden="true">*</span></label>
                <input class="title-input {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" id="title" name="title" value="{{ old('title', $editing ? $article->title : '') }}" maxlength="255" placeholder="Tulis judul yang menarik" required {!! $errors->has('title') ? 'aria-invalid="true" aria-describedby="title-error"' : '' !!}>
                @error('title')
                    <p class="field-error" id="title-error">{{ $message }}</p>
                @enderror

                <p class="slug-line">
                    <span class="slug-label">Slug</span>
                    <span class="slug" id="slug-preview" data-initial="{{ $initialSlug }}">{{ $initialSlug !== '' ? $initialSlug : 'otomatis-dari-judul' }}</span>
                </p>
                <p class="hint">{{ $editing ? 'Slug ikut diperbarui otomatis jika judul diubah.' : 'Slug dibuat otomatis dari judul saat artikel disimpan.' }}</p>
            </div>

            <div class="field">
                <label for="content">Isi artikel <span class="req" aria-hidden="true">*</span></label>
                <textarea class="{{ $errors->has('content') ? 'is-invalid' : '' }}" id="content" name="content" rows="10" placeholder="Mulai menulis isi artikel di sini" required {!! $errors->has('content') ? 'aria-invalid="true" aria-describedby="content-error"' : '' !!}>{{ old('content', $editing ? $article->content : '') }}</textarea>
                @error('content')
                    <p class="field-error" id="content-error">{{ $message }}</p>
                @enderror
                <p class="count"><span id="word-count">0 kata</span></p>
            </div>
        </section>
    </div>

    <div class="editor-side">
        <section class="ecard" aria-labelledby="pub-title">
            <h2 class="ecard-title" id="pub-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.8 10S5 4.5 10 4.5 18.2 10 18.2 10 15 15.5 10 15.5 1.8 10 1.8 10z"/><circle cx="10" cy="10" r="2.5"/></svg></span>Publikasi</h2>

            <fieldset class="field">
                <legend>Status <span class="req" aria-hidden="true">*</span></legend>

                <div class="status-opts">
                    <label class="status-opt">
                        <input type="radio" name="status" value="draft" {{ $statusValue === 'draft' ? 'checked' : '' }} required>
                        <span class="so-dot"></span>
                        <span class="so-text"><strong>Draft</strong><small>Disimpan, belum tampil untuk pembaca.</small></span>
                    </label>

                    <label class="status-opt">
                        <input type="radio" name="status" value="published" {{ $statusValue === 'published' ? 'checked' : '' }} required>
                        <span class="so-dot"></span>
                        <span class="so-text"><strong>Published</strong><small>Langsung tampil untuk pembaca.</small></span>
                    </label>
                </div>

                @error('status')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="field">
                <label for="category_id">Kategori <span class="req" aria-hidden="true">*</span></label>
                <select class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id" name="category_id" required>
                    <option value="">-- Pilih kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryValue === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($categories->isEmpty())
                    <p class="hint">Belum ada kategori. Minta admin menambahkannya terlebih dahulu.</p>
                @endif
                @error('category_id')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <section class="ecard" aria-labelledby="tag-title">
            <h2 class="ecard-title" id="tag-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3h6.5l7.5 7.5-6.5 6.5L3 9.5z"/><circle cx="7" cy="7" r="1"/></svg></span>Tag</h2>

            <fieldset class="field">
                <legend class="sr-only">Pilih tag</legend>

                @if ($tags->count())
                    <div class="tag-list">
                        @foreach ($tags as $tag)
                            <label class="tag-option">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array((int) $tag->id, $selectedTags, true) ? 'checked' : '' }}>
                                {{ $tag->name }}
                            </label>
                        @endforeach
                    </div>
                    <p class="hint">Opsional. Pilih satu atau lebih tag.</p>
                @else
                    <p class="hint">Belum ada tag.</p>
                @endif

                @error('tags')
                    <p class="field-error">{{ $message }}</p>
                @enderror
                @error('tags.*')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </fieldset>
        </section>

        <section class="ecard" aria-labelledby="img-title">
            <h2 class="ecard-title" id="img-title"><span class="ti"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3.5" width="14" height="13" rx="2"/><circle cx="7.5" cy="8" r="1.4"/><path d="M3.5 14.5l4-3.5 3 2.5 2.5-2 3.5 3"/></svg></span>Gambar</h2>

            <div class="field">
                @if ($hasImage)
                    <div class="img-block" id="img-current">
                        <span class="img-label">Gambar saat ini</span>
                        <div class="img-frame"><img src="{{ asset('storage/' . $article->image) }}" alt="Gambar saat ini: {{ $article->title }}"></div>
                    </div>
                @endif

                <div class="img-block" id="img-preview" hidden>
                    <span class="img-label">{{ $hasImage ? 'Gambar baru (menggantikan gambar saat ini)' : 'Pratinjau gambar' }}</span>
                    <div class="img-frame"><img id="img-preview-img" alt="Pratinjau gambar yang dipilih"></div>
                    <div class="img-row">
                        <span id="img-preview-name"></span>
                        <button class="img-clear" type="button" id="img-clear">{{ $hasImage ? 'Batalkan penggantian' : 'Hapus pilihan' }}</button>
                    </div>
                </div>

                <label class="drop" id="drop" for="image">
                    <span class="drop-icon"><svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13V4M6.5 7.5L10 4l3.5 3.5M4 14v2h12v-2"/></svg></span>
                    <strong>{{ $hasImage ? 'Pilih gambar pengganti' : 'Pilih atau seret gambar ke sini' }}</strong>
                    <span>JPG, PNG, atau WEBP, maksimal 2 MB</span>
                    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                </label>

                <p class="size-warn" id="img-error" role="alert" hidden></p>
                <p class="hint">{{ $hasImage ? 'Biarkan kosong untuk mempertahankan gambar saat ini.' : 'Opsional. Artikel boleh disimpan tanpa gambar.' }}</p>

                @error('image')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>
        </section>
    </div>

    <div class="actions-card">
        <button class="btn" type="submit" id="submit-btn">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>
            <span id="submit-text">{{ $editing ? 'Simpan Perubahan' : 'Simpan Artikel' }}</span>
        </button>
        <a class="btn btn--ghost" href="{{ route('articles.index') }}">Batal</a>
    </div>
</form>

@push('styles')
<style>
.crumbs a { color: inherit; text-decoration: none; transition: color var(--t-fast) ease-out; }
.crumbs a:hover { color: var(--forest); }
.crumbs ol { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin: 0; padding: 0; list-style: none; }
.crumbs li { list-style: none; }

.edit-meta { display: flex; flex-wrap: wrap; gap: 8px 10px; margin-top: 22px; }
.meta-chip { display: inline-flex; align-items: center; gap: 8px; max-width: 100%; padding: 6px 14px; font-family: var(--body); font-size: 13px; color: var(--on-dark); background: rgba(250, 248, 243, 0.1); border: 1px solid rgba(250, 248, 243, 0.18); border-radius: 999px; overflow-wrap: anywhere; }
.meta-chip strong { font-family: var(--sans); font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gold); }

.req { color: var(--danger); }
.form-note { margin: 0 0 20px; font-family: var(--body); font-size: 13.5px; color: var(--text-soft); }
.flash > div { flex: 1; min-width: 0; }

.editor { display: grid; grid-template-columns: minmax(0, 1fr) 340px; gap: 24px; align-items: start; }
.editor-main, .editor-side { display: flex; flex-direction: column; gap: 20px; min-width: 0; }

.ecard { min-width: 0; padding: 26px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.ecard-title { display: flex; align-items: center; gap: 12px; margin: 0 0 18px; font-family: var(--serif); font-size: 19px; font-weight: 600; color: var(--emerald); }
.ecard-title .ti { display: flex; flex: none; align-items: center; justify-content: center; width: 34px; height: 34px; color: var(--emerald); background: rgba(185, 154, 100, 0.22); border-radius: 11px; }
.ecard-title .ti svg { width: 18px; height: 18px; }

.ecard .field { min-width: 0; margin: 0 0 20px; padding: 0; border: 0; }
.ecard .field:last-child { margin-bottom: 0; }
.field label, .field legend { display: block; margin: 0 0 10px; padding: 0; font-size: 14px; font-weight: 700; color: var(--emerald); }

.field input[type="text"].title-input { height: 64px; font-family: var(--serif); font-size: 24px; font-weight: 600; line-height: 1.2; }

.field textarea, .field select { display: block; width: 100%; font-family: var(--body); font-size: 16px; color: var(--emerald); background: var(--ivory); border: 1px solid var(--rule); border-radius: 14px; transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out, background var(--t-fast) ease-out; }
.field textarea { min-height: 420px; padding: 18px; line-height: 1.8; resize: vertical; }
.field select { height: 52px; padding: 0 44px 0 16px; cursor: pointer; -webkit-appearance: none; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 18px center; }
.field textarea:hover, .field select:hover { border-color: rgba(24, 60, 54, 0.3); }
.field textarea:focus, .field select:focus { outline: none; background-color: var(--white); border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }
.field textarea.is-invalid, .field select.is-invalid { border-color: var(--danger); background-color: #FFFAF8; }

.slug-line { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin: 12px 0 0; }
.slug-label { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-soft); }
.count { margin: 10px 0 0; font-family: var(--body); font-size: 13px; color: var(--text-soft); }

.status-opts { display: grid; gap: 10px; }
.status-opt { position: relative; display: flex; align-items: center; gap: 14px; margin: 0; padding: 14px 16px; background: var(--ivory); border: 1px solid var(--rule); border-radius: 16px; cursor: pointer; transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out; }
.status-opt:hover { border-color: rgba(24, 60, 54, 0.35); }
.status-opt input, .tag-option input, .drop input { position: absolute; inset: 0; width: 100%; height: 100%; margin: 0; padding: 0; opacity: 0; cursor: pointer; }
.so-dot { display: flex; flex: none; align-items: center; justify-content: center; width: 22px; height: 22px; background: var(--white); border: 2px solid var(--rule); border-radius: 50%; transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out; }
.so-dot::after { content: ""; width: 8px; height: 8px; background: var(--white); border-radius: 50%; transform: scale(0); transition: transform var(--t-fast) var(--ease); }
.so-text { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
.so-text strong { font-size: 14.5px; font-weight: 700; color: var(--emerald); }
.so-text small { font-family: var(--body); font-size: 12.5px; line-height: 1.5; color: var(--text-soft); }
.status-opt:has(input:checked) { background: var(--white); border-color: var(--forest); box-shadow: 0 0 0 3px rgba(55, 107, 92, 0.14); }
.status-opt:has(input:checked) .so-dot { background: var(--forest); border-color: var(--forest); }
.status-opt:has(input:checked) .so-dot::after { transform: scale(1); }
.status-opt:has(input:focus-visible), .tag-option:has(input:focus-visible) { outline: 2px solid var(--gold); outline-offset: 2px; }

.tag-list { display: flex; flex-wrap: wrap; gap: 8px; }
.tag-option { position: relative; display: inline-flex; align-items: center; min-height: 40px; margin: 0; padding: 0 16px; font-size: 13px; font-weight: 700; color: var(--emerald); background: var(--white); border: 1px solid var(--sand); border-radius: 999px; cursor: pointer; overflow-wrap: anywhere; transition: color var(--t-fast) ease-out, background var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.tag-option:hover { border-color: var(--forest); }
.tag-option::before { content: "#"; margin-right: 4px; font-family: var(--serif); font-size: 15px; color: var(--gold); }
.tag-option:has(input:checked) { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }

.field label.status-opt { display: flex; align-items: center; gap: 14px; margin: 0; padding: 14px 16px; font-size: 14px; font-weight: 400; }
.field label.tag-option { display: inline-flex; align-items: center; min-height: 40px; margin: 0; padding: 0 16px; font-size: 13px; font-weight: 700; }
.field label.drop { display: flex; flex-direction: column; align-items: center; gap: 6px; margin: 0; padding: 26px 16px; font-size: 14px; font-weight: 400; }

.drop { position: relative; text-align: center; background: var(--ivory); border: 1.5px dashed rgba(24, 60, 54, 0.3); border-radius: 16px; cursor: pointer; transition: border-color var(--t-fast) ease-out, background var(--t-fast) ease-out; }
.drop:hover, .drop.is-over { background: var(--white); border-color: var(--forest); }
.drop:focus-within { border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }
.drop-icon { display: flex; width: 44px; height: 44px; align-items: center; justify-content: center; color: var(--forest); background: rgba(55, 107, 92, 0.12); border-radius: 14px; }
.drop-icon svg { width: 22px; height: 22px; }
.drop strong { font-size: 14px; font-weight: 700; color: var(--emerald); }
.drop span { font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }

.img-block { margin: 0 0 14px; }
.img-label { display: block; margin: 0 0 8px; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-soft); }
.img-frame { overflow: hidden; background: var(--sand); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 16px; }
.img-frame img { display: block; width: 100%; aspect-ratio: 16 / 10; object-fit: cover; }
.img-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 10px; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.img-row span { min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.img-clear { flex: none; padding: 6px 12px; font-family: var(--sans); font-size: 12.5px; font-weight: 700; color: var(--danger); background: none; border: 1px solid var(--rule); border-radius: 999px; cursor: pointer; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out; }
.img-clear:hover { color: var(--white); background: var(--danger); border-color: var(--danger); }
.size-warn { margin: 10px 0 0; font-family: var(--body); font-size: 13px; font-weight: 500; color: var(--danger); }

.actions-card { grid-column: 1 / -1; display: flex; flex-wrap: wrap; align-items: center; gap: 10px 12px; padding: 20px 26px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.actions-card .btn { height: 50px; padding: 0 28px; }
.actions-card .btn svg { width: 18px; height: 18px; }
.actions-card .btn:disabled { opacity: 0.65; cursor: progress; }

@media (max-width: 1099px) {
    .editor { grid-template-columns: minmax(0, 1fr); }
    .field textarea { min-height: 340px; }
}

@media (max-width: 719px) {
    .ecard { padding: 20px 16px; border-radius: 18px; }
    .field input[type="text"].title-input { height: 58px; font-size: 21px; }
    .field textarea { min-height: 300px; padding: 14px; }
    .actions-card { flex-direction: column; align-items: stretch; padding: 16px; border-radius: 18px; }
    .actions-card .btn { width: 100%; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    var byId = function (id) { return document.getElementById(id); };

    var title = byId('title');
    var slug = byId('slug-preview');
    var content = byId('content');
    var words = byId('word-count');

    var slugify = function (text) {
        return text.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    };

    if (title && slug) {
        var fallback = slug.getAttribute('data-initial') || 'otomatis-dari-judul';
        var syncSlug = function () { slug.textContent = slugify(title.value) || fallback; };

        title.addEventListener('input', syncSlug);
        if (!slug.getAttribute('data-initial') && title.value) { syncSlug(); }
    }

    if (content && words) {
        var countWords = function () {
            var text = content.value.trim();
            words.textContent = (text === '' ? 0 : text.split(/\s+/).length) + ' kata';
        };

        content.addEventListener('input', countWords);
        countWords();
    }

    var file = byId('image');
    var drop = byId('drop');
    var preview = byId('img-preview');
    var previewImg = byId('img-preview-img');
    var previewName = byId('img-preview-name');
    var clearBtn = byId('img-clear');
    var current = byId('img-current');
    var imgError = byId('img-error');

    if (file && preview && previewImg && previewName && clearBtn) {
        var allowed = ['image/jpeg', 'image/png', 'image/webp'];

        var reset = function () {
            file.value = '';
            preview.hidden = true;
            previewImg.removeAttribute('src');
            if (current) { current.hidden = false; }
        };

        var fail = function (message) {
            reset();
            if (imgError) { imgError.textContent = message; imgError.hidden = false; }
        };

        file.addEventListener('change', function () {
            var f = file.files && file.files[0];

            if (imgError) { imgError.hidden = true; }
            if (!f) { reset(); return; }
            if (allowed.indexOf(f.type) === -1) { fail('Format file harus JPG, PNG, atau WEBP.'); return; }
            if (f.size > 2097152) { fail('Ukuran file melebihi 2 MB. Pilih gambar yang lebih kecil.'); return; }

            var reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewName.textContent = f.name + ' (' + (f.size / 1048576).toFixed(2) + ' MB)';
                preview.hidden = false;
                if (current) { current.hidden = true; }
            };
            reader.readAsDataURL(f);
        });

        clearBtn.addEventListener('click', function () {
            reset();
            if (imgError) { imgError.hidden = true; }
        });

        if (drop) {
            ['dragenter', 'dragover'].forEach(function (name) {
                file.addEventListener(name, function () { drop.classList.add('is-over'); });
            });
            ['dragleave', 'drop', 'change'].forEach(function (name) {
                file.addEventListener(name, function () { drop.classList.remove('is-over'); });
            });
        }
    }

    var form = byId('article-form');
    var submitBtn = byId('submit-btn');
    var submitText = byId('submit-text');

    if (form && submitBtn && submitText) {
        var submitLabel = submitText.textContent;

        form.addEventListener('submit', function () {
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan…';
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                submitBtn.disabled = false;
                submitText.textContent = submitLabel;
            }
        });
    }

    var firstInvalid = document.querySelector('.is-invalid');
    if (firstInvalid) { firstInvalid.focus(); }
})();
</script>
@endpush