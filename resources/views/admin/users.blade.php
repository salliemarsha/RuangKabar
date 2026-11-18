
@extends('layouts.dashboard')

@section('title', 'Pengelolaan Pengguna')

@section('content')
    @php
        $n = fn ($v) => number_format($v, 0, ',', '.');
        $roleLabels = ['admin' => 'Admin', 'penulis' => 'Penulis', 'pengguna' => 'Pengguna'];
        $me = auth()->id();
        $totalAll = (int) $byRole->sum();
        $filtered = $search !== '' || $role !== '' || $status !== '';
        $initial = fn ($name) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($name, 0, 1));

        $reopen = null;

        if (old('_modal') === 'edit' && $errors->editUser->any()) {
            $reopen = [
                'modal' => 'edit',
                'user' => (int) old('_user'),
                'self' => (int) old('_user') === (int) $me,
            ];
        } elseif (old('_modal') === 'password' && $errors->resetPassword->any()) {
            $reopen = [
                'modal' => 'password',
                'user' => (int) old('_user'),
                'self' => (int) old('_user') === (int) $me,
            ];
        }
    @endphp

    <nav class="crumbs" aria-label="Breadcrumb">
        <ol>
            <li><a href="/admin/dashboard">Admin</a></li>
            <li aria-current="page">Pengguna</li>
        </ol>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="hero-inner">
            <span class="hero-label">PENGGUNA</span>
            <h1 class="hero-title" id="page-title">Pengelolaan Pengguna</h1>
            <p class="hero-lead">Kelola seluruh akun RuangKabar: ubah nama dan peran, aktifkan atau nonaktifkan akun, reset password, dan hapus akun.</p>
        </div>
    </section>

    @if (session('success'))
        <div class="flash" role="status">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="10" cy="10" r="8"/>
                <path d="M6.5 10.5l2.5 2.5 4.5-5"/>
            </svg>
            <p>{{ session('success') }}</p>
            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    @if (session('error') || $errors->getBag('default')->any())
        <div class="flash flash--error" role="alert">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10 2.5l8 14H2z"/>
                <path d="M10 8v4M10 14.5v.01"/>
            </svg>
            <p>{{ session('error') ?? $errors->getBag('default')->first() }}</p>
            <button class="flash-close" type="button" data-flash-close aria-label="Tutup pemberitahuan">&times;</button>
        </div>
    @endif

    @unless ($hasStatus)
        <div class="flash flash--note" role="note">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="10" cy="10" r="8"/>
                <path d="M10 6.5v4M10 13.5v.01"/>
            </svg>
            <p>Fitur status akun belum aktif karena kolom <strong>is_active</strong> belum ada. Jalankan <strong>php artisan migrate</strong> untuk mengaktifkannya. Fitur lainnya tetap berfungsi.</p>
        </div>
    @endunless

    <section class="ustats" aria-label="Ringkasan pengguna">
        <article class="ustat ustat--lead">
            <span class="ustat-label">Total Akun</span>
            <span class="ustat-value">{{ $n($totalAll) }}</span>
            <span class="ustat-note">{{ $inactive !== null ? $n($inactive) . ' akun nonaktif' : 'Seluruh akun terdaftar' }}</span>
        </article>

        <article class="ustat">
            <span class="ustat-label">Admin</span>
            <span class="ustat-value">{{ $n($byRole['admin'] ?? 0) }}</span>
            <span class="ustat-note">Pengelola portal</span>
        </article>

        <article class="ustat">
            <span class="ustat-label">Penulis</span>
            <span class="ustat-value">{{ $n($byRole['penulis'] ?? 0) }}</span>
            <span class="ustat-note">Penulis artikel</span>
        </article>

        <article class="ustat">
            <span class="ustat-label">Pengguna</span>
            <span class="ustat-value">{{ $n($byRole['pengguna'] ?? 0) }}</span>
            <span class="ustat-note">Pembaca dan komentator</span>
        </article>
    </section>

    <form class="filter" action="{{ route('admin.users.index') }}" method="GET" role="search">
        <div class="search">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
                <circle cx="9" cy="9" r="6"/>
                <path d="M14 14l4 4"/>
            </svg>
            <label class="sr-only" for="f-search">Cari nama atau email</label>
            <input id="f-search" type="search" name="search" value="{{ $search }}" placeholder="Cari nama atau email" autocomplete="off">
        </div>

        <label class="sr-only" for="f-role">Filter role</label>
        <select class="f-select" id="f-role" name="role">
            <option value="">Semua role</option>
            @foreach ($roleLabels as $key => $label)
                <option value="{{ $key }}" @selected($role === $key)>{{ $label }}</option>
            @endforeach
        </select>

        @if ($hasStatus)
            <label class="sr-only" for="f-status">Filter status</label>
            <select class="f-select" id="f-status" name="status">
                <option value="">Semua status</option>
                <option value="active" @selected($status === 'active')>Aktif</option>
                <option value="inactive" @selected($status === 'inactive')>Nonaktif</option>
            </select>
        @endif

        <button class="btn" type="submit">Cari</button>

        @if ($filtered)
            <a class="btn btn--ghost" href="{{ route('admin.users.index') }}">Reset</a>
        @endif
    </form>

    <div class="toolbar">
        <p class="result-info" aria-live="polite">
            @if ($users->count())
                Menampilkan <strong>{{ $users->firstItem() }}&ndash;{{ $users->lastItem() }}</strong> dari <strong>{{ $n($users->total()) }}</strong> pengguna
            @else
                Total hasil: <strong>0</strong> pengguna
            @endif
        </p>
    </div>

    @if ($users->count())
        <div class="panel">
            <div class="table-wrap">
                <table class="utable">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat Email</th>
                            <th scope="col">Role</th>
                            @if ($hasStatus)
                                <th scope="col">Status</th>
                            @endif
                            <th scope="col">Bergabung</th>
                            <th class="col-end" scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $u)
                            @php
                                $isSelf = (int) $u->id === (int) $me;
                                $isAdmin = $u->role === 'admin';
                                $hasArticles = (int) $u->articles_count > 0;
                                $active = $hasStatus ? (bool) ($u->is_active ?? true) : true;
                                $joined = $u->created_at
                                    ? $u->created_at->locale('id')->translatedFormat('d M Y')
                                    : '-';
                                $photoUrl = $u->profile_photo
                                    ? asset('storage/' . ltrim($u->profile_photo, '/'))
                                    : null;
                            @endphp

                            <tr
                                data-id="{{ $u->id }}"
                                data-name="{{ $u->name }}"
                                data-email="{{ $u->email }}"
                                data-photo="{{ $photoUrl }}"
                                data-role="{{ $u->role }}"
                                data-role-label="{{ $roleLabels[$u->role] ?? ucfirst($u->role) }}"
                                data-status="{{ $hasStatus ? ($active ? 'Aktif' : 'Nonaktif') : '' }}"
                                data-joined="{{ $joined }}"
                                data-articles="{{ $u->articles_count }}"
                                data-comments="{{ $u->comments_count }}"
                                data-self="{{ $isSelf ? '1' : '0' }}"
                                data-admin="{{ $isAdmin ? '1' : '0' }}"
                                data-update-url="{{ route('admin.users.update', $u) }}"
                                data-password-url="{{ route('admin.users.password', $u) }}"
                            >
                                <td data-label="Nama">
                                    <div class="u-name">
                                        <span class="u-avatar" aria-hidden="true">
                                            @if ($photoUrl)
                                                <img src="{{ $photoUrl }}" alt="" loading="lazy">
                                            @else
                                                {{ $initial($u->name) }}
                                            @endif
                                        </span>

                                        <span class="u-title">
                                            {{ $u->name }}
                                            @if ($isSelf)
                                                <span class="u-me">Anda</span>
                                            @endif
                                        </span>
                                    </div>
                                </td>

                                <td data-label="Alamat Email">
                                    <span class="slug">{{ $u->email ?: '-' }}</span>
                                </td>

                                <td data-label="Role">
                                    <span class="rbadge rbadge--{{ $u->role }}">{{ $roleLabels[$u->role] ?? ucfirst($u->role) }}</span>
                                </td>

                                @if ($hasStatus)
                                    <td data-label="Status">
                                        <span class="sbadge {{ $active ? 'sbadge--on' : 'sbadge--off' }}">
                                            {{ $active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                @endif

                                <td class="u-date" data-label="Bergabung">{{ $joined }}</td>

                                <td class="col-end">
                                    <div class="act-row">
                                        <button class="act" type="button" data-act="detail" title="Lihat detail" aria-label="Lihat detail {{ $u->name }}">
                                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M1.5 8S4 3.5 8 3.5 14.5 8 14.5 8 12 12.5 8 12.5 1.5 8 1.5 8z"/>
                                                <circle cx="8" cy="8" r="2"/>
                                            </svg>
                                            <span class="act__t">Detail</span>
                                        </button>

                                        @unless ($isAdmin)
                                            <button class="act act--edit" type="button" data-act="edit" title="Edit" aria-label="Edit {{ $u->name }}">
                                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M11 2.5l2.5 2.5L5.5 13H3v-2.5z"/>
                                                </svg>
                                                <span class="act__t">Edit</span>
                                            </button>

                                            <button class="act act--key" type="button" data-act="password" title="Reset password" aria-label="Reset password {{ $u->name }}">
                                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <circle cx="5.5" cy="10.5" r="2.5"/>
                                                    <path d="M7.4 8.6L13 3M11 5l1.5 1.5"/>
                                                </svg>
                                                <span class="act__t">Password</span>
                                            </button>
                                        @endunless

                                        @if ($hasStatus && ! $isSelf && ! $isAdmin)
                                            <form
                                                class="inline-form"
                                                action="{{ route('admin.users.status', $u) }}"
                                                method="POST"
                                                data-confirm
                                                data-variant="{{ $active ? 'warn' : 'ok' }}"
                                                data-title="{{ $active ? 'Nonaktifkan akun?' : 'Aktifkan akun?' }}"
                                                data-text="{{ $active ? 'Akun ini tidak akan bisa login atau mengakses halaman yang memerlukan login sampai diaktifkan kembali.' : 'Akun ini akan bisa login dan menggunakan RuangKabar kembali.' }}"
                                                data-label="{{ $active ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan' }}"
                                                data-snippet="{{ $u->name }}"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $active ? 'inactive' : 'active' }}">

                                                <button class="act {{ $active ? 'act--warn' : 'act--ok' }}" type="submit" title="{{ $active ? 'Nonaktifkan' : 'Aktifkan' }}" aria-label="{{ $active ? 'Nonaktifkan' : 'Aktifkan' }} akun {{ $u->name }}">
                                                    @if ($active)
                                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                                                            <circle cx="8" cy="8" r="5.5"/>
                                                            <path d="M4.2 11.8l7.6-7.6"/>
                                                        </svg>
                                                    @else
                                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M3 8.5l3.2 3.2L13 4.8"/>
                                                        </svg>
                                                    @endif
                                                    <span class="act__t">{{ $active ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                                                </button>
                                            </form>
                                        @endif

                                        @if (! $isSelf && ! $isAdmin && ! $hasArticles)
                                            <form
                                                class="inline-form"
                                                action="{{ route('admin.users.destroy', $u) }}"
                                                method="POST"
                                                data-confirm
                                                data-variant="danger"
                                                data-title="Hapus pengguna?"
                                                data-text="Akun akan dihapus secara permanen. Komentar milik akun ini juga akan dihapus. Tindakan ini tidak dapat dibatalkan."
                                                data-label="Ya, Hapus"
                                                data-snippet="{{ $u->name }}"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button class="act act--delete" type="submit" title="Hapus" aria-label="Hapus pengguna {{ $u->name }}">
                                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M2.5 4.5h11M6 4.5V3h4v1.5M4 4.5l.7 8.5h6.6l.7-8.5"/>
                                                    </svg>
                                                    <span class="act__t">Hapus</span>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($isAdmin)
                                            <span class="act__protected">Akun dilindungi</span>
                                        @elseif ($isSelf)
                                            <span class="act__protected">Akun Anda</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->hasPages())
            @php
                $current = $users->currentPage();
                $last = $users->lastPage();
                $window = collect(range(1, $last))
                    ->filter(fn ($p) => $p === 1 || $p === $last || abs($p - $current) <= 1)
                    ->values();
                $previous = null;
            @endphp

            <nav class="pager" aria-label="Navigasi halaman">
                @if ($users->onFirstPage())
                    <span class="pager-btn is-disabled" aria-disabled="true"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</span>
                @else
                    <a class="pager-btn" href="{{ $users->previousPageUrl() }}" rel="prev"><span aria-hidden="true">&larr;</span>&nbsp;Sebelumnya</a>
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
                                <a class="pager-num" href="{{ $users->url($page) }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                            @endif
                        </li>

                        @php $previous = $page; @endphp
                    @endforeach
                </ul>

                @if ($users->hasMorePages())
                    <a class="pager-btn" href="{{ $users->nextPageUrl() }}" rel="next">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></a>
                @else
                    <span class="pager-btn is-disabled" aria-disabled="true">Berikutnya&nbsp;<span aria-hidden="true">&rarr;</span></span>
                @endif

                <span class="pager-status">Halaman {{ $current }} dari {{ $last }}</span>
            </nav>
        @endif
    @elseif ($filtered)
        <div class="no-results">
            <strong>Pengguna tidak ditemukan.</strong>
            <p>Tidak ada pengguna yang cocok dengan pencarian atau filter Anda. Coba ubah kata kunci atau reset filter.</p>
            <a class="btn btn--ghost" href="{{ route('admin.users.index') }}">Reset filter</a>
        </div>
    @else
        <div class="empty">
            <strong>Belum ada pengguna.</strong>
            <p>Akun yang terdaftar akan tampil di sini.</p>
        </div>
    @endif

    <dialog class="dialog dialog--form" id="detail-dialog" aria-labelledby="dt-title">
        <div class="dt-head">
            <span class="u-avatar u-avatar--lg" id="dt-avatar" aria-hidden="true"></span>
            <div>
                <h2 id="dt-title"></h2>
                <p class="dt-user" id="dt-email"></p>
            </div>
        </div>

        <dl class="dt-meta">
            <div>
                <dt>Role</dt>
                <dd id="dt-role"></dd>
            </div>
            <div id="dt-status-box">
                <dt>Status akun</dt>
                <dd id="dt-status"></dd>
            </div>
            <div>
                <dt>Bergabung</dt>
                <dd id="dt-joined"></dd>
            </div>
            <div>
                <dt>Artikel</dt>
                <dd id="dt-articles"></dd>
            </div>
            <div>
                <dt>Komentar</dt>
                <dd id="dt-comments"></dd>
            </div>
        </dl>

        <p class="dt-note">Password tidak ditampilkan. Gunakan Reset Password untuk membuat password baru.</p>

        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" data-close>Tutup</button>
        </div>
    </dialog>

    <dialog class="dialog dialog--form" id="edit-dialog" aria-labelledby="edit-title">
        <h2 id="edit-title">Edit pengguna</h2>
        <p class="dlg-lead">Ubah nama lengkap atau role akun. Alamat email tidak dapat diubah melalui halaman ini.</p>

        <form id="edit-form" method="POST" action="" data-loading data-loading-text="Menyimpan…">
            @csrf
            @method('PUT')

            <input type="hidden" name="_modal" value="edit">
            <input type="hidden" name="_user" id="edit-user-id" value="{{ old('_modal') === 'edit' ? old('_user') : '' }}">

            <div class="field">
                <label for="edit-name">Nama Lengkap</label>
                <input id="edit-name" type="text" name="name" maxlength="100" required autocomplete="name" value="{{ old('_modal') === 'edit' ? old('name') : '' }}" class="{{ $errors->editUser->has('name') ? 'is-invalid' : '' }}">
                @if ($errors->editUser->has('name'))
                    <p class="field-error">{{ $errors->editUser->first('name') }}</p>
                @endif
            </div>

            <div class="field">
                <label for="edit-role">Role</label>
                <select id="edit-role" name="role" required class="{{ $errors->editUser->has('role') ? 'is-invalid' : '' }}">
                    <option value="penulis" @selected(old('_modal') === 'edit' && old('role') === 'penulis')>Penulis</option>
                    <option value="pengguna" @selected(old('_modal') === 'edit' && old('role') === 'pengguna')>Pengguna</option>
                </select>

                <input type="hidden" name="role" id="edit-role-hidden" disabled>

                @if ($errors->editUser->has('role'))
                    <p class="field-error">{{ $errors->editUser->first('role') }}</p>
                @endif

                <p class="hint" id="edit-role-note" hidden>Anda tidak dapat mengubah role akun Anda sendiri.</p>
            </div>

            <div class="dialog-actions">
                <button class="btn btn--ghost" type="button" data-close>Batal</button>
                <button class="btn" type="submit">Simpan</button>
            </div>
        </form>
    </dialog>

    <dialog class="dialog dialog--form" id="password-dialog" aria-labelledby="pw-title">
        <h2 id="pw-title">Reset password</h2>
        <p class="dlg-lead">Buat password baru untuk <strong id="pw-name"></strong>. Password lama tidak diperlukan.</p>

        <form id="password-form" method="POST" action="" data-loading data-loading-text="Menyimpan…" autocomplete="off">
            @csrf
            @method('PATCH')

            <input type="hidden" name="_modal" value="password">
            <input type="hidden" name="_user" id="pw-user-id" value="{{ old('_modal') === 'password' ? old('_user') : '' }}">

            <div class="field">
                <label for="pw-new">Password baru</label>
                <input id="pw-new" type="password" name="password" minlength="8" required autocomplete="new-password" class="{{ $errors->resetPassword->has('password') ? 'is-invalid' : '' }}">
                @if ($errors->resetPassword->has('password'))
                    <p class="field-error">{{ $errors->resetPassword->first('password') }}</p>
                @endif
                <p class="hint">Minimal 8 karakter.</p>
            </div>

            <div class="field">
                <label for="pw-confirm">Konfirmasi password baru</label>
                <input id="pw-confirm" type="password" name="password_confirmation" minlength="8" required autocomplete="new-password">
            </div>

            <div class="dialog-actions">
                <button class="btn btn--ghost" type="button" data-close>Batal</button>
                <button class="btn" type="submit">Reset Password</button>
            </div>
        </form>
    </dialog>

    <dialog class="dialog" id="confirm-dialog" aria-labelledby="cf-title" aria-describedby="cf-text">
        <div class="dialog-icon" id="cf-icon">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M8 2.5l6 10.5H2z"/>
                <path d="M8 6.5v3M8 11.5v.01"/>
            </svg>
        </div>

        <h2 id="cf-title"></h2>
        <blockquote class="cf-quote" id="cf-quote"></blockquote>
        <p id="cf-text"></p>

        <div class="dialog-actions">
            <button class="btn btn--ghost" type="button" id="cf-cancel" autofocus>Batal</button>
            <button class="btn" type="button" id="cf-confirm"></button>
        </div>
    </dialog>
@endsection

@push('styles')
<style>
.crumbs a { color: inherit; text-decoration: none; transition: color var(--t-fast) ease-out; }
.crumbs a:hover { color: var(--forest); }
.crumbs ol { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; margin: 0; padding: 0; list-style: none; }
.crumbs li { list-style: none; }

.flash--note { border-left-color: var(--gold); }
.flash--note svg { color: #8D7243; }

.ustats { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-bottom: 22px; }
.ustat { display: flex; flex-direction: column; min-width: 0; padding: 22px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.ustat-label { font-size: 13.5px; font-weight: 600; color: var(--text-soft); }
.ustat-value { display: block; margin-top: 8px; font-family: var(--serif); font-size: 38px; font-weight: 600; line-height: 1; color: var(--emerald); }
.ustat-note { margin-top: auto; padding-top: 12px; font-family: var(--body); font-size: 12.5px; color: var(--text-soft); }
.ustat--lead { background: var(--emerald); border-color: var(--emerald); }
.ustat--lead .ustat-label { color: var(--on-dark); }
.ustat--lead .ustat-value { color: var(--ivory); }
.ustat--lead .ustat-note { color: rgba(250, 248, 243, 0.62); }

.filter { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin: 0 0 18px; padding: 14px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.filter .search { max-width: none; flex: 1 1 260px; }
.filter .btn { height: 48px; }
.f-select { flex: 0 1 180px; height: 48px; padding: 0 40px 0 18px; font-family: var(--sans); font-size: 14px; font-weight: 600; color: var(--emerald); background-color: var(--ivory); background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 18px center; border: 1px solid var(--rule); border-radius: 999px; cursor: pointer; -webkit-appearance: none; appearance: none; transition: border-color var(--t-fast) ease-out, box-shadow var(--t-fast) ease-out; }
.f-select:hover { border-color: rgba(24, 60, 54, 0.3); }
.f-select:focus { outline: none; border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }

.panel { overflow: hidden; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 22px; }
.table-wrap { overflow-x: auto; }
.utable { width: 100%; min-width: 880px; border-collapse: collapse; }
.utable th { padding: 16px 18px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-align: left; text-transform: uppercase; white-space: nowrap; color: var(--text-soft); background: rgba(231, 224, 210, 0.45); border-bottom: 1px solid var(--rule); }
.utable td { padding: 16px 18px; vertical-align: middle; font-family: var(--body); font-size: 14px; color: var(--text); border-bottom: 1px solid rgba(24, 60, 54, 0.08); overflow-wrap: anywhere; }
.utable th:first-child, .utable td:first-child { padding-left: 24px; }
.utable th:last-child, .utable td:last-child { padding-right: 24px; }
.utable tbody tr:last-child td { border-bottom: 0; }
.utable tbody tr { transition: background var(--t-fast) ease-out; }
.utable tbody tr:hover { background: rgba(231, 224, 210, 0.3); }
.col-end { text-align: right; }
.col-end .act-row { justify-content: flex-end; flex-wrap: wrap; }

.u-name { display: flex; align-items: center; gap: 12px; min-width: 0; }
.u-avatar { display: flex; flex: none; align-items: center; justify-content: center; width: 38px; height: 38px; overflow: hidden; font-size: 14px; font-weight: 800; color: var(--emerald); background: var(--gold); border-radius: 50%; }
.u-avatar img { display: block; width: 100%; height: 100%; object-fit: cover; border-radius: inherit; }
.u-avatar--lg { width: 56px; height: 56px; font-family: var(--serif); font-size: 24px; font-weight: 600; }
.u-title { font-family: var(--serif); font-size: 17px; font-weight: 600; color: var(--emerald); overflow-wrap: anywhere; }
.u-me { display: inline-block; margin-left: 6px; padding: 2px 8px; font-family: var(--sans); font-size: 10.5px; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; color: var(--forest); background: rgba(55, 107, 92, 0.12); border-radius: 999px; vertical-align: middle; }
.u-date { white-space: nowrap; color: var(--text-soft); }

.rbadge, .sbadge { display: inline-flex; align-items: center; gap: 7px; padding: 4px 12px; font-size: 11.5px; font-weight: 700; white-space: nowrap; border-radius: 999px; }
.rbadge { letter-spacing: 0.08em; text-transform: uppercase; }
.rbadge--admin { color: var(--ivory); background: var(--emerald); }
.rbadge--penulis { color: var(--emerald); background: rgba(185, 154, 100, 0.3); }
.rbadge--pengguna { color: var(--forest); background: rgba(55, 107, 92, 0.12); }
.sbadge::before { content: ""; width: 6px; height: 6px; background: currentColor; border-radius: 50%; }
.sbadge--on { color: #1F5A47; background: rgba(55, 107, 92, 0.16); }
.sbadge--off { color: var(--danger); background: rgba(163, 57, 44, 0.12); }

.utable .act { justify-content: center; width: 38px; padding: 0; }
.act__t { position: absolute; width: 1px; height: 1px; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; }
.act--key:hover, .act--ok:hover { color: var(--white); background: var(--forest); border-color: var(--forest); }
.act--warn { color: #7A6130; }
.act--warn:hover { color: var(--white); background: #7A6130; border-color: #7A6130; }
.act__protected { display: inline-flex; align-items: center; min-height: 34px; padding: 0 10px; font-size: 11px; font-weight: 700; color: var(--text-soft); background: rgba(24, 60, 54, 0.06); border-radius: 999px; white-space: nowrap; }

.pager { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 12px 10px; margin-top: 28px; }
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

.dialog--form { width: min(520px, calc(100vw - 32px)); max-height: calc(100dvh - 32px); overflow-y: auto; }
.dlg-lead { margin: 0 0 20px !important; }
.dialog .field { margin-bottom: 18px; }
.dialog .field label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 700; color: var(--emerald); }
.dialog .field select { display: block; width: 100%; height: 52px; padding: 0 44px 0 18px; font-family: var(--body); font-size: 16px; color: var(--emerald); background-color: var(--ivory); background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none' stroke='%23376B5C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M1 1.5l5 5 5-5'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 18px center; border: 1px solid var(--rule); border-radius: 14px; cursor: pointer; -webkit-appearance: none; appearance: none; }
.dialog .field select:focus { outline: none; background-color: var(--white); border-color: var(--forest); box-shadow: 0 0 0 3px rgba(185, 154, 100, 0.4); }
.dialog .field select:disabled { opacity: 0.7; cursor: not-allowed; }
.dialog .field select.is-invalid { border-color: var(--danger); background-color: #FFFAF8; }
.dialog .hint { font-size: 13px; }
.dt-head { display: flex; align-items: center; gap: 16px; margin-bottom: 20px; }
.dt-head h2 { margin: 0; font-size: 24px; overflow-wrap: anywhere; }
.dt-user { margin-top: 2px !important; font-size: 14px !important; overflow-wrap: anywhere; }
.dt-meta { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px 20px; margin: 0 0 16px; padding: 18px; background: var(--ivory); border: 1px solid var(--rule); border-radius: 16px; }
.dt-meta dt { margin-bottom: 4px; font-size: 11px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-soft); }
.dt-meta dd { margin: 0; font-family: var(--body); font-size: 15px; font-weight: 600; color: var(--emerald); }
.dt-note { font-size: 13px !important; }
.cf-quote { margin: 0 0 12px; padding: 10px 14px; font-family: var(--body); font-size: 14px; font-weight: 600; color: var(--text); overflow-wrap: anywhere; background: var(--ivory); border-left: 3px solid var(--gold); border-radius: 10px; }
.cf-quote:empty { display: none; }
.dialog-icon.is-warn { color: #7A6130; background: rgba(185, 154, 100, 0.22); }
.dialog-icon.is-ok { color: var(--forest); background: rgba(55, 107, 92, 0.12); }
.btn--warn { background: #7A6130; }
.btn--warn:hover { background: #624E26; }
.btn:disabled { opacity: 0.65; cursor: progress; }

@media (max-width: 1023px) {
    .ustats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

@media (max-width: 767px) {
    .panel { background: transparent; border: 0; border-radius: 0; overflow: visible; }
    .table-wrap { overflow: visible; }
    .utable { min-width: 0; }
    .utable, .utable tbody, .utable tr, .utable td { display: block; width: 100%; }
    .utable thead { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0, 0, 0, 0); }
    .utable tbody tr { margin-bottom: 12px; padding: 16px; background: var(--white); border: 1px solid rgba(24, 60, 54, 0.08); border-radius: 18px; }
    .utable tbody tr:hover { background: var(--white); }
    .utable td, .utable td:first-child, .utable td:last-child { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 7px 0; border: 0; }
    .utable td[data-label]::before { content: attr(data-label); flex: 0 0 90px; font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-soft); }
    .utable td[data-label="Nama"] { padding-top: 0; }
    .utable td[data-label="Nama"]::before { display: none; }
    .utable td.col-end { display: block; margin-top: 6px; padding-top: 14px; border-top: 1px solid var(--rule); }
    .col-end .act-row { justify-content: stretch; }
    .col-end .act-row > *, .utable .act { flex: 1; width: auto; }
    .col-end .inline-form { display: flex; }
    .col-end .inline-form .act { flex: 1; }

    .pager { margin-top: 20px; }
    .pager-pages { display: none; }
    .pager-status { display: block; order: -1; width: 100%; text-align: center; }
    .pager-btn { flex: 1 1 0; padding: 0 10px; }
}

@media (max-width: 719px) {
    .ustat { padding: 18px; }
    .ustat-value { font-size: 32px; }
    .filter { padding: 12px; border-radius: 18px; }
    .f-select { flex: 1 1 100%; }
    .filter .btn { flex: 1 1 0; }
    .dt-meta { grid-template-columns: minmax(0, 1fr); }
}

@media (max-width: 420px) {
    .ustats { gap: 12px; }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    var byId = function (id) {
        return document.getElementById(id);
    };

    var canModal = typeof document.createElement('dialog').showModal === 'function';
    var tpl = @json(route('admin.users.update', ['user' => '__ID__']));
    var tplPw = @json(route('admin.users.password', ['user' => '__ID__']));
    var reopen = @json($reopen);

    var openDialog = function (dialog) {
        if (canModal && dialog) {
            dialog.showModal();
        }
    };

    var clearErrors = function (dialog) {
        [].forEach.call(dialog.querySelectorAll('.field-error'), function (element) {
            element.remove();
        });

        [].forEach.call(dialog.querySelectorAll('.is-invalid'), function (element) {
            element.classList.remove('is-invalid');
        });
    };

    [].forEach.call(document.querySelectorAll('dialog [data-close]'), function (button) {
        button.addEventListener('click', function () {
            button.closest('dialog').close();
        });
    });

    var detail = byId('detail-dialog');

    var fillDetail = function (tr) {
        var data = tr.dataset;
        var avatar = byId('dt-avatar');
        var fallback = data.name.charAt(0).toUpperCase();

        avatar.replaceChildren();

        if (data.photo) {
            var img = document.createElement('img');
            img.src = data.photo;
            img.alt = '';
            img.loading = 'lazy';

            img.addEventListener('error', function () {
                avatar.replaceChildren();
                avatar.textContent = fallback;
            });

            avatar.appendChild(img);
        } else {
            avatar.textContent = fallback;
        }

        byId('dt-title').textContent = data.name;
        byId('dt-email').textContent = data.email || '-';
        byId('dt-role').textContent = data.roleLabel;
        byId('dt-status').textContent = data.status;
        byId('dt-status-box').hidden = !data.status;
        byId('dt-joined').textContent = data.joined;
        byId('dt-articles').textContent = data.articles + ' artikel';
        byId('dt-comments').textContent = data.comments + ' komentar';
    };

    var edit = byId('edit-dialog');
    var editForm = byId('edit-form');

    var setEditRole = function (isSelf, role) {
        var select = byId('edit-role');
        var hidden = byId('edit-role-hidden');

        select.disabled = isSelf;
        hidden.disabled = !isSelf;
        hidden.value = role || select.value;

        byId('edit-role-note').hidden = !isSelf;
    };

    var fillEdit = function (tr) {
        var data = tr.dataset;

        if (data.admin === '1') {
            return;
        }

        clearErrors(edit);

        editForm.action = data.updateUrl;
        byId('edit-user-id').value = data.id;
        byId('edit-name').value = data.name;
        byId('edit-role').value = data.role;

        setEditRole(data.self === '1', data.role);
    };

    var passwordDialog = byId('password-dialog');
    var passwordForm = byId('password-form');

    var fillPassword = function (tr) {
        var data = tr.dataset;

        if (data.admin === '1') {
            return;
        }

        clearErrors(passwordDialog);

        passwordForm.action = data.passwordUrl;
        byId('pw-user-id').value = data.id;
        byId('pw-name').textContent = data.name;
        byId('pw-new').value = '';
        byId('pw-confirm').value = '';
    };

    document.addEventListener('click', function (event) {
        var button = event.target.closest ? event.target.closest('[data-act]') : null;

        if (!button) {
            return;
        }

        var tr = button.closest('tr');

        if (!tr) {
            return;
        }

        var action = button.getAttribute('data-act');

        if (action === 'detail') {
            fillDetail(tr);
            openDialog(detail);
        }

        if (action === 'edit' && tr.dataset.admin !== '1') {
            fillEdit(tr);
            openDialog(edit);
        }

        if (action === 'password' && tr.dataset.admin !== '1') {
            fillPassword(tr);
            openDialog(passwordDialog);
        }
    });

    if (reopen && reopen.user) {
        var row = document.querySelector('tr[data-id="' + reopen.user + '"]');

        if (row && row.dataset.admin !== '1') {
            if (reopen.modal === 'edit') {
                editForm.action = tpl.replace('__ID__', reopen.user);
                setEditRole(!!reopen.self, row.dataset.role);
                openDialog(edit);
            } else if (reopen.modal === 'password') {
                passwordForm.action = tplPw.replace('__ID__', reopen.user);
                byId('pw-name').textContent = row.dataset.name;
                openDialog(passwordDialog);
            }
        }
    }

    [].forEach.call(document.querySelectorAll('form[data-loading]'), function (form) {
        var submit = form.querySelector('button[type="submit"]');

        if (!submit) {
            return;
        }

        var label = submit.textContent;

        form.addEventListener('submit', function () {
            submit.disabled = true;
            submit.textContent = form.getAttribute('data-loading-text');
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                submit.disabled = false;
                submit.textContent = label;
            }
        });
    });

    var confirmDialog = byId('confirm-dialog');
    var confirmButton = byId('cf-confirm');
    var pending = null;

    document.addEventListener('submit', function (event) {
        var form = event.target;

        if (!form.hasAttribute || !form.hasAttribute('data-confirm')) {
            return;
        }

        if (!canModal) {
            if (!window.confirm(form.getAttribute('data-title') + ' ' + form.getAttribute('data-text'))) {
                event.preventDefault();
            }

            return;
        }

        event.preventDefault();
        pending = form;

        var variant = form.getAttribute('data-variant');

        byId('cf-title').textContent = form.getAttribute('data-title');
        byId('cf-text').textContent = form.getAttribute('data-text');
        byId('cf-quote').textContent = form.getAttribute('data-snippet') || '';
        byId('cf-icon').className = 'dialog-icon' + (
            variant === 'warn'
                ? ' is-warn'
                : (variant === 'ok' ? ' is-ok' : '')
        );

        confirmButton.textContent = form.getAttribute('data-label');
        confirmButton.className = 'btn ' + (
            variant === 'danger'
                ? 'btn--danger'
                : (variant === 'warn' ? 'btn--warn' : '')
        );
        confirmButton.disabled = false;

        confirmDialog.showModal();
    });

    byId('cf-cancel').addEventListener('click', function () {
        confirmDialog.close();
    });

    confirmButton.addEventListener('click', function () {
        if (!pending) {
            return;
        }

        confirmButton.disabled = true;
        confirmButton.textContent = 'Memproses…';
        pending.submit();
    });

    confirmDialog.addEventListener('cancel', function (event) {
        if (confirmButton.disabled) {
            event.preventDefault();
        }
    });

    confirmDialog.addEventListener('click', function (event) {
        if (event.target === confirmDialog && !confirmButton.disabled) {
            confirmDialog.close();
        }
    });

    confirmDialog.addEventListener('close', function () {
        pending = null;
    });

    detail.addEventListener('click', function (event) {
        if (event.target === detail) {
            detail.close();
        }
    });

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            confirmButton.disabled = false;

            if (confirmDialog.open) {
                confirmDialog.close();
            }
        }
    });
})();
</script>
@endpush
