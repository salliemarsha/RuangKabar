
@extends('layouts.dashboard')

@section('title', 'Pengelolaan Artikel')

@section('content')
    @php
        $n = fn ($v) => number_format($v, 0, ',', '.');
        $isFiltered = $search !== '' || $status !== '' || $categoryId > 0;
        $returnTo = request()->fullUrl();
    @endphp

    <nav class="crumbs" aria-label="Breadcrumb">
        <ol>
            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li aria-current="page">Artikel</li>
        </ol>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="hero-inner">
            <span class="hero-label">ARTIKEL</span>
            <h1 class="hero-title" id="page-title">Pengelolaan Artikel</h1>
            <p class="hero-lead">
                Kelola seluruh artikel RuangKabar dari semua penulis: cari, filter,
                tinjau, ubah, dan hapus artikel dari satu tempat.
            </p>

            <div class="hero-actions">
                <a class="btn btn--gold" href="{{ route('articles.create') }}">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" aria-hidden="true">
                        <path d="M8 3v10M3 8h10"/>
                    </svg>
                    Tambah Artikel
                </a>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="flash" role="status">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <circle cx="10" cy="10" r="8"/>
                <path d="M6.5 10.5l2.5 2.5 4.5-5"/>
            </svg>
            <p>{{ session('success') }}</p>
            <button class="flash-close" type="button"
                data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    @if (session('error'))
        <div class="flash flash--error" role="alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path d="M10 2.5l8 14H2z"/>
                <path d="M10 8v4M10 14.5v.01"/>
            </svg>
            <p>{{ session('error') }}</p>
            <button class="flash-close" type="button"
                data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    <section class="am-stats" aria-label="Ringkasan artikel">
        <article class="am-stat am-stat--lead">
            <span class="am-stat-label">Total Artikel</span>
            <span class="am-stat-value">{{ $n($stats['total']) }}</span>
            <span class="am-stat-note">Seluruh artikel tersimpan</span>
        </article>

        <article class="am-stat">
            <span class="am-stat-label">Terbit</span>
            <span class="am-stat-value">{{ $n($stats['published']) }}</span>
            <span class="am-stat-note">Tayang di portal</span>
        </article>

        <article class="am-stat">
            <span class="am-stat-label">Draft</span>
            <span class="am-stat-value">{{ $n($stats['draft']) }}</span>
            <span class="am-stat-note">Belum dipublikasikan</span>
        </article>

        <article class="am-stat">
            <span class="am-stat-label">Penulis Aktif</span>
            <span class="am-stat-value">{{ $n($stats['authors']) }}</span>
            <span class="am-stat-note">Memiliki artikel</span>
        </article>
    </section>

    <form class="am-filter" id="am-filter"
        action="{{ route('admin.articles.index') }}" method="GET" role="search">

        <div class="search">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <circle cx="9" cy="9" r="6"/>
                <path d="M14 14l4 4"/>
            </svg>

            <label class="sr-only" for="am-search">Cari judul artikel</label>
            <input id="am-search" type="search" name="search"
                value="{{ $search }}" placeholder="Cari judul artikel"
                autocomplete="off">
        </div>

        <label class="sr-only" for="am-status">Filter status</label>
        <select class="am-select" id="am-status" name="status">
            <option value="">Semua status</option>
            <option value="published" @selected($status === 'published')>Published</option>
            <option value="draft" @selected($status === 'draft')>Draft</option>
        </select>

        <label class="sr-only" for="am-category">Filter kategori</label>
        <select class="am-select" id="am-category" name="category">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected($categoryId === (int) $category->id)>
                    {{ $category->name }}{{ $category->is_active ? '' : ' (nonaktif)' }}
                </option>
            @endforeach
        </select>

        <button class="btn" type="submit">Cari</button>

        @if ($isFiltered)
            <a class="btn btn--ghost"
                href="{{ route('admin.articles.index') }}">Reset</a>
        @endif
    </form>

    @if ($articles->count())
        <div class="am-panel">
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th class="am-col-no" scope="col">No.</th>
                            <th class="am-col-thumb" scope="col">Gambar</th>
                            <th class="am-col-title" scope="col">Judul Artikel</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                            <th scope="col">Publikasi</th>
                            <th scope="col">Diperbarui</th>
                            <th class="am-col-end" scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($articles as $row)
                            <tr>
                                <td class="am-col-no" data-label="No.">
                                    {{ $articles->firstItem() + $loop->index }}
                                </td>

                                <td class="am-col-thumb" data-label="Gambar">
                                    @if ($row->image)
                                        <img class="am-thumb"
                                            src="{{ asset('storage/' . $row->image) }}"
                                            alt="Sampul {{ $row->title }}"
                                            loading="lazy">
                                    @else
                                        <span class="am-thumb am-thumb--empty"
                                            aria-label="Tidak ada gambar">
                                            <svg viewBox="0 0 20 20" fill="none"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" aria-hidden="true">
                                                <rect x="2" y="4" width="16" height="12" rx="2"/>
                                                <circle cx="7.5" cy="8.5" r="1.5"/>
                                                <path d="M2 14l4-4 3 3 3-3 6 4"/>
                                            </svg>
                                        </span>
                                    @endif
                                </td>

                                <td class="am-col-title" data-label="Judul">
                                    <a class="am-title"
                                        href="{{ route('articles.show', $row) }}">
                                        {{ $row->title }}
                                    </a>
                                    <span class="slug am-slug">{{ $row->slug }}</span>
                                </td>

                                <td data-label="Penulis">
                                    {{ $row->user->name ?? '-' }}
                                </td>

                                <td data-label="Kategori">
                                    <span class="am-cat">
                                        {{ $row->category->name ?? '-' }}
                                    </span>
                                </td>

                                <td data-label="Status">
                                    @if ($row->status === 'published')
                                        <span class="am-badge am-badge--published">Published</span>
                                    @elseif ($row->status === 'draft')
                                        <span class="am-badge am-badge--draft">Draft</span>
                                    @else
                                        <span class="am-badge am-badge--other">
                                            {{ ucfirst($row->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="am-date" data-label="Publikasi">
                                    @if ($row->created_at)
                                        <time datetime="{{ $row->created_at->toDateString() }}">
                                            {{ $row->created_at->locale('id')->translatedFormat('d M Y') }}
                                        </time>
                                    @else
                                        &mdash;
                                    @endif
                                </td>

                                <td class="am-date" data-label="Diperbarui">
                                    @if ($row->updated_at && (!$row->created_at || $row->updated_at->gt($row->created_at)))
                                        <time datetime="{{ $row->updated_at->toIso8601String() }}">
                                            {{ $row->updated_at->locale('id')->translatedFormat('d M Y') }}
                                            <br>
                                            <small class="am-date-time">
                                                {{ $row->updated_at->format('H:i') }} WIB
                                            </small>
                                        </time>
                                    @else
                                        &mdash;
                                    @endif
                                </td>

                                <td class="am-col-end">
                                    <div class="act-row">
                                        <a class="act"
                                            href="{{ route('articles.show', $row) }}"
                                            title="Detail"
                                            aria-label="Lihat detail artikel {{ $row->title }}">
                                            <svg viewBox="0 0 16 16" fill="none"
                                                stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M1.5 8S4 3.5 8 3.5 14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8z"/>
                                                <circle cx="8" cy="8" r="2"/>
                                            </svg>
                                            <span class="act__t">Detail</span>
                                        </a>

                                        <a class="act act--edit"
                                            href="{{ route('articles.edit', $row) }}"
                                            title="Edit"
                                            aria-label="Edit artikel {{ $row->title }}">
                                            <svg viewBox="0 0 16 16" fill="none"
                                                stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                aria-hidden="true">
                                                <path d="M11 2.5l2.5 2.5L5.5 13H3v-2.5z"/>
                                            </svg>
                                            <span class="act__t">Edit</span>
                                        </a>

                                        <form class="inline-form"
                                            action="{{ route('articles.destroy', $row) }}"
                                            method="POST" data-confirm
                                            data-name="{{ $row->title }}">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="return_to"
                                                value="{{ $returnTo }}">

                                            <button class="act act--delete" type="submit"
                                                title="Hapus"
                                                aria-label="Hapus artikel {{ $row->title }}">
                                                <svg viewBox="0 0 16 16" fill="none"
                                                    stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    aria-hidden="true">
                                                    <path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/>
                                                </svg>
                                                <span class="act__t">Hapus</span>
                                            </button>
                                        </form>
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
                $window = collect(range(1, $last))
                    ->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)
                    ->values();
                $previous = null;
            @endphp

            <nav class="am-pager" aria-label="Navigasi halaman">
                @if ($articles->onFirstPage())
                    <span class="am-pager__btn is-disabled" aria-disabled="true">
                        &larr;&nbsp;Sebelumnya
                    </span>
                @else
                    <a class="am-pager__btn"
                        href="{{ $articles->previousPageUrl() }}" rel="prev">
                        &larr;&nbsp;Sebelumnya
                    </a>
                @endif

                <ul class="am-pager__pages">
                    @foreach ($window as $page)
                        @if ($previous !== null && $page - $previous > 1)
                            <li class="am-pager__gap" aria-hidden="true">&hellip;</li>
                        @endif

                        <li>
                            @if ($page === $current)
                                <span class="am-pager__num is-current"
                                    aria-current="page">{{ $page }}</span>
                            @else
                                <a class="am-pager__num"
                                    href="{{ $articles->url($page) }}"
                                    aria-label="Halaman {{ $page }}">{{ $page }}</a>
                            @endif
                        </li>

                        @php $previous = $page; @endphp
                    @endforeach
                </ul>

                @if ($articles->hasMorePages())
                    <a class="am-pager__btn"
                        href="{{ $articles->nextPageUrl() }}" rel="next">
                        Berikutnya&nbsp;&rarr;
                    </a>
                @else
                    <span class="am-pager__btn is-disabled" aria-disabled="true">
                        Berikutnya&nbsp;&rarr;
                    </span>
                @endif

                <span class="am-pager__status">
                    Halaman {{ $current }} dari {{ $last }}
                </span>
            </nav>
        @endif

    @elseif ($isFiltered)
        <div class="no-results">
            <strong>Artikel tidak ditemukan.</strong>
            <p>
                Tidak ada artikel yang cocok dengan pencarian atau filter Anda.
                Coba ubah kata kunci, status, atau kategori, atau reset filter.
            </p>
            <a class="btn btn--ghost"
                href="{{ route('admin.articles.index') }}">Reset filter</a>
        </div>

    @else
        <div class="empty">
            <strong>Belum ada artikel.</strong>
            <p>Tulis artikel pertama agar tampil di portal dan dapat dibaca pembaca.</p>
            <a class="btn" href="{{ route('articles.create') }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M8 3v10M3 8h10"/>
                </svg>
                Tambah Artikel Pertama
            </a>
        </div>
    @endif

    <dialog class="dialog" id="confirm-dialog"
        aria-labelledby="dlg-title" aria-describedby="dlg-text">
        <div class="dialog-icon">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor"
                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                aria-hidden="true">
                <path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/>
            </svg>
        </div>

        <h2 id="dlg-title">Hapus artikel?</h2>
        <p id="dlg-text">
            &ldquo;<strong id="dlg-name"></strong>&rdquo; akan dihapus secara permanen.
            Tindakan ini tidak dapat dibatalkan.
        </p>

        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" id="dlg-cancel" autofocus>
                Batal
            </button>
            <button class="btn btn--danger" type="button" id="dlg-confirm">
                Ya, Hapus
            </button>
        </div>
    </dialog>
@endsection

@push('styles')
<style>
.crumbs a {
    color: inherit;
    text-decoration: none;
    transition: color var(--t-fast) ease-out;
}
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
.crumbs li { list-style: none; }

.am-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 22px;
}
.am-stat {
    display: flex;
    flex-direction: column;
    min-width: 0;
    padding: 22px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}
.am-stat-label {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-soft);
}
.am-stat-value {
    display: block;
    margin-top: 8px;
    font-family: var(--serif);
    font-size: 38px;
    font-weight: 600;
    line-height: 1;
    color: var(--emerald);
}
.am-stat-note {
    margin-top: auto;
    padding-top: 12px;
    font-family: var(--body);
    font-size: 12.5px;
    color: var(--text-soft);
}
.am-stat--lead {
    background: var(--emerald);
    border-color: var(--emerald);
}
.am-stat--lead .am-stat-label { color: var(--on-dark); }
.am-stat--lead .am-stat-value { color: var(--ivory); }
.am-stat--lead .am-stat-note { color: rgba(250, 248, 243, 0.62); }

.am-filter {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin: 0 0 18px;
    padding: 14px;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}
.am-filter .search { max-width: none; flex: 1 1 260px; }
.am-filter .btn { height: 48px; }
.am-select {
    flex: 0 1 190px;
    height: 48px;
    padding: 0 40px 0 18px;
    font-family: var(--sans);
    font-size: 14px;
    font-weight: 600;
    color: var(--emerald);
    background-color: var(--ivory);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 18px center;
    border: 1px solid var(--rule);
    border-radius: 999px;
    cursor: pointer;
    appearance: none;
    text-overflow: ellipsis;
    transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out;
}
.am-select:hover { border-color: rgba(24, 60, 54, 0.3); }
.am-select:focus {
    outline: none;
    border-color: var(--forest);
    box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4);
}

.am-panel {
    overflow: hidden;
    background: var(--white);
    border: 1px solid rgba(24, 60, 54, 0.08);
    border-radius: 22px;
}
.am-table-wrap { overflow-x: auto; }
.am-table {
    width: 100%;
    min-width: 1120px;
    border-collapse: collapse;
}
.am-table th {
    padding: 16px 18px;
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
.am-table td {
    padding: 16px 18px;
    vertical-align: middle;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text);
    border-bottom: 1px solid rgba(24, 60, 54, 0.08);
}
.am-table th:first-child, .am-table td:first-child { padding-left: 24px; }
.am-table th:last-child, .am-table td:last-child { padding-right: 24px; }
.am-table tbody tr:last-child td { border-bottom: 0; }
.am-table tbody tr { transition: background var(--t-fast) ease-out; }
.am-table tbody tr:hover { background: rgba(231, 224, 210, 0.3); }
.am-col-no { width: 56px; color: var(--text-soft); }
.am-col-thumb { width: 76px; }
.am-col-title { width: 30%; }
.am-col-end { width: 160px; text-align: right; }
.am-col-end .act-row { justify-content: flex-end; }

.am-title {
    display: -webkit-box;
    margin-bottom: 6px;
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
.am-title:hover {
    color: var(--forest);
    text-decoration: underline;
    text-decoration-color: var(--gold);
    text-underline-offset: 3px;
}
.am-slug {
    display: block;
    width: fit-content;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    font-size: 11.5px;
}
.am-cat {
    display: inline-block;
    padding: 4px 12px;
    font-family: var(--sans);
    font-size: 12.5px;
    font-weight: 600;
    color: var(--forest);
    background: rgba(55, 107, 92, 0.1);
    border-radius: 999px;
}
.am-date { white-space: nowrap; color: var(--text-soft); }
.am-date-time { font-size: 11.5px; opacity: 0.75; }

.am-thumb {
    display: block;
    width: 56px;
    height: 42px;
    object-fit: cover;
    border-radius: 8px;
    background: var(--sand);
}
.am-thumb--empty {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 42px;
    border-radius: 8px;
    background: rgba(231, 224, 210, 0.6);
    color: var(--text-soft);
}
.am-thumb--empty svg { width: 18px; height: 18px; }

.am-badge {
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
.am-badge::before {
    content: "";
    width: 6px;
    height: 6px;
    background: currentColor;
    border-radius: 50%;
}
.am-badge--published {
    color: #1F5A47;
    background: rgba(55, 107, 92, 0.16);
}
.am-badge--draft {
    color: #7A6130;
    background: rgba(185, 154, 100, 0.24);
}
.am-badge--other {
    color: var(--text-soft);
    background: rgba(104, 115, 110, 0.14);
}

.am-table .act { justify-content: center; width: 38px; padding: 0; }
.act__t {
    position: absolute;
    width: 1px;
    height: 1px;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
}
.btn:disabled { opacity: 0.65; cursor: progress; }

.am-pager {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 12px 10px;
    margin-top: 28px;
}
.am-pager__pages {
    display: flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.am-pager__btn, .am-pager__num {
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
.am-pager__btn { padding: 0 20px; }
.am-pager__num { min-width: 44px; padding: 0 8px; }
a.am-pager__btn:hover, a.am-pager__num:hover {
    color: var(--white);
    background: var(--emerald);
    border-color: var(--emerald);
}
.am-pager__num.is-current {
    color: var(--ivory);
    background: var(--emerald);
    border-color: var(--emerald);
}
.am-pager__btn.is-disabled {
    color: var(--text-soft);
    background: transparent;
    opacity: 0.6;
}
.am-pager__gap { padding: 0 4px; color: var(--text-soft); }
.am-pager__status {
    display: none;
    font-family: var(--body);
    font-size: 14px;
    color: var(--text-soft);
}
.no-results .btn { margin-top: 22px; }

@media (max-width: 1023px) {
    .am-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 767px) {
    .am-panel {
        background: transparent;
        border: 0;
        border-radius: 0;
        overflow: visible;
    }
    .am-table-wrap { overflow: visible; }
    .am-table { min-width: 0; }
    .am-table, .am-table tbody, .am-table tr, .am-table td {
        display: block;
        width: 100%;
    }
    .am-table thead {
        position: absolute;
        width: 1px;
        height: 1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
    }
    .am-table tbody tr {
        margin-bottom: 12px;
        padding: 16px;
        background: var(--white);
        border: 1px solid rgba(24, 60, 54, 0.08);
        border-radius: 18px;
    }
    .am-table tbody tr:hover { background: var(--white); }
    .am-table td, .am-table td:first-child, .am-table td:last-child {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 7px 0;
        border: 0;
        text-align: right;
    }
    .am-table td[data-label]::before {
        content: attr(data-label);
        flex: 0 0 84px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        text-align: left;
        color: var(--text-soft);
    }
    .am-table td.am-col-title {
        display: block;
        text-align: left;
        padding-top: 0;
    }
    .am-table td.am-col-title::before {
        display: block;
        margin-bottom: 6px;
    }
    .am-table td.am-col-no { width: 100%; }
    .am-table td.am-col-thumb {
        justify-content: flex-start;
        border-bottom: 0;
        padding-bottom: 0;
    }
    .am-table td.am-col-thumb::before { display: none; }
    .am-table td.am-col-end {
        display: block;
        margin-top: 6px;
        padding-top: 14px;
        border-top: 1px solid var(--rule);
    }
    .am-col-end .act-row { justify-content: stretch; }
    .am-col-end .act-row > *, .am-table .act {
        flex: 1;
        width: auto;
        padding: 0 14px;
    }
    .am-col-end .inline-form { display: flex; }
    .am-table .act__t {
        position: static;
        width: auto;
        height: auto;
        margin: 0;
        overflow: visible;
        clip: auto;
    }
    .am-pager { margin-top: 20px; }
    .am-pager__pages { display: none; }
    .am-pager__status {
        display: block;
        order: -1;
        width: 100%;
        text-align: center;
    }
    .am-pager__btn {
        flex: 1 1 0;
        padding: 0 10px;
    }
}

@media (max-width: 719px) {
    .am-stat { padding: 18px; }
    .am-stat-value { font-size: 32px; }
    .am-filter { padding: 12px; border-radius: 18px; }
    .am-select { flex: 1 1 100%; }
    .am-filter .btn { flex: 1 1 0; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    var filterSelects = document.querySelectorAll('#am-filter .am-select');

    filterSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            select.form.submit();
        });
    });

    var dialog = document.getElementById('confirm-dialog');

    if (!dialog) return;

    var confirmBtn = document.getElementById('dlg-confirm');
    var confirmLabel = confirmBtn.textContent;
    var pending = null;
    var canModal = typeof dialog.showModal === 'function';

    var reset = function () {
        confirmBtn.disabled = false;
        confirmBtn.textContent = confirmLabel;
    };

    document.addEventListener('submit', function (event) {
        var form = event.target;

        if (!form.hasAttribute || !form.hasAttribute('data-confirm')) return;

        var name = form.getAttribute('data-name');

        if (!canModal) {
            if (!window.confirm('Yakin ingin menghapus artikel "' + name + '"?')) {
                event.preventDefault();
            }
            return;
        }

        event.preventDefault();
        pending = form;
        document.getElementById('dlg-name').textContent = name;
        reset();
        dialog.showModal();
    });

    document.getElementById('dlg-cancel').addEventListener('click', function () {
        dialog.close();
    });

    confirmBtn.addEventListener('click', function () {
        if (!pending) return;

        confirmBtn.disabled = true;
        confirmBtn.textContent = 'Menghapus…';
        pending.submit();
    });

    dialog.addEventListener('cancel', function (event) {
        if (confirmBtn.disabled) event.preventDefault();
    });

    dialog.addEventListener('click', function (event) {
        if (event.target === dialog && !confirmBtn.disabled) {
            dialog.close();
        }
    });

    dialog.addEventListener('close', function () {
        pending = null;
    });

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            reset();
            if (dialog.open) dialog.close();
        }
    });
})();
</script>
@endpush
