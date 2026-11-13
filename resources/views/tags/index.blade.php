@extends('layouts.dashboard')

@section('title', 'Tag')

@push('styles')
<style>
.panel {
    overflow: hidden;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.table { width: 100%; border-collapse: collapse; }

.table th {
    padding: 16px 24px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-align: left;
    text-transform: uppercase;
    color: var(--text-soft);
    background: rgba(231, 224, 210, 0.45);
    border-bottom: 1px solid var(--rule);
}

.table th.col-actions { text-align: right; }

.table td {
    padding: 18px 24px;
    vertical-align: middle;
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}

.table tbody tr:last-child td { border-bottom: 0; }
.table tbody tr { transition: background var(--t-fast) ease-out; }
.table tbody tr:hover { background: rgba(231, 224, 210, 0.3); }
.table tbody tr.is-hit { animation: row-hit 1800ms ease-out both; }

.cell-name { display: flex; align-items: center; gap: 14px; min-width: 0; }

.cell-mark {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    font-family: var(--serif);
    font-size: 18px;
    font-weight: 600;
    color: var(--emerald);
    background: var(--sand);
    border-radius: 12px;
}

.cell-title {
    font-family: var(--serif);
    font-size: 19px;
    font-weight: 600;
    line-height: 1.3;
    color: var(--emerald);
    overflow-wrap: anywhere;
}

.col-actions-cell .act-row { justify-content: flex-end; }

body.mdl-lock { overflow: hidden; }

.mdl {
    width: min(460px, calc(100vw - 24px));
    max-width: calc(100vw - 24px);
    max-height: calc(100vh - 24px);
    max-height: calc(100dvh - 24px);
    padding: 0;
    margin: auto;
    overflow: auto;
    color: var(--text);
    background: var(--white);
    border: 0;
    border-radius: 26px;
    box-shadow: 0 30px 70px -24px rgba(24, 60, 54, 0.5);
}

.mdl[open] { animation: pop 300ms var(--ease) both; }

.mdl::backdrop {
    background: rgba(24, 60, 54, 0.38);
    -webkit-backdrop-filter: blur(2px);
    backdrop-filter: blur(2px);
    animation: mdl-fade 250ms ease-out both;
}

.mdl--sm { width: min(420px, calc(100vw - 24px)); }

.mdl-wrap { padding: 28px 28px 24px; }

.mdl-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; margin-bottom: 22px; }

.mdl-eyebrow {
    display: block;
    margin-bottom: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--gold);
}

.mdl-title {
    margin: 0;
    font-family: var(--serif);
    font-size: 26px;
    font-weight: 600;
    line-height: 1.2;
    color: var(--emerald);
}

.mdl-close {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    margin: -6px -8px 0 0;
    padding: 0;
    color: var(--text-soft);
    cursor: pointer;
    background: transparent;
    border: 0;
    border-radius: 50%;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out;
}

.mdl-close:hover { color: var(--emerald); background: var(--sand); }
.mdl-close:focus-visible { outline: 2px solid var(--gold); outline-offset: 2px; }
.mdl-close svg { width: 18px; height: 18px; }

.mdl-alert {
    margin: 0 0 18px;
    padding: 12px 14px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.6;
    color: var(--danger);
    background: #FFFAF8;
    border: 1px solid rgba(163, 57, 44, 0.25);
    border-left: 4px solid var(--danger);
    border-radius: 12px;
}

.mdl-slug { font-weight: 600; color: var(--forest); overflow-wrap: anywhere; }

.mdl-actions { display: flex; justify-content: flex-end; flex-wrap: wrap; gap: 10px; margin-top: 26px; }
.mdl-actions .btn:disabled { cursor: not-allowed; opacity: 0.7; }

.mdl-text { margin: 0; font-family: var(--body); font-size: 15px; line-height: 1.7; color: var(--text-soft); }
.mdl-text strong { font-weight: 600; color: var(--text); overflow-wrap: anywhere; }

.mdl-spin {
    display: none;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.4);
    border-top-color: var(--white);
    border-radius: 50%;
    animation: mdl-rot 700ms linear infinite;
}

.is-busy .mdl-spin { display: inline-block; }

.toasts {
    position: fixed;
    right: 20px;
    bottom: 20px;
    z-index: 200;
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: min(380px, calc(100vw - 32px));
    pointer-events: none;
}

.toast {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    font-family: var(--body);
    font-size: 14px;
    line-height: 1.55;
    color: var(--emerald);
    pointer-events: auto;
    background: var(--white);
    border: 1px solid var(--rule);
    border-left: 4px solid var(--forest);
    border-radius: 14px;
    box-shadow: 0 18px 40px -18px rgba(24, 60, 54, 0.45);
    animation: rise 350ms var(--ease) both;
}

.toast svg { flex: none; width: 20px; height: 20px; margin-top: 1px; color: var(--forest); }
.toast p { flex: 1; min-width: 0; margin: 0; overflow-wrap: anywhere; }
.toast--error { color: var(--danger); background: #FFFAF8; border-left-color: var(--danger); }
.toast--error svg { color: var(--danger); }
.toast.is-leaving { opacity: 0; transform: translateY(8px); transition: opacity 250ms ease-out, transform 250ms ease-out; }

@keyframes mdl-fade { from { opacity: 0; } to { opacity: 1; } }
@keyframes mdl-rot { to { transform: rotate(360deg); } }
@keyframes row-hit { 0%, 55% { background: rgba(185, 154, 100, 0.28); } 100% { background: transparent; } }

@media (max-width: 719px) {
    .table thead { display: none; }
    .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

    .table tbody tr {
        padding: 18px 16px 16px;
        border-bottom: 1px solid rgba(24, 60, 54, 0.08);
    }

    .table tbody tr:last-child { border-bottom: 0; }
    .table td { padding: 0; border: 0; }
    .table td + td { margin-top: 12px; }

    .table td[data-label]::before {
        content: attr(data-label);
        display: block;
        margin-bottom: 6px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--text-soft);
    }

    .col-actions-cell .act-row { justify-content: stretch; }
    .col-actions-cell .act-row > *, .col-actions-cell .act { flex: 1; justify-content: center; }
    .col-actions-cell .inline-form { display: flex; }

    .mdl-wrap { padding: 22px 18px 18px; }
    .mdl-title { font-size: 23px; }
    .mdl-actions { flex-direction: column-reverse; }
    .mdl-actions .btn { width: 100%; justify-content: center; }
    .toasts { right: 16px; bottom: 16px; left: 16px; width: auto; }
}
</style>
@endpush

@section('content')
                <ol class="crumbs" aria-label="Breadcrumb"><li>Admin</li><li>Tag</li></ol>
                    <section class="hero" aria-labelledby="page-title">
                        <div class="hero-inner">
                            <span class="hero-label">TAG</span>
                            <h1 class="hero-title" id="page-title">Kelola Tag</h1>
                            <p class="hero-lead">Tag membantu menandai topik artikel secara lebih spesifik dan mempermudah pencarian.</p>
                            <div class="hero-actions">
                                <a class="btn btn--gold" href="{{ route('tags.create') }}" data-open-create id="open-create"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tambah Tag</a>
                                <span class="hero-stat" id="hero-stat"><strong>{{ $tags->count() }}</strong> tag terdaftar</span>
                            </div>
                        </div>
                    </section>

                    @if (session('success'))
                        <div class="flash" role="status">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M6.5 10.5l2.5 2.5 4.5-5"/></svg>
                            <p>{{ session('success') }}</p>
                            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="flash flash--error" role="alert">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
                            <p>{{ session('error') }}</p>
                            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
                        </div>
                    @endif

                    <div id="tg-area">
                    @if ($tags->count())
                        <div class="toolbar">
                            <div class="search">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                            <label class="sr-only" for="filter">Cari tag</label>
                            <input id="filter" type="search" placeholder="Cari nama atau slug tag" data-noun="tag" autocomplete="off">
                        </div>
                            <p class="result-info" id="result-info" aria-live="polite">Menampilkan <strong>{{ $tags->count() }}</strong> dari {{ $tags->count() }} tag</p>
                        </div>

                        <div class="panel" id="results">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Tag</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col" class="col-actions">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr data-id="{{ $tag->id }}" data-search="{{ \Illuminate\Support\Str::lower($tag->name . ' ' . $tag->slug) }}">
                                            <td data-label="Nama Tag">
                                                <div class="cell-name">
                                                    <span class="cell-mark" aria-hidden="true">#</span>
                                                    <span class="cell-title">{{ $tag->name }}</span>
                                                </div>
                                            </td>
                                            <td data-label="Slug">
                                                <span class="slug">{{ $tag->slug }}</span>
                                            </td>
                                            <td class="col-actions-cell">
                                                <div class="act-row">
                                                    <a class="act act--edit" href="{{ route('tags.edit', $tag) }}" data-edit data-name="{{ $tag->name }}" data-action="{{ route('tags.update', $tag) }}" aria-label="Edit tag {{ $tag->name }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 2.5l2.5 2.5L5.5 13H3v-2.5z"/></svg> Edit</a>
                                                    <form class="inline-form" action="{{ route('tags.destroy', $tag) }}" method="POST" data-confirm data-kind="tag" data-name="{{ $tag->name }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="act act--delete" type="submit" aria-label="Hapus tag {{ $tag->name }}"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/></svg> Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="no-results" id="no-results" hidden>
                            <strong>Tag tidak ditemukan.</strong>
                            <p>Coba kata kunci lain atau hapus pencarian untuk melihat semua tag.</p>
                        </div>
                    @else
                        <div class="empty">
                            <strong>Belum ada tag.</strong>
                            <p>Tambahkan tag pertama untuk menandai topik artikel secara lebih spesifik.</p>
                            <a class="btn" href="{{ route('tags.create') }}" data-open-create><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg> Tambah Tag Pertama</a>
                        </div>
                    @endif
                    </div>

                    <dialog class="mdl" id="tg-modal" aria-labelledby="tg-title">
                        <div class="mdl-wrap">
                            <div class="mdl-head">
                                <div>
                                    <span class="mdl-eyebrow" id="tg-eyebrow">Tag baru</span>
                                    <h2 class="mdl-title" id="tg-title">Tambah Tag</h2>
                                </div>
                                <button class="mdl-close" type="button" id="tg-close" aria-label="Tutup"><svg viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 4l10 10M14 4L4 14"/></svg></button>
                            </div>

                            <form id="tg-form" action="{{ route('tags.store') }}" method="POST" novalidate>
                                @csrf

                                <p class="mdl-alert" id="tg-alert" role="alert" hidden></p>

                                <div class="field">
                                    <label for="tg-name">Nama Tag</label>
                                    <input type="text" id="tg-name" name="name" maxlength="100" required autocomplete="off" aria-describedby="tg-hint">
                                    <p class="field-error" id="tg-error" hidden></p>
                                    <p class="hint" id="tg-hint">Slug: <span class="mdl-slug" id="tg-slug">-</span></p>
                                </div>

                                <div class="mdl-actions">
                                    <button class="btn btn--ghost" type="button" id="tg-cancel">Batal</button>
                                    <button class="btn" type="submit" id="tg-submit"><span class="mdl-spin" aria-hidden="true"></span><span id="tg-submit-text">Simpan</span></button>
                                </div>
                            </form>
                        </div>
                    </dialog>

                    <dialog class="mdl mdl--sm" id="confirm-dialog" aria-labelledby="dlg-title" aria-describedby="dlg-text">
                        <div class="mdl-wrap">
                            <div class="dialog-icon"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/></svg></div>
                            <h2 class="mdl-title" id="dlg-title">Hapus tag?</h2>
                            <p class="mdl-text" id="dlg-text" style="margin-top: 8px;">&ldquo;<strong id="dlg-name"></strong>&rdquo; akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                            <div class="mdl-actions">
                                <button class="btn btn--ghost" type="button" id="dlg-cancel">Batal</button>
                                <button class="btn btn--danger" type="button" id="dlg-confirm"><span class="mdl-spin" aria-hidden="true"></span><span id="dlg-confirm-text">Hapus</span></button>
                            </div>
                        </div>
                    </dialog>

                    <div class="toasts" id="toasts" aria-live="polite"></div>
@endsection

@push('scripts')
<script>
(function () {
    var area = document.getElementById('tg-area');
    var modal = document.getElementById('tg-modal');
    var form = document.getElementById('tg-form');
    var nameInput = document.getElementById('tg-name');
    var errorEl = document.getElementById('tg-error');
    var alertEl = document.getElementById('tg-alert');
    var slugEl = document.getElementById('tg-slug');
    var titleEl = document.getElementById('tg-title');
    var eyebrowEl = document.getElementById('tg-eyebrow');
    var submitBtn = document.getElementById('tg-submit');
    var submitText = document.getElementById('tg-submit-text');
    var cancelBtn = document.getElementById('tg-cancel');
    var closeBtn = document.getElementById('tg-close');
    var confirmDlg = document.getElementById('confirm-dialog');
    var dlgName = document.getElementById('dlg-name');
    var dlgConfirm = document.getElementById('dlg-confirm');
    var dlgConfirmText = document.getElementById('dlg-confirm-text');
    var dlgCancel = document.getElementById('dlg-cancel');
    var toasts = document.getElementById('toasts');

    var storeUrl = form.getAttribute('action');
    var indexUrl = '{{ route('tags.index') }}';
    var mode = 'create';
    var editUrl = null;
    var pendingDelete = null;
    var opener = null;
    var busy = false;

    if (typeof modal.showModal !== 'function') { return; }

    var slugify = function (value) {
        return value
            .normalize('NFD')
            .replace(/[̀-ͯ]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    };

    var toast = function (message, type) {
        var el = document.createElement('div');
        el.className = 'toast' + (type === 'error' ? ' toast--error' : '');
        el.setAttribute('role', type === 'error' ? 'alert' : 'status');

        var icon = type === 'error'
            ? '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>'
            : '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M6.5 10.5l2.5 2.5 4.5-5"/></svg>';

        el.innerHTML = icon;
        var p = document.createElement('p');
        p.textContent = message;
        el.appendChild(p);
        toasts.appendChild(el);

        window.setTimeout(function () {
            el.classList.add('is-leaving');
            window.setTimeout(function () { if (el.parentNode) { el.parentNode.removeChild(el); } }, 280);
        }, type === 'error' ? 6000 : 4000);
    };

    var lockScroll = function (on) { document.body.classList.toggle('mdl-lock', on); };

    var setBusy = function (value, btn, label, busyLabel, labelEl) {
        busy = value;
        btn.disabled = value;
        btn.classList.toggle('is-busy', value);
        btn.setAttribute('aria-busy', value ? 'true' : 'false');
        labelEl.textContent = value ? busyLabel : label;
    };

    var send = function (url, method, token, payload) {
        var headers = {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token || ''
        };
        var options = { method: method, headers: headers, credentials: 'same-origin' };

        if (payload) {
            headers['Content-Type'] = 'application/json';
            options.body = JSON.stringify(payload);
        }

        return fetch(url, options).then(function (res) {
            var type = res.headers.get('content-type') || '';
            var isJson = type.indexOf('json') !== -1;

            if (!isJson) {
                return { ok: false, status: res.redirected ? 401 : res.status, data: null, invalid: true };
            }

            return res.json().then(function (data) {
                return { ok: res.ok, status: res.status, data: data };
            }, function () {
                return { ok: false, status: res.status, data: null, invalid: true };
            });
        });
    };

    var describe = function (result) {
        if (result.status === 419) { return 'Sesi Anda telah berakhir. Muat ulang halaman lalu coba lagi.'; }
        if (result.status === 401 || (result.invalid && result.status === 401)) { return 'Anda perlu masuk kembali untuk melanjutkan.'; }
        if (result.status === 403) { return 'Anda tidak memiliki izin untuk melakukan tindakan ini.'; }
        if (result.status === 404) { return 'Tag tidak ditemukan. Mungkin sudah dihapus.'; }
        if (result.status === 429) { return 'Terlalu banyak permintaan. Coba lagi sebentar lagi.'; }
        if (result.status >= 500) { return 'Terjadi kesalahan pada server. Coba lagi nanti.'; }
        if (result.data && result.data.message) { return result.data.message; }
        return 'Permintaan tidak dapat diproses. Coba lagi.';
    };

    var applyFilter = function () {
        var input = document.getElementById('filter');
        if (!input) { return; }

        var q = input.value.trim().toLowerCase();
        var items = [].slice.call(area.querySelectorAll('[data-search]'));
        var info = document.getElementById('result-info');
        var none = document.getElementById('no-results');
        var wrapper = document.getElementById('results');
        var shown = 0;

        items.forEach(function (el) {
            var match = !q || el.getAttribute('data-search').indexOf(q) !== -1;
            el.hidden = !match;
            if (match) { shown++; }
        });

        info.innerHTML = 'Menampilkan <strong>' + shown + '</strong> dari ' + items.length + ' ' + input.getAttribute('data-noun');
        if (none) { none.hidden = shown !== 0; }
        if (wrapper) { wrapper.hidden = shown === 0; }
    };

    var refreshList = function (highlightId) {
        var current = document.getElementById('filter');
        var query = current ? current.value : '';

        return fetch(indexUrl, {
            headers: { 'Accept': 'text/html', 'X-Requested-With': 'XMLHttpRequest' },
            credentials: 'same-origin'
        }).then(function (res) {
            if (!res.ok || res.redirected) { throw new Error('refresh'); }
            return res.text();
        }).then(function (html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            var fresh = doc.getElementById('tg-area');
            var freshStat = doc.getElementById('hero-stat');
            if (!fresh) { throw new Error('refresh'); }

            area.innerHTML = fresh.innerHTML;
            if (freshStat) { document.getElementById('hero-stat').innerHTML = freshStat.innerHTML; }

            var input = document.getElementById('filter');
            if (input) { input.value = query; }
            applyFilter();

            if (highlightId) {
                var row = area.querySelector('tr[data-id="' + highlightId + '"]');
                if (row) {
                    if (row.hidden && input) {
                        input.value = '';
                        applyFilter();
                    }
                    row.classList.add('is-hit');
                    row.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            }
            return true;
        }).catch(function () {
            toast('Perubahan tersimpan, tetapi daftar gagal dimuat ulang. Muat ulang halaman untuk melihat data terbaru.', 'error');
            return false;
        });
    };

    var clearErrors = function () {
        errorEl.hidden = true;
        errorEl.textContent = '';
        alertEl.hidden = true;
        alertEl.textContent = '';
        nameInput.classList.remove('is-invalid');
        nameInput.removeAttribute('aria-invalid');
        nameInput.setAttribute('aria-describedby', 'tg-hint');
    };

    var showFieldError = function (message) {
        errorEl.textContent = message;
        errorEl.hidden = false;
        nameInput.classList.add('is-invalid');
        nameInput.setAttribute('aria-invalid', 'true');
        nameInput.setAttribute('aria-describedby', 'tg-hint tg-error');
        nameInput.focus();
    };

    var updateSlug = function () {
        slugEl.textContent = slugify(nameInput.value.trim()) || '-';
    };

    var openModal = function (config, trigger) {
        mode = config.mode;
        editUrl = config.url || null;
        opener = trigger || null;
        clearErrors();
        nameInput.value = config.name || '';
        updateSlug();
        titleEl.textContent = config.title;
        eyebrowEl.textContent = config.eyebrow;
        submitText.textContent = config.submit;
        submitText.setAttribute('data-label', config.submit);
        modal.showModal();
        lockScroll(true);

        window.requestAnimationFrame(function () {
            nameInput.focus();
            nameInput.select();
        });
    };

    var closeModal = function () {
        if (busy) { return; }
        if (modal.open) { modal.close(); }
    };

    modal.addEventListener('close', function () {
        lockScroll(false);
        var target = opener && document.body.contains(opener) ? opener : document.getElementById('open-create');
        opener = null;
        if (target) { target.focus(); }
    });

    modal.addEventListener('cancel', function (event) { if (busy) { event.preventDefault(); } });
    modal.addEventListener('click', function (event) { if (event.target === modal) { closeModal(); } });
    cancelBtn.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);

    nameInput.addEventListener('input', function () {
        updateSlug();
        if (nameInput.classList.contains('is-invalid')) { clearErrors(); }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (busy) { return; }

        clearErrors();

        var url = mode === 'edit' ? editUrl : storeUrl;
        var method = mode === 'edit' ? 'PUT' : 'POST';
        var token = form.querySelector('input[name="_token"]').value;
        var label = submitText.getAttribute('data-label') || 'Simpan';

        setBusy(true, submitBtn, label, 'Menyimpan...', submitText);

        send(url, method, token, { name: nameInput.value }).then(function (result) {
            if (result.ok) {
                var id = result.data && result.data.tag ? result.data.tag.id : null;
                var message = result.data && result.data.message ? result.data.message : 'Tag berhasil disimpan.';
                setBusy(false, submitBtn, label, 'Menyimpan...', submitText);
                modal.close();
                toast(message, 'success');
                return refreshList(id);
            }

            setBusy(false, submitBtn, label, 'Menyimpan...', submitText);

            if (result.status === 422 && result.data && result.data.errors) {
                var errors = result.data.errors;
                if (errors.name && errors.name.length) { showFieldError(errors.name[0]); return; }
                var first = Object.keys(errors)[0];
                alertEl.textContent = first ? errors[first][0] : describe(result);
                alertEl.hidden = false;
                return;
            }

            alertEl.textContent = describe(result);
            alertEl.hidden = false;

            if (result.status === 404) { refreshList(); }
        }).catch(function () {
            setBusy(false, submitBtn, label, 'Menyimpan...', submitText);
            alertEl.textContent = 'Koneksi bermasalah. Periksa jaringan Anda lalu coba lagi.';
            alertEl.hidden = false;
        });
    });

    var closeConfirm = function () {
        if (busy) { return; }
        if (confirmDlg.open) { confirmDlg.close(); }
    };

    confirmDlg.addEventListener('close', function () {
        lockScroll(false);
        pendingDelete = null;
        var target = opener && document.body.contains(opener) ? opener : document.getElementById('open-create');
        opener = null;
        if (target) { target.focus(); }
    });

    confirmDlg.addEventListener('cancel', function (event) { if (busy) { event.preventDefault(); } });
    confirmDlg.addEventListener('click', function (event) { if (event.target === confirmDlg) { closeConfirm(); } });
    dlgCancel.addEventListener('click', closeConfirm);

    dlgConfirm.addEventListener('click', function () {
        if (busy || !pendingDelete) { return; }

        var target = pendingDelete;
        var token = target.form.querySelector('input[name="_token"]').value;

        setBusy(true, dlgConfirm, 'Hapus', 'Menghapus...', dlgConfirmText);

        send(target.form.getAttribute('action'), 'DELETE', token).then(function (result) {
            setBusy(false, dlgConfirm, 'Hapus', 'Menghapus...', dlgConfirmText);

            if (result.ok) {
                confirmDlg.close();
                toast(result.data && result.data.message ? result.data.message : 'Tag berhasil dihapus.', 'success');
                return refreshList();
            }

            confirmDlg.close();
            toast(describe(result), 'error');
            if (result.status === 404) { refreshList(); }
        }).catch(function () {
            setBusy(false, dlgConfirm, 'Hapus', 'Menghapus...', dlgConfirmText);
            confirmDlg.close();
            toast('Koneksi bermasalah. Tag belum dihapus, coba lagi.', 'error');
        });
    });

    var modified = function (event) { return event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button === 1; };

    document.addEventListener('click', function (event) {
        var createBtn = event.target.closest('[data-open-create]');
        if (createBtn && !modified(event)) {
            event.preventDefault();
            if (busy) { return; }
            openModal({ mode: 'create', title: 'Tambah Tag', eyebrow: 'Tag baru', submit: 'Simpan', name: '' }, createBtn);
            return;
        }

        var editBtn = event.target.closest('[data-edit]');
        if (editBtn && !modified(event)) {
            event.preventDefault();
            if (busy) { return; }
            openModal({
                mode: 'edit',
                title: 'Edit Tag',
                eyebrow: 'Ubah tag',
                submit: 'Simpan Perubahan',
                name: editBtn.getAttribute('data-name'),
                url: editBtn.getAttribute('data-action')
            }, editBtn);
        }
    });

    document.addEventListener('submit', function (event) {
        var target = event.target;
        if (!target.hasAttribute || !target.hasAttribute('data-confirm')) { return; }

        event.preventDefault();
        if (busy) { return; }

        pendingDelete = { form: target };
        opener = target.querySelector('button');
        dlgName.textContent = target.getAttribute('data-name');
        confirmDlg.showModal();
        lockScroll(true);
        dlgCancel.focus();
    });

    document.addEventListener('input', function (event) {
        if (event.target && event.target.id === 'filter') { applyFilter(); }
    });
})();
</script>
@endpush