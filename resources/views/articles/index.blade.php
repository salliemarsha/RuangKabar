@extends('layouts.dashboard')

@section('title', 'Kelola Artikel')

@section('content')
    @php
        $mUser = auth()->user();
        $mIsAdmin = $mUser->role === 'admin';
        $mDash = $mIsAdmin ? '/admin/dashboard' : '/penulis/dashboard';
        $mSearch = trim((string) ($search ?? request('search')));
        $mBase = route('articles.index', ['kelola' => 1]);
        $canManage = function ($row) use ($mUser, $mIsAdmin) {
            return $mIsAdmin || ($mUser->role === 'penulis' && (int) $row->user_id === (int) $mUser->id);
        };
    @endphp

    <nav class="crumbs" aria-label="Breadcrumb">
        <ol>
            <li><a href="{{ $mDash }}">{{ $mIsAdmin ? 'Admin' : 'Penulis' }}</a></li>
            <li aria-current="page">Artikel</li>
        </ol>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="hero-inner">
            <span class="hero-label">ARTIKEL</span>
            <h1 class="hero-title" id="page-title">Kelola Artikel</h1>
            <p class="hero-lead">Tulis, tinjau, dan atur seluruh artikel RuangKabar dari satu tempat.</p>

            <div class="hero-actions">
                <a class="btn btn--gold" href="{{ route('articles.create') }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg>
                    Tambah Artikel
                </a>
                <span class="hero-stat"><strong>{{ number_format($articles->total(), 0, ',', '.') }}</strong> {{ $mSearch !== '' ? 'artikel ditemukan' : 'artikel terdaftar' }}</span>
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

    <div class="toolbar">
        <form class="toolbar-search" action="{{ route('articles.index') }}" method="GET" role="search">
            <input type="hidden" name="kelola" value="1">

            <div class="search">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                <label class="sr-only" for="filter">Cari artikel</label>
                <input id="filter" type="search" name="search" value="{{ $mSearch }}" placeholder="Cari judul atau isi artikel" autocomplete="off">
            </div>

            <button class="btn btn--sm" type="submit">Cari</button>

            @if ($mSearch !== '')
                <a class="btn btn--sm btn--ghost" href="{{ $mBase }}">Reset</a>
            @endif
        </form>

        @if ($articles->count())
            <p class="result-info" aria-live="polite">
                Menampilkan <strong>{{ $articles->firstItem() }}&ndash;{{ $articles->lastItem() }}</strong> dari <strong>{{ $articles->total() }}</strong> artikel
            </p>
        @endif
    </div>

    @if ($articles->count())
        <div class="panel">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-title" scope="col">Artikel</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal</th>
                            <th class="col-actions" scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($articles as $row)
                            <tr>
                                <td class="col-title" data-label="Artikel">
                                    <div class="cell-article">
                                        <span class="thumb">
                                            @if ($row->image)
                                                <img src="{{ asset('storage/' . $row->image) }}" alt="" loading="lazy">
                                            @else
                                                <span class="thumb-ph" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($row->title, 0, 1)) }}</span>
                                            @endif
                                        </span>

                                        <div class="cell-text">
                                            <a class="cell-title" href="{{ route('articles.show', $row) }}">{{ $row->title }}</a>
                                            <span class="slug">{{ $row->slug }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td data-label="Kategori">
                                    <span class="cat-pill">{{ $row->category->name ?? '-' }}</span>
                                </td>

                                <td data-label="Penulis">{{ $row->user->name ?? '-' }}</td>

                                <td data-label="Status">
                                    @if ($row->status === 'published')
                                        <span class="badge badge--published">Published</span>
                                    @elseif ($row->status === 'draft')
                                        <span class="badge badge--draft">Draft</span>
                                    @else
                                        <span class="badge badge--other">{{ ucfirst($row->status) }}</span>
                                    @endif
                                </td>

                                <td class="cell-date" data-label="Tanggal">
                                    @if ($row->created_at)
                                        <time datetime="{{ $row->created_at->toDateString() }}">{{ $row->created_at->locale('id')->translatedFormat('d M Y') }}</time>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="col-actions-cell">
                                    <div class="act-row">
                                        <a class="act" href="{{ route('articles.show', $row) }}" title="Lihat" aria-label="Lihat artikel {{ $row->title }}">
                                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.5 8S4 3.5 8 3.5 14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8z"/><circle cx="8" cy="8" r="2"/></svg>
                                            <span class="act__t">Lihat</span>
                                        </a>

                                        @if ($canManage($row))
                                            <a class="act act--edit" href="{{ route('articles.edit', $row) }}" title="Edit" aria-label="Edit artikel {{ $row->title }}">
                                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 2.5l2.5 2.5L5.5 13H3v-2.5z"/></svg>
                                                <span class="act__t">Edit</span>
                                            </a>

                                            <form class="inline-form" action="{{ route('articles.destroy', $row) }}" method="POST" data-confirm data-name="{{ $row->title }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="act act--delete" type="submit" title="Hapus" aria-label="Hapus artikel {{ $row->title }}">
                                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/></svg>
                                                    <span class="act__t">Hapus</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($articles->hasPages())
            @php
                $current = $articles->currentPage();
                $last = $articles->lastPage();
                $window = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)->values();
                $previous = null;
            @endphp

            <nav class="pager" aria-label="Navigasi halaman">
                @if ($articles->onFirstPage())
                    <span class="pager-btn is-disabled" aria-disabled="true"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</span>
                @else
                    <a class="pager-btn" href="{{ $articles->previousPageUrl() }}" rel="prev"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</a>
                @endif

                <ul class="pager-pages">
                    @foreach ($window as $page)
                        @if ($previous !== null && $page - $previous > 1)
                            <li class="pager-gap" aria-hidden="true">&hellip;</li>
                        @endif

                        <li>
                            @if ($page === $current)
                                <span class="pager-num is-current" aria-current="page">{{ $page }}</span>
                            @else
                                <a class="pager-num" href="{{ $articles->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                            @endif
                        </li>

                        @php $previous = $page; @endphp
                    @endforeach
                </ul>

                @if ($articles->hasMorePages())
                    <a class="pager-btn" href="{{ $articles->nextPageUrl() }}" rel="next">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></a>
                @else
                    <span class="pager-btn is-disabled" aria-disabled="true">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></span>
                @endif

                <span class="pager-status">Halaman {{ $current }} dari {{ $last }}</span>
            </nav>
        @endif
    @elseif ($mSearch !== '')
        <div class="no-results">
            <strong>Artikel tidak ditemukan.</strong>
            <p>Tidak ada artikel yang cocok dengan &ldquo;{{ $mSearch }}&rdquo;. Coba kata kunci lain atau reset pencarian.</p>
            <a class="btn btn--ghost" href="{{ $mBase }}">Reset pencarian</a>
        </div>
    @else
        <div class="empty">
            <strong>Belum ada artikel.</strong>
            <p>Tulis artikel pertama agar tampil di portal dan dapat dibaca pembaca.</p>
            <a class="btn" href="{{ route('articles.create') }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M8 3v10M3 8h10"/></svg>
                Tambah Artikel Pertama
            </a>
        </div>
    @endif

    <dialog class="dialog" id="confirm-dialog" aria-labelledby="dlg-title" aria-describedby="dlg-text">
        <div class="dialog-icon"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/></svg></div>
        <h2 id="dlg-title">Hapus artikel?</h2>
        <p id="dlg-text">&ldquo;<strong id="dlg-name"></strong>&rdquo; akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" id="dlg-cancel">Batal</button>
            <button class="btn btn--danger" type="button" id="dlg-confirm">Ya, Hapus</button>
        </div>
    </dialog>
@endsection

@push('styles')
<style>
.crumbs a { color: inherit; text-decoration: none; transition: color var(--t-fast) ease-out; }
.crumbs a:hover { color: var(--forest); }

.crumbs ol {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.crumbs li {
    list-style: none;
}

.toolbar-search { display: flex; flex: 1 1 380px; align-items: center; gap: 10px; min-width: 0; }
.toolbar-search .search { flex: 1 1 auto; max-width: 380px; }

.btn--sm { height: 44px; padding: 0 20px; font-size: 13px; }

.panel {
    overflow: hidden;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}

.table-wrap { overflow-x: auto; }

.table { width: 100%; min-width: 920px; border-collapse: collapse; }

.table th {
    padding: 16px 20px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-align: left;
    text-transform: uppercase;
    white-space: nowrap;
    color: var(--text-soft);
    background: rgba(231, 224, 210, 0.45);
    border-bottom: 1px solid var(--rule);
}

.table td {
    padding: 16px 20px;
    vertical-align: middle;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text);
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}

.table th:first-child, .table td:first-child { padding-left: 24px; }
.table th:last-child, .table td:last-child { padding-right: 24px; }

.table tbody tr:last-child td { border-bottom: 0; }
.table tbody tr { transition: background var(--t-fast) ease-out; }
.table tbody tr:hover { background: rgba(231, 224, 210, 0.3); }

.col-title { width: 38%; }
.col-actions { width: 156px; text-align: right; }

.cell-article { display: flex; align-items: center; gap: 14px; min-width: 0; }

.thumb {
    display: flex;
    flex: none;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 44px;
    overflow: hidden;
    background: var(--sand);
    border-radius: 10px;
}

.thumb img { display: block; width: 100%; height: 100%; object-fit: cover; }

.thumb-ph { font-family: var(--serif); font-size: 18px; font-weight: 600; color: var(--emerald); }

.cell-text { display: flex; flex-direction: column; align-items: flex-start; gap: 6px; min-width: 0; }

.cell-title {
    display: -webkit-box;
    overflow: hidden;
    font-family: var(--sans);
    font-size: 14.5px;
    font-weight: 700;
    line-height: 1.4;
    color: var(--emerald);
    text-decoration: none;
    overflow-wrap: anywhere;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    transition: color var(--t-fast) ease-out;
}

.cell-title:hover { color: var(--forest); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }

.cell-text .slug { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 11.5px; }

.cat-pill {
    display: inline-block;
    padding: 4px 12px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 600;
    white-space: nowrap;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 999px;
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 5px 12px;
    font-family: var(--sans);
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    border-radius: 999px;
}

.badge::before { content: ""; width: 6px; height: 6px; background: currentColor; border-radius: 50%; }

.badge--published { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.badge--draft { color: #7A6130; background: rgba(185, 154, 100, 0.24); }
.badge--other { color: var(--text-soft); background: rgba(104, 115, 110, 0.14); }

.cell-date { white-space: nowrap; color: var(--text-soft); }

.col-actions-cell .act-row { justify-content: flex-end; }

.table .act { justify-content: center; width: 38px; padding: 0; }
.table .act__t {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
}

.pager {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 12px 10px;
    margin-top: 32px;
}

.pager-pages { display: flex; align-items: center; gap: 6px; margin: 0; padding: 0; list-style: none; }

.pager-btn,
.pager-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 44px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 700;
    color: var(--emerald);
    text-decoration: none;
    background: var(--white);
    border: 1px solid var(--rule);
    border-radius: 999px;
    transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out;
}

.pager-btn { padding: 0 20px; }
.pager-num { min-width: 44px; padding: 0 8px; }

a.pager-btn:hover,
a.pager-num:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }

.pager-num.is-current { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }
.pager-btn.is-disabled { color: var(--text-soft); background: transparent; opacity: 0.6; }
.pager-gap { padding: 0 4px; color: var(--text-soft); }
.pager-status { display: none; font-family: var(--body); font-size: 14px; color: var(--text-soft); }

.no-results .btn { margin-top: 22px; }

@media (max-width: 719px) {
    .toolbar-search { flex-basis: auto; width: 100%; flex-wrap: wrap; }
    .toolbar-search .search { flex: 1 1 100%; max-width: none; }
    .toolbar-search .btn { flex: 1 1 0; }

    .table { min-width: 0; }
    .table thead { display: none; }
    .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

    .table tbody tr { padding: 18px 16px 16px; border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
    .table tbody tr:last-child { border-bottom: 0; }
    .table td, .table th:first-child, .table td:first-child, .table th:last-child, .table td:last-child { padding: 0; border: 0; }
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

    .table td.col-title::before { display: none; }

    .col-actions-cell .act-row { justify-content: stretch; }
    .col-actions-cell .act-row > *, .table .act { flex: 1; width: auto; padding: 0 14px; justify-content: center; }
    .col-actions-cell .inline-form { display: flex; }

    .table .act__t { position: static; width: auto; height: auto; margin: 0; overflow: visible; clip: auto; }

    .pager { margin-top: 24px; }
    .pager-pages { display: none; }
    .pager-status { display: block; order: -1; width: 100%; text-align: center; }
    .pager-btn { flex: 1 1 0; padding: 0 10px; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    var dialog = document.getElementById('confirm-dialog');
    if (!dialog) { return; }

    var pending = null;
    var canModal = typeof dialog.showModal === 'function';

    document.addEventListener('submit', function (event) {
        var form = event.target;
        if (!form.hasAttribute || !form.hasAttribute('data-confirm')) { return; }

        var name = form.getAttribute('data-name');

        if (!canModal) {
            if (!window.confirm('Yakin ingin menghapus artikel "' + name + '"?')) { event.preventDefault(); }
            return;
        }

        event.preventDefault();
        pending = form;
        document.getElementById('dlg-name').textContent = name;
        dialog.showModal();
    });

    document.getElementById('dlg-cancel').addEventListener('click', function () { dialog.close(); });

    document.getElementById('dlg-confirm').addEventListener('click', function () {
        var form = pending;
        pending = null;
        dialog.close();
        if (form) { form.submit(); }
    });

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog) { dialog.close(); }
    });

    dialog.addEventListener('close', function () { pending = null; });
})();
</script>
@endpush