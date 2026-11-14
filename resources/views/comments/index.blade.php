@extends('layouts.dashboard')

@section('title', 'Kelola Komentar')

@section('content')
    @php
        $statusMap = [
            'approved' => 'Disetujui',
            'pending' => 'Pending',
            'rejected' => 'Ditolak',
        ];
        $filters = [
            null => ['Semua', $stats['all']],
            'pending' => ['Pending', $stats['pending']],
            'approved' => ['Disetujui', $stats['approved']],
            'rejected' => ['Ditolak', $stats['rejected']],
        ];
        $filterUrl = fn ($s) => route('comments.index', array_filter(['status' => $s, 'search' => $search !== '' ? $search : null]));
        $isFiltered = $status !== null || $search !== '';
    @endphp

    <nav class="crumbs" aria-label="Breadcrumb">
        <ol>
            <li><a href="/admin/dashboard">Admin</a></li>
            <li aria-current="page">Komentar</li>
        </ol>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="hero-inner">
            <span class="hero-label">KOMENTAR</span>
            <h1 class="hero-title" id="page-title">Kelola Komentar</h1>
            <p class="hero-lead">Periksa komentar yang ditahan sistem, setujui atau tolak, dan hapus yang tidak diperlukan.</p>
        </div>
    </section>

    @if (session('success'))
        <div class="flash" role="status">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="8"/><path d="M6.5 10.5l2.5 2.5 4.5-5"/></svg>
            <p>{{ session('success') }}</p>
            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    @if (session('error') || $errors->any())
        <div class="flash flash--error" role="alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
            <p>{{ session('error') ?? $errors->first() }}</p>
            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    <section class="stats" aria-label="Ringkasan komentar">
        <div class="stat">
            <span class="stat-label">Total komentar</span>
            <strong class="stat-num">{{ number_format($stats['all'], 0, ',', '.') }}</strong>
        </div>
        <div class="stat stat--approved">
            <span class="stat-label">Disetujui</span>
            <strong class="stat-num">{{ number_format($stats['approved'], 0, ',', '.') }}</strong>
        </div>
        <div class="stat stat--pending {{ $stats['pending'] > 0 ? 'has-items' : '' }}">
            <span class="stat-label">Pending</span>
            <strong class="stat-num">{{ number_format($stats['pending'], 0, ',', '.') }}</strong>
        </div>
        <div class="stat stat--rejected">
            <span class="stat-label">Ditolak</span>
            <strong class="stat-num">{{ number_format($stats['rejected'], 0, ',', '.') }}</strong>
        </div>
    </section>

    <nav class="filters" aria-label="Filter status">
        @foreach ($filters as $key => [$label, $count])
            <a class="filter {{ $status === $key ? 'is-active' : '' }}" href="{{ $filterUrl($key) }}" @if ($status === $key) aria-current="true" @endif>
                {{ $label }} <small>{{ number_format($count, 0, ',', '.') }}</small>
            </a>
        @endforeach
    </nav>

    <div class="toolbar">
        <form class="toolbar-search" action="{{ route('comments.index') }}" method="GET" role="search">
            @if ($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif

            <div class="search">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="9" cy="9" r="6"/><path d="M14 14l4 4"/></svg>
                <label class="sr-only" for="filter-search">Cari komentar</label>
                <input id="filter-search" type="search" name="search" value="{{ $search }}" placeholder="Cari komentar, pengguna, atau artikel" autocomplete="off">
            </div>

            <button class="btn btn--sm" type="submit">Cari</button>

            @if ($isFiltered)
                <a class="btn btn--sm btn--ghost" href="{{ route('comments.index') }}">Reset</a>
            @endif
        </form>

        @if ($comments->count())
            <p class="result-info" aria-live="polite">
                Menampilkan <strong>{{ $comments->firstItem() }}&ndash;{{ $comments->lastItem() }}</strong> dari <strong>{{ $comments->total() }}</strong> komentar
            </p>
        @endif
    </div>

    @if ($comments->count())
        <div class="panel">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pengguna</th>
                            <th class="col-comment" scope="col">Komentar</th>
                            <th scope="col">Artikel</th>
                            <th scope="col">Status</th>
                            <th scope="col">Alasan ditahan</th>
                            <th scope="col">Tanggal</th>
                            <th class="col-actions" scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comments as $row)
                            @php
                                $userName = $row->user->name ?? 'Pengguna dihapus';
                                $articleTitle = $row->article->title ?? 'Artikel dihapus';
                                $statusLabel = $statusMap[$row->status] ?? ucfirst($row->status);
                                $dateText = $row->created_at ? $row->created_at->locale('id')->translatedFormat('d M Y, H:i') : '-';
                                $snippet = \Illuminate\Support\Str::limit(preg_replace('/\s+/u', ' ', $row->comment), 120);
                            @endphp

                            <tr>
                                <td data-label="Pengguna">
                                    <div class="cell-user">
                                        <span class="user-dot" aria-hidden="true">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($userName, 0, 1)) }}</span>
                                        <span class="cell-user__name">{{ $userName }}</span>
                                    </div>
                                </td>

                                <td class="col-comment" data-label="Komentar">
                                    <p class="cell-comment">{{ $row->comment }}</p>
                                </td>

                                <td data-label="Artikel">
                                    @if ($row->article)
                                        <a class="cell-article" href="{{ route('articles.show', $row->article) }}" target="_blank" rel="noopener">{{ $articleTitle }}</a>
                                    @else
                                        <span class="cell-muted">{{ $articleTitle }}</span>
                                    @endif
                                </td>

                                <td data-label="Status">
                                    <span class="badge badge--{{ in_array($row->status, ['approved', 'pending', 'rejected'], true) ? $row->status : 'other' }}">{{ $statusLabel }}</span>
                                </td>

                                <td data-label="Alasan ditahan">
                                    @if ($row->flag_reason)
                                        <p class="cell-reason">{{ $row->flag_reason }}</p>
                                    @else
                                        <span class="cell-muted">-</span>
                                    @endif
                                </td>

                                <td class="cell-date" data-label="Tanggal">{{ $dateText }}</td>

                                <td class="col-actions-cell">
                                    <div class="act-row">
                                        <button class="act" type="button" data-detail
                                            data-user="{{ $userName }}"
                                            data-article="{{ $articleTitle }}"
                                            data-article-url="{{ $row->article ? route('articles.show', $row->article) : '' }}"
                                            data-date="{{ $dateText }}"
                                            data-status="{{ $row->status }}"
                                            data-status-label="{{ $statusLabel }}"
                                            data-reason="{{ $row->flag_reason }}"
                                            data-text="{{ $row->comment }}"
                                            data-update-url="{{ route('comments.update', $row) }}"
                                            title="Lihat detail" aria-label="Lihat detail komentar dari {{ $userName }}">
                                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.5 8S4 3.5 8 3.5 14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8z"/><circle cx="8" cy="8" r="2"/></svg>
                                            <span class="act__t">Detail</span>
                                        </button>

                                        @if ($row->status !== 'approved')
                                            <form class="inline-form" action="{{ route('comments.update', $row) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button class="act act--ok" type="submit" title="Setujui" aria-label="Setujui komentar dari {{ $userName }}">
                                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3.2L13 4.8"/></svg>
                                                    <span class="act__t">Setujui</span>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($row->status !== 'rejected')
                                            <form class="inline-form" action="{{ route('comments.update', $row) }}" method="POST"
                                                data-confirm data-variant="warn" data-title="Tolak komentar?"
                                                data-text="Komentar tidak akan tampil di halaman publik. Anda masih bisa menyetujuinya kembali nanti."
                                                data-label="Ya, Tolak" data-snippet="{{ $snippet }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button class="act act--reject" type="submit" title="Tolak" aria-label="Tolak komentar dari {{ $userName }}">
                                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 4l8 8M12 4l-8 8"/></svg>
                                                    <span class="act__t">Tolak</span>
                                                </button>
                                            </form>
                                        @endif

                                        <form class="inline-form" action="{{ route('comments.destroy', $row) }}" method="POST"
                                            data-confirm data-variant="danger" data-title="Hapus komentar?"
                                            data-text="Komentar akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan."
                                            data-label="Ya, Hapus" data-snippet="{{ $snippet }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="act act--delete" type="submit" title="Hapus" aria-label="Hapus komentar dari {{ $userName }}">
                                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/></svg>
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

        @if ($comments->hasPages())
            @php
                $current = $comments->currentPage();
                $last = $comments->lastPage();
                $window = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)->values();
                $previous = null;
            @endphp

            <nav class="pager" aria-label="Navigasi halaman">
                @if ($comments->onFirstPage())
                    <span class="pager-btn is-disabled" aria-disabled="true"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</span>
                @else
                    <a class="pager-btn" href="{{ $comments->previousPageUrl() }}" rel="prev"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</a>
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
                                <a class="pager-num" href="{{ $comments->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                            @endif
                        </li>

                        @php $previous = $page; @endphp
                    @endforeach
                </ul>

                @if ($comments->hasMorePages())
                    <a class="pager-btn" href="{{ $comments->nextPageUrl() }}" rel="next">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></a>
                @else
                    <span class="pager-btn is-disabled" aria-disabled="true">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></span>
                @endif

                <span class="pager-status">Halaman {{ $current }} dari {{ $last }}</span>
            </nav>
        @endif
    @elseif ($isFiltered)
        <div class="no-results">
            <strong>Komentar tidak ditemukan.</strong>
            <p>Tidak ada komentar yang cocok dengan filter atau kata kunci ini. Coba ubah filter atau reset pencarian.</p>
            <a class="btn btn--ghost" href="{{ route('comments.index') }}">Reset filter</a>
        </div>
    @else
        <div class="empty">
            <strong>Belum ada komentar.</strong>
            <p>Komentar dari pembaca akan muncul di sini. Komentar yang terindikasi bermasalah akan ditahan untuk Anda periksa.</p>
        </div>
    @endif

    {{-- Modal detail --}}
    <dialog class="dialog dialog--wide" id="detail-dialog" aria-labelledby="dt-title">
        <div class="dt-head">
            <h2 id="dt-title">Detail komentar</h2>
            <span class="badge" id="dt-badge"></span>
        </div>

        <dl class="dt-meta">
            <div><dt>Pengguna</dt><dd id="dt-user"></dd></div>
            <div><dt>Tanggal</dt><dd id="dt-date"></dd></div>
            <div class="dt-wide"><dt>Artikel</dt><dd><a id="dt-article" href="#" target="_blank" rel="noopener"></a></dd></div>
        </dl>

        <div class="dt-body" id="dt-text" tabindex="0"></div>

        <div class="dt-reason" id="dt-reason-box" hidden>
            <strong>Alasan ditahan</strong>
            <p id="dt-reason"></p>
        </div>

        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" id="dt-close">Tutup</button>

            <form class="inline-form" id="dt-reject-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="rejected">
                <button class="btn btn--danger" type="submit">Tolak</button>
            </form>

            <form class="inline-form" id="dt-approve-form" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="approved">
                <button class="btn" type="submit">Setujui</button>
            </form>
        </div>
    </dialog>

    {{-- Modal konfirmasi (tolak / hapus) --}}
    <dialog class="dialog" id="confirm-dialog" aria-labelledby="cf-title" aria-describedby="cf-text">
        <div class="dialog-icon"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 2.5l6 10.5H2z"/><path d="M8 6.5v3M8 11.5v.01"/></svg></div>
        <h2 id="cf-title"></h2>
        <blockquote class="cf-quote" id="cf-quote"></blockquote>
        <p id="cf-text"></p>
        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" id="cf-cancel" autofocus>Batal</button>
            <button class="btn btn--danger" type="button" id="cf-confirm"></button>
        </div>
    </dialog>
@endsection

@push('styles')
<style>
.crumbs a { color: inherit; text-decoration: none; transition: color var(--t-fast) ease-out; }
.crumbs a:hover { color: var(--forest); }
.crumbs ol { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; margin: 0; padding: 0; list-style: none; }
.crumbs li { list-style: none; }

.stats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 24px; }
.stat { padding: 20px 22px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.stat-label { display: flex; align-items: center; gap: 8px; font-size: 12.5px; font-weight: 700; color: var(--text-soft); }
.stat-label::before { content: ""; flex: none; width: 8px; height: 8px; background: var(--emerald); border-radius: 50%; }
.stat--approved .stat-label::before { background: var(--forest); }
.stat--pending .stat-label::before { background: var(--gold); }
.stat--rejected .stat-label::before { background: var(--danger); }
.stat-num { display: block; margin-top: 12px; font-family: var(--serif); font-size: 34px; font-weight: 600; line-height: 1; color: var(--emerald); }
.stat--pending.has-items { border-color: rgba(185, 154, 100, 0.7); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.18); }

.filters { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 18px; }
.filter { display: inline-flex; align-items: center; gap: 8px; height: 40px; padding: 0 16px; font-family: var(--sans); font-size: 13px; font-weight: 700; color: var(--emerald); text-decoration: none; background: var(--white); border: 1px solid var(--rule); border-radius: 999px; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.filter small { font-size: 12px; font-weight: 700; color: var(--text-soft); }
.filter:hover { border-color: var(--forest); }
.filter.is-active { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }
.filter.is-active small { color: var(--gold); }

.toolbar-search { display: flex; flex: 1 1 380px; align-items: center; gap: 10px; min-width: 0; }
.toolbar-search .search { flex: 1 1 auto; max-width: 380px; }
.btn--sm { height: 44px; padding: 0 20px; font-size: 13px; }

.panel { overflow: hidden; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.table-wrap { overflow-x: auto; }
.table { width: 100%; min-width: 1080px; border-collapse: collapse; }
.table th { padding: 16px 18px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-align: left; text-transform: uppercase; white-space: nowrap; color: var(--text-soft); background: rgba(231, 224, 210, 0.45); border-bottom: 1px solid var(--rule); }
.table td { padding: 16px 18px; vertical-align: top; font-family: var(--body); font-size: 14px; color: var(--text); border-bottom: 1px solid rgba(24, 60, 54, 0.08); }
.table th:first-child, .table td:first-child { padding-left: 24px; }
.table th:last-child, .table td:last-child { padding-right: 24px; }
.table tbody tr:last-child td { border-bottom: 0; }
.table tbody tr { transition: background var(--t-fast) ease-out; }
.table tbody tr:hover { background: rgba(231, 224, 210, 0.3); }
.col-comment { width: 30%; min-width: 260px; }
.col-actions { width: 196px; text-align: right; }

.cell-user { display: flex; align-items: center; gap: 10px; min-width: 0; }
.user-dot { display: flex; flex: none; align-items: center; justify-content: center; width: 34px; height: 34px; font-family: var(--sans); font-size: 13px; font-weight: 800; color: var(--emerald); background: var(--sand); border-radius: 50%; }
.cell-user__name { font-family: var(--sans); font-weight: 700; color: var(--emerald); overflow-wrap: anywhere; }

.cell-comment { display: -webkit-box; margin: 0; overflow: hidden; line-height: 1.6; overflow-wrap: anywhere; white-space: pre-line; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
.cell-article { display: -webkit-box; overflow: hidden; font-family: var(--sans); font-size: 13.5px; font-weight: 600; line-height: 1.45; color: var(--forest); text-decoration: none; overflow-wrap: anywhere; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
.cell-article:hover { color: var(--emerald); text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.cell-reason { display: -webkit-box; margin: 0; overflow: hidden; font-size: 13px; line-height: 1.5; color: #7A6130; overflow-wrap: anywhere; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
.cell-muted { color: var(--text-soft); }
.cell-date { white-space: nowrap; color: var(--text-soft); }

.badge { display: inline-flex; align-items: center; gap: 7px; padding: 5px 12px; font-family: var(--sans); font-size: 12px; font-weight: 700; white-space: nowrap; border-radius: 999px; }
.badge::before { content: ""; width: 6px; height: 6px; background: currentColor; border-radius: 50%; }
.badge--approved { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.badge--pending { color: #7A6130; background: rgba(185, 154, 100, 0.24); }
.badge--rejected { color: var(--danger); background: rgba(163, 57, 44, 0.12); }
.badge--other { color: var(--text-soft); background: rgba(104, 115, 110, 0.14); }

.col-actions-cell .act-row { justify-content: flex-end; flex-wrap: wrap; }
.table .act { justify-content: center; width: 38px; padding: 0; }
.act--ok:hover { color: var(--white); background: var(--forest); border-color: var(--forest); }
.act--reject { color: #7A6130; }
.act--reject:hover { color: var(--white); background: #7A6130; border-color: #7A6130; }
.table .act__t { position: absolute; width: 1px; height: 1px; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; }

.pager { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px 10px; margin-top: 32px; }
.pager-pages { display: flex; align-items: center; gap: 6px; margin: 0; padding: 0; list-style: none; }
.pager-btn, .pager-num { display: inline-flex; align-items: center; justify-content: center; height: 44px; font-family: var(--sans); font-size: 14px; font-weight: 700; color: var(--emerald); text-decoration: none; background: var(--white); border: 1px solid var(--rule); border-radius: 999px; transition: background var(--t-fast) ease-out, color var(--t-fast) ease-out, border-color var(--t-fast) ease-out; }
.pager-btn { padding: 0 20px; }
.pager-num { min-width: 44px; padding: 0 8px; }
a.pager-btn:hover, a.pager-num:hover { color: var(--white); background: var(--emerald); border-color: var(--emerald); }
.pager-num.is-current { color: var(--ivory); background: var(--emerald); border-color: var(--emerald); }
.pager-btn.is-disabled { color: var(--text-soft); background: transparent; opacity: 0.6; }
.pager-gap { padding: 0 4px; color: var(--text-soft); }
.pager-status { display: none; font-family: var(--body); font-size: 14px; color: var(--text-soft); }
.no-results .btn { margin-top: 22px; }

.dialog--wide { width: min(620px, calc(100vw - 32px)); max-height: calc(100dvh - 32px); overflow-y: auto; }
.dt-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 10px 14px; margin-bottom: 18px; }
.dt-head h2 { margin: 0; }
.dt-meta { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px 20px; margin: 0 0 18px; }
.dt-meta div { min-width: 0; }
.dt-meta .dt-wide { grid-column: 1 / -1; }
.dt-meta dt { margin-bottom: 4px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }
.dt-meta dd { margin: 0; font-family: var(--body); font-size: 14.5px; color: var(--text); overflow-wrap: anywhere; }
.dt-meta a { color: var(--forest); font-weight: 600; text-decoration: none; }
.dt-meta a:hover { text-decoration: underline; text-decoration-color: var(--gold); text-underline-offset: 3px; }
.dt-body { max-height: 260px; padding: 16px 18px; overflow-y: auto; font-family: var(--body); font-size: 15px; line-height: 1.7; white-space: pre-wrap; overflow-wrap: anywhere; color: var(--text); background: var(--ivory); border: 1px solid var(--rule); border-radius: 16px; }
.dt-reason { margin-top: 14px; padding: 12px 16px; background: rgba(185, 154, 100, 0.16); border-radius: 14px; }
.dt-reason strong { display: block; margin-bottom: 2px; font-family: var(--sans); font-size: 12px; letter-spacing: 0.08em; text-transform: uppercase; color: #7A6130; }
.dt-reason p { margin: 0; font-size: 14px; color: var(--text); }
.cf-quote { margin: 0 0 12px; padding: 10px 14px; font-family: var(--body); font-size: 14px; line-height: 1.6; color: var(--text); overflow-wrap: anywhere; background: var(--ivory); border-left: 3px solid var(--gold); border-radius: 10px; }
.cf-quote:empty { display: none; }
.btn--warn { background: #7A6130; }
.btn--warn:hover { background: #624E26; }
.dialog-actions .inline-form { display: flex; }
.btn:disabled { opacity: 0.65; cursor: progress; }

@media (max-width: 1023px) {
    .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 719px) {
    .stat { padding: 16px 18px; }
    .stat-num { font-size: 28px; }
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
    .table td[data-label]::before { content: attr(data-label); display: block; margin-bottom: 6px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }
    .col-comment { width: 100%; min-width: 0; }
    .cell-date { white-space: normal; }

    .col-actions-cell .act-row { justify-content: stretch; }
    .col-actions-cell .act-row > *, .table .act { flex: 1; width: auto; padding: 0 14px; justify-content: center; }
    .col-actions-cell .inline-form { display: flex; }
    .table .act__t { position: static; width: auto; height: auto; margin: 0; overflow: visible; clip: auto; }

    .pager { margin-top: 24px; }
    .pager-pages { display: none; }
    .pager-status { display: block; order: -1; width: 100%; text-align: center; }
    .pager-btn { flex: 1 1 0; padding: 0 10px; }

    .dt-meta { grid-template-columns: minmax(0, 1fr); }
    .dialog-actions .inline-form, .dialog-actions .inline-form .btn { flex: 1 1 100%; width: 100%; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    var byId = function (id) { return document.getElementById(id); };

    /* ---------- Konfirmasi tolak / hapus ---------- */
    var cf = byId('confirm-dialog');
    var cfConfirm = byId('cf-confirm');
    var pending = null;

    if (cf) {
        var canModal = typeof cf.showModal === 'function';

        var resetConfirm = function () { cfConfirm.disabled = false; };

        document.addEventListener('submit', function (event) {
            var form = event.target;
            if (!form.hasAttribute || !form.hasAttribute('data-confirm')) { return; }

            if (!canModal) {
                if (!window.confirm(form.getAttribute('data-title') + ' ' + form.getAttribute('data-text'))) { event.preventDefault(); }
                return;
            }

            event.preventDefault();
            pending = form;
            byId('cf-title').textContent = form.getAttribute('data-title');
            byId('cf-text').textContent = form.getAttribute('data-text');
            byId('cf-quote').textContent = form.getAttribute('data-snippet') || '';
            cfConfirm.textContent = form.getAttribute('data-label');
            cfConfirm.className = 'btn ' + (form.getAttribute('data-variant') === 'danger' ? 'btn--danger' : 'btn--warn');
            resetConfirm();
            cf.showModal();
        });

        byId('cf-cancel').addEventListener('click', function () { cf.close(); });

        cfConfirm.addEventListener('click', function () {
            if (!pending) { return; }
            cfConfirm.disabled = true;
            pending.submit();
        });

        cf.addEventListener('cancel', function (event) { if (cfConfirm.disabled) { event.preventDefault(); } });
        cf.addEventListener('click', function (event) { if (event.target === cf && !cfConfirm.disabled) { cf.close(); } });
        cf.addEventListener('close', function () { pending = null; });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) { resetConfirm(); if (cf.open) { cf.close(); } }
        });
    }

    /* ---------- Detail komentar ---------- */
    var dt = byId('detail-dialog');

    if (dt && typeof dt.showModal === 'function') {
        var badge = byId('dt-badge');
        var approveForm = byId('dt-approve-form');
        var rejectForm = byId('dt-reject-form');
        var articleLink = byId('dt-article');

        document.addEventListener('click', function (event) {
            var btn = event.target.closest ? event.target.closest('[data-detail]') : null;
            if (!btn) { return; }

            var status = btn.getAttribute('data-status');
            var reason = btn.getAttribute('data-reason');
            var url = btn.getAttribute('data-article-url');

            byId('dt-user').textContent = btn.getAttribute('data-user');
            byId('dt-date').textContent = btn.getAttribute('data-date');
            byId('dt-text').textContent = btn.getAttribute('data-text');

            articleLink.textContent = btn.getAttribute('data-article');
            if (url) { articleLink.setAttribute('href', url); } else { articleLink.removeAttribute('href'); }

            badge.textContent = btn.getAttribute('data-status-label');
            badge.className = 'badge badge--' + (['approved', 'pending', 'rejected'].indexOf(status) > -1 ? status : 'other');

            byId('dt-reason').textContent = reason || '';
            byId('dt-reason-box').hidden = !reason;

            approveForm.action = btn.getAttribute('data-update-url');
            rejectForm.action = btn.getAttribute('data-update-url');
            approveForm.hidden = status === 'approved';
            rejectForm.hidden = status === 'rejected';

            dt.showModal();
            byId('dt-close').focus();
        });

        byId('dt-close').addEventListener('click', function () { dt.close(); });
        dt.addEventListener('click', function (event) { if (event.target === dt) { dt.close(); } });
    }
})();
</script>
@endpush