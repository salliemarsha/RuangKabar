
@extends('layouts.dashboard')

@section('title', 'Pengaturan Akun')

@push('styles')
<style>
.st-hero-id { display:flex; flex-wrap:wrap; align-items:center; gap:12px 14px; margin-top:26px; }
.st-avatar { display:flex; flex:none; align-items:center; justify-content:center; width:48px; height:48px; overflow:hidden; font-family:var(--sans); font-size:18px; font-weight:800; color:var(--emerald); background:var(--gold); border-radius:50%; }
.st-avatar img { display:block; width:100%; height:100%; object-fit:cover; }
.st-id-text { display:flex; flex-direction:column; min-width:0; line-height:1.3; }
.st-id-text strong { font-family:var(--sans); font-size:15px; font-weight:700; color:var(--ivory); overflow-wrap:anywhere; }
.st-id-text span { font-family:var(--body); font-size:13px; color:var(--on-dark); overflow-wrap:anywhere; }
.st-role { display:inline-flex; align-items:center; padding:5px 12px; font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--ivory); background:rgba(250,248,243,.14); border:1px solid rgba(250,248,243,.25); border-radius:999px; }
.st-role--soft { color:var(--forest); background:rgba(55,107,92,.12); border-color:transparent; }
.st-layout { display:grid; grid-template-columns:200px minmax(0,1fr); gap:28px; align-items:start; }
.st-nav { position:sticky; top:calc(var(--hd-h) + 24px); display:flex; flex-direction:column; gap:4px; }
.st-nav-link { display:flex; align-items:center; gap:10px; min-height:42px; padding:0 12px; font-family:var(--sans); font-size:13.5px; font-weight:700; color:var(--text-soft); text-decoration:none; border-radius:12px; transition:color var(--t-fast) ease-out,background var(--t-fast) ease-out; }
.st-nav-link svg { flex:none; width:18px; height:18px; }
.st-nav-link:hover { color:var(--emerald); background:rgba(24,60,54,.05); }
.st-nav-link.is-on { color:var(--emerald); background:var(--white); box-shadow:inset 3px 0 0 var(--gold); }
.st-nav-link--danger.is-on { color:var(--danger); box-shadow:inset 3px 0 0 var(--danger); }
.st-stack { display:flex; flex-direction:column; gap:20px; min-width:0; }
.st-card { min-width:0; padding:28px; scroll-margin-top:calc(var(--hd-h) + 20px); background:var(--white); border:1px solid rgba(24,60,54,.08); border-radius:22px; }
.st-head { display:flex; align-items:flex-start; gap:14px; margin-bottom:24px; }
.st-icon { display:flex; flex:none; align-items:center; justify-content:center; width:42px; height:42px; color:var(--forest); background:rgba(55,107,92,.12); border-radius:14px; }
.st-icon svg { width:21px; height:21px; }
.st-title { margin:0; font-family:var(--serif); font-size:22px; font-weight:600; line-height:1.25; color:var(--emerald); }
.st-sub { margin:4px 0 0; font-family:var(--body); font-size:13.5px; line-height:1.6; color:var(--text-soft); }
.st-row { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; }
.st-field { min-width:0; margin-bottom:20px; }
.st-row .st-field { margin-bottom:0; }
.st-row + .st-rules { margin-top:20px; }
.st-wrap { position:relative; }
.st-wrap .st-ico { position:absolute; left:16px; top:26px; width:18px; height:18px; color:var(--forest); transform:translateY(-50%); pointer-events:none; }
.st-wrap .st-ico svg { display:block; width:100%; height:100%; }
.st-wrap input { padding-left:46px; }
.st-wrap.has-eye input { padding-right:52px; }
.st-eye { position:absolute; right:6px; top:6px; display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; padding:0; color:var(--text-soft); background:none; border:0; border-radius:12px; cursor:pointer; transition:color var(--t-fast) ease-out,background var(--t-fast) ease-out; }
.st-eye:hover { color:var(--emerald); background:var(--sand); }
.st-eye svg { display:block; width:19px; height:19px; }
.st-actions { margin-top:24px; padding-top:22px; border-top:1px solid var(--rule); }
.st-rules { display:flex; flex-wrap:wrap; gap:8px 22px; margin:0; padding:0; list-style:none; }
.st-rules li { display:flex; align-items:center; gap:8px; font-family:var(--body); font-size:13px; color:var(--text-soft); transition:color var(--t-fast) ease-out; }
.rule-dot { display:flex; align-items:center; justify-content:center; width:20px; height:20px; color:transparent; background:var(--sand); border-radius:50%; transition:color var(--t-fast) ease-out,background var(--t-fast) ease-out; }
.rule-dot svg { width:12px; height:12px; }
.st-rules li.is-ok { color:var(--forest); }
.st-rules li.is-ok .rule-dot { color:var(--white); background:var(--forest); }
.st-info { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:14px; margin:0; }
.st-info-item { display:flex; align-items:flex-start; gap:12px; min-width:0; padding:16px; background:var(--ivory); border:1px solid rgba(24,60,54,.08); border-radius:16px; }
.st-info-icon { display:flex; flex:none; align-items:center; justify-content:center; width:36px; height:36px; color:var(--emerald); background:rgba(185,154,100,.22); border-radius:12px; }
.st-info-icon svg { width:18px; height:18px; }
.st-info dt { margin:0 0 4px; font-family:var(--sans); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--text-soft); }
.st-info dd { margin:0; font-family:var(--body); font-size:14.5px; font-weight:600; color:var(--text); overflow-wrap:anywhere; }
.st-photo { display:flex; flex-wrap:wrap; align-items:center; gap:20px; margin-bottom:24px; padding:18px; background:var(--ivory); border:1px solid rgba(24,60,54,.08); border-radius:18px; }
.st-photo-preview { display:flex; flex:none; align-items:center; justify-content:center; width:88px; height:88px; overflow:hidden; color:var(--emerald); background:var(--gold); border-radius:50%; font-family:var(--sans); font-size:30px; font-weight:800; }
.st-photo-preview img { display:block; width:100%; height:100%; object-fit:cover; }
.st-photo-content { flex:1 1 220px; min-width:0; }
.st-photo-content strong { display:block; margin-bottom:5px; font-family:var(--sans); font-size:14px; color:var(--emerald); }
.st-photo-content p { margin:0; font-family:var(--body); font-size:13px; line-height:1.6; color:var(--text-soft); }
.st-photo-actions { display:flex; flex-wrap:wrap; gap:9px; margin-top:13px; }
.st-photo-actions .btn { min-height:38px; }
.st-photo-file { position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
.st-photo-file:focus-visible + label { outline:3px solid rgba(55,107,92,.3); outline-offset:3px; }
.st-photo-delete { margin:0; }
.st-photo-delete button { min-height:38px; padding:0 13px; font-size:12.5px; color:var(--danger); background:transparent; border:1px solid rgba(163,57,44,.25); border-radius:999px; cursor:pointer; }
.st-photo-delete button:hover { color:var(--white); background:var(--danger); border-color:var(--danger); }
.st-photo-error { width:100%; margin:0; font-family:var(--body); font-size:13px; color:var(--danger); }
.st-danger { background:#FFFCFB; border-color:rgba(163,57,44,.22); }
.st-danger .st-icon { color:var(--danger); background:var(--danger-soft); }
.st-danger .st-title { color:var(--danger); }
.st-danger-body { display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:16px 24px; }
.st-danger-text { flex:1 1 320px; margin:0; font-family:var(--body); font-size:14px; line-height:1.7; color:var(--text-soft); }
.st-danger-text strong { font-weight:600; color:var(--text); }
.st-btn-danger { color:var(--danger); background:var(--white); border-color:rgba(163,57,44,.35); }
.st-btn-danger:hover { color:var(--white); background:var(--danger); border-color:var(--danger); }
.st-confirm { margin-top:18px; }
.st-confirm label { display:block; margin-bottom:8px; font-family:var(--sans); font-size:13.5px; font-weight:700; color:var(--emerald); }
.st-confirm input { display:block; width:100%; height:48px; padding:0 16px; font-family:var(--body); font-size:15px; color:var(--emerald); background:var(--ivory); border:1px solid var(--rule); border-radius:14px; }
.st-confirm input:focus { outline:none; background:var(--white); border-color:var(--danger); box-shadow:0 0 0 3px rgba(163,57,44,.18); }
.st-dialog-note { margin-top:14px!important; padding:12px 14px; font-size:13.5px!important; color:var(--text)!important; background:var(--sand); border-radius:12px; }
.st-dialog-form { margin:0; }
.dialog .btn[disabled] { opacity:.45; cursor:not-allowed; }

@media (max-width:1099px) {
    .st-layout { grid-template-columns:minmax(0,1fr); gap:20px; }
    .st-nav { position:static; flex-direction:row; flex-wrap:wrap; gap:8px; }
    .st-nav-link { min-height:40px; padding:0 14px; background:var(--white); border:1px solid var(--rule); border-radius:999px; }
    .st-nav-link.is-on { box-shadow:none; color:var(--white); background:var(--emerald); border-color:var(--emerald); }
    .st-nav-link--danger.is-on { color:var(--white); background:var(--danger); border-color:var(--danger); }
    .st-info { grid-template-columns:repeat(2,minmax(0,1fr)); }
}

@media (max-width:719px) {
    .st-card { padding:22px 18px; border-radius:18px; }
    .st-row { grid-template-columns:minmax(0,1fr); gap:20px; }
    .st-info { grid-template-columns:minmax(0,1fr); }
    .st-actions .btn,.st-danger-body .btn { width:100%; }
    .st-nav-link { flex:1 1 calc(50% - 4px); justify-content:center; }
    .st-photo { align-items:flex-start; }
    .st-photo-actions { width:100%; }
}
</style>
@endpush

@section('content')

@php
    $role = $user->role;

    $roleLabels = [
        'admin' => 'Admin',
        'penulis' => 'Penulis',
        'pengguna' => 'Pengguna',
    ];

    $roleLabel = $roleLabels[$role] ?? ucfirst((string) $role);

    $initial = \Illuminate\Support\Str::upper(
        \Illuminate\Support\Str::substr($user->name ?: 'U', 0, 1)
    );

    $joined = $user->created_at
        ? \Illuminate\Support\Carbon::parse($user->created_at)->locale('id')->translatedFormat('d F Y')
        : '-';

    $canDelete = $user->role !== 'admin'
        && \Illuminate\Support\Facades\Route::has('account.destroy');

    $profilePhotoPath = $user->profile_photo;
    $profilePhotoUrl = null;
    $profilePhotoExists = false;

    if (is_string($profilePhotoPath) && trim($profilePhotoPath) !== '') {
        $profilePhotoPath = ltrim(str_replace('\\', '/', trim($profilePhotoPath)), '/');

        $disk = \Illuminate\Support\Facades\Storage::disk('public');

        try {
            $profilePhotoExists = $disk->exists($profilePhotoPath);

            if ($profilePhotoExists) {
                $profilePhotoUrl = '/storage/' . implode('/', array_map(
                    'rawurlencode',
                    explode('/', $profilePhotoPath)
                ));
            }
        } catch (\Throwable $exception) {
            $profilePhotoExists = false;
            $profilePhotoUrl = null;
        }
    }
@endphp

<section class="hero" aria-labelledby="page-title">
    <div class="hero-inner">
        <span class="hero-label">PENGATURAN AKUN</span>
        <h1 class="hero-title" id="page-title">Pengaturan Akun</h1>
        <p class="hero-lead">Kelola informasi profil dan keamanan akun Anda agar tetap akurat dan terlindungi.</p>

        <div class="st-hero-id">
            <span class="st-avatar" aria-hidden="true" data-avatar-fallback="{{ $initial }}">
                @if ($profilePhotoUrl)
                    <img src="{{ $profilePhotoUrl }}" alt="" data-profile-image>
                @else
                    {{ $initial }}
                @endif
            </span>

            <span class="st-id-text">
                <strong>{{ $user->name }}</strong>
                <span>{{ $user->email }}</span>
            </span>

            <span class="st-role">{{ $roleLabel }}</span>
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

<div class="st-layout">
    <nav class="st-nav" aria-label="Bagian pengaturan">
        <a class="st-nav-link is-on" href="#profil" data-spy="profil">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="7" r="3.2"/><path d="M3.5 17c0-3.4 2.9-5.5 6.5-5.5s6.5 2.1 6.5 5.5"/></svg>
            <span>Profil</span>
        </a>

        <a class="st-nav-link" href="#informasi" data-spy="informasi">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="7.5"/><path d="M10 9v4.5M10 6.5v.01"/></svg>
            <span>Informasi Akun</span>
        </a>

        <a class="st-nav-link" href="#keamanan" data-spy="keamanan">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="9" width="12" height="8" rx="2"/><path d="M7 9V6.5a3 3 0 016 0V9"/></svg>
            <span>Ubah Password</span>
        </a>

        @if ($canDelete)
            <a class="st-nav-link st-nav-link--danger" href="#hapus" data-spy="hapus">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h12M8 6V4h4v2M6 6l.7 10h6.6L14 6"/></svg>
                <span>Hapus Akun</span>
            </a>
        @endif
    </nav>

    <div class="st-stack">
        <section class="st-card" id="profil" aria-labelledby="profil-title">
            <header class="st-head">
                <span class="st-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="7" r="3.2"/><path d="M3.5 17c0-3.4 2.9-5.5 6.5-5.5s6.5 2.1 6.5 5.5"/></svg>
                </span>
                <div>
                    <h2 class="st-title" id="profil-title">Informasi Profil</h2>
                    <p class="st-sub">Perbarui foto profil dan nama lengkap akun Anda.</p>
                </div>
            </header>

            <div class="st-photo">
                <div class="st-photo-preview" id="photo-preview" data-avatar-fallback="{{ $initial }}">
                    @if ($profilePhotoUrl)
                        <img src="{{ $profilePhotoUrl }}" alt="Foto profil saat ini" data-profile-image>
                    @else
                        {{ $initial }}
                    @endif
                </div>

                <div class="st-photo-content">
                    <strong>Foto Profil</strong>
                    <p>Gunakan foto JPG, JPEG, PNG, atau WebP. Ukuran maksimal 2 MB.</p>

                    <div class="st-photo-actions">
                        <form action="{{ route('account.profile-photo.update') }}" method="POST" enctype="multipart/form-data" id="photo-form">
                            @csrf

                            <input
                                class="st-photo-file"
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                aria-label="Pilih foto profil"
                                required
                            >

                            <label class="btn" for="profile_photo">Pilih Foto</label>
                            <button class="btn" type="submit" id="photo-submit" hidden>Unggah Foto</button>
                        </form>

                        @if ($profilePhotoExists)
                            <form action="{{ route('account.profile-photo.destroy') }}" method="POST" class="st-photo-delete" onsubmit="return confirm('Hapus foto profil saat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus Foto</button>
                            </form>
                        @endif
                    </div>
                </div>

                @error('profile_photo')
                    <p class="st-photo-error">{{ $message }}</p>
                @enderror
            </div>

            <form action="{{ route('account.profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="field st-field">
                    <label for="name">Nama Lengkap</label>

                    <div class="st-wrap">
                        <span class="st-ico">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="7" r="3.2"/><path d="M3.5 17c0-3.4 2.9-5.5 6.5-5.5s6.5 2.1 6.5 5.5"/></svg>
                        </span>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            maxlength="100"
                            autocomplete="name"
                            required
                            class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                            @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                        >
                    </div>

                    @error('name')
                        <p class="field-error" id="name-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions st-actions">
                    <button class="btn" type="submit">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </section>

        <section class="st-card" id="informasi" aria-labelledby="informasi-title">
            <header class="st-head">
                <span class="st-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="10" cy="10" r="7.5"/><path d="M10 9v4.5M10 6.5v.01"/></svg>
                </span>
                <div>
                    <h2 class="st-title" id="informasi-title">Informasi Akun</h2>
                    <p class="st-sub">Ringkasan data akun Anda. Bagian ini hanya untuk dilihat.</p>
                </div>
            </header>

            <dl class="st-info">
                <div class="st-info-item">
                    <span class="st-info-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.5" y="4" width="15" height="12" rx="2"/><path d="m3.5 5 6.5 5 6.5-5"/></svg>
                    </span>
                    <div>
                        <dt>Alamat Email</dt>
                        <dd>{{ $user->email ?: '-' }}</dd>
                    </div>
                </div>

                <div class="st-info-item">
                    <span class="st-info-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l2 1.4 2.4-.2.9 2.3 2.1 1.2-.6 2.4.6 2.4-2.1 1.2-.9 2.3-2.4-.2-2 1.4-2-1.4-2.4.2-.9-2.3-2.1-1.2.6-2.4-.6-2.4 2.1-1.2.9-2.3 2.4.2z"/><path d="M7.5 10l2 2 3.5-4"/></svg>
                    </span>
                    <div>
                        <dt>Role</dt>
                        <dd><span class="st-role st-role--soft">{{ $roleLabel }}</span></dd>
                    </div>
                </div>

                <div class="st-info-item">
                    <span class="st-info-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="14" height="12.5" rx="2"/><path d="M3 8.5h14M7 2.5v3M13 2.5v3"/></svg>
                    </span>
                    <div>
                        <dt>Tanggal Bergabung</dt>
                        <dd>{{ $joined }}</dd>
                    </div>
                </div>
            </dl>
        </section>

        <section class="st-card" id="keamanan" aria-labelledby="keamanan-title">
            <header class="st-head">
                <span class="st-icon">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="9" width="12" height="8" rx="2"/><path d="M7 9V6.5a3 3 0 016 0V9"/></svg>
                </span>
                <div>
                    <h2 class="st-title" id="keamanan-title">Ubah Password</h2>
                    <p class="st-sub">Gunakan password yang kuat dan jangan dibagikan kepada siapa pun.</p>
                </div>
            </header>

            <form action="{{ route('account.password.update') }}" method="POST" id="password-form">
                @csrf
                @method('PATCH')

                <div class="field st-field">
                    <label for="current_password">Password Lama</label>

                    <div class="st-wrap has-eye">
                        <span class="st-ico">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="7" cy="12" r="3.5"/><path d="M9.5 9.5L16 3M13.5 5.5l2 2"/></svg>
                        </span>

                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            autocomplete="current-password"
                            required
                            class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                            @if ($errors->has('current_password')) aria-invalid="true" aria-describedby="current-error" @endif
                        >

                        <button class="st-eye" type="button" data-eye aria-label="Tampilkan password lama" aria-pressed="false">
                            <span class="eye-on">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.8 10S5 4.5 10 4.5 18.2 10 18.2 10 15 15.5 10 15.5 1.8 10 1.8 10z"/><circle cx="10" cy="10" r="2.5"/></svg>
                            </span>
                            <span class="eye-off" hidden>
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 2.5l15 15M8.2 4.8A8 8 0 0110 4.5c5 0 8.2 5.5 8.2 5.5a14 14 0 01-2.6 3.2M5.2 6.2A14 14 0 001.8 10S5 15.5 10 15.5a8 8 0 003-.6"/><path d="M8.3 8.3a2.5 2.5 0 003.4 3.4"/></svg>
                            </span>
                        </button>
                    </div>

                    @error('current_password')
                        <p class="field-error" id="current-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="st-row">
                    <div class="field st-field">
                        <label for="password">Password Baru</label>

                        <div class="st-wrap has-eye">
                            <span class="st-ico">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="9" width="12" height="8" rx="2"/><path d="M7 9V6.5a3 3 0 016 0V9"/></svg>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                minlength="8"
                                autocomplete="new-password"
                                required
                                aria-describedby="password-rules{{ $errors->has('password') ? ' password-error' : '' }}"
                                class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                                @if ($errors->has('password')) aria-invalid="true" @endif
                            >

                            <button class="st-eye" type="button" data-eye aria-label="Tampilkan password baru" aria-pressed="false">
                                <span class="eye-on">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.8 10S5 4.5 10 4.5 18.2 10 18.2 10 15 15.5 10 15.5 1.8 10 1.8 10z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                </span>
                                <span class="eye-off" hidden>
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 2.5l15 15M8.2 4.8A8 8 0 0110 4.5c5 0 8.2 5.5 8.2 5.5a14 14 0 01-2.6 3.2M5.2 6.2A14 14 0 001.8 10S5 15.5 10 15.5a8 8 0 003-.6"/><path d="M8.3 8.3a2.5 2.5 0 003.4 3.4"/></svg>
                                </span>
                            </button>
                        </div>

                        @error('password')
                            <p class="field-error" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field st-field">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>

                        <div class="st-wrap has-eye">
                            <span class="st-ico">
                                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="9" width="12" height="8" rx="2"/><path d="M7 9V6.5a3 3 0 016 0V9"/></svg>
                            </span>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                autocomplete="new-password"
                                required
                            >

                            <button class="st-eye" type="button" data-eye aria-label="Tampilkan konfirmasi password" aria-pressed="false">
                                <span class="eye-on">
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1.8 10S5 4.5 10 4.5 18.2 10 18.2 10 15 15.5 10 15.5 1.8 10 1.8 10z"/><circle cx="10" cy="10" r="2.5"/></svg>
                                </span>
                                <span class="eye-off" hidden>
                                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 2.5l15 15M8.2 4.8A8 8 0 0110 4.5c5 0 8.2 5.5 8.2 5.5a14 14 0 01-2.6 3.2M5.2 6.2A14 14 0 001.8 10S5 15.5 10 15.5a8 8 0 003-.6"/><path d="M8.3 8.3a2.5 2.5 0 003.4 3.4"/></svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <ul class="st-rules" id="password-rules" aria-live="polite">
                    <li data-rule="length">
                        <span class="rule-dot">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>
                        </span>
                        Password baru minimal 8 karakter
                    </li>

                    <li data-rule="match">
                        <span class="rule-dot">
                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 10.5l3.5 3.5 7.5-8"/></svg>
                        </span>
                        Konfirmasi sama dengan password baru
                    </li>
                </ul>

                <div class="form-actions st-actions">
                    <button class="btn" type="submit">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l6 2.2v5c0 3.6-2.5 6.2-6 7.8-3.5-1.6-6-4.2-6-7.8v-5z"/><path d="M7.5 10l2 2 3.5-4"/></svg>
                        Ubah Password
                    </button>
                </div>
            </form>
        </section>

        @if ($canDelete)
            <section class="st-card st-danger" id="hapus" aria-labelledby="hapus-title">
                <header class="st-head">
                    <span class="st-icon">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
                    </span>
                    <div>
                        <h2 class="st-title" id="hapus-title">Hapus Akun</h2>
                        <p class="st-sub">Tindakan ini berisiko dan terpisah dari pengaturan lainnya.</p>
                    </div>
                </header>

                <div class="st-danger-body">
                    <p class="st-danger-text"><strong>Penghapusan akun bersifat permanen dan tidak dapat dibatalkan.</strong> Seluruh data akun Anda akan dihapus sesuai aturan sistem dan Anda tidak dapat masuk lagi menggunakan akun ini.</p>

                    <button class="btn st-btn-danger" type="button" id="open-delete" aria-haspopup="dialog">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h12M8 6V4h4v2M6 6l.7 10h6.6L14 6"/></svg>
                        Hapus Akun
                    </button>
                </div>
            </section>
        @endif
    </div>
</div>

@if ($canDelete)
    <dialog class="dialog" id="delete-dialog" aria-labelledby="delete-title" aria-describedby="delete-desc">
        <form class="st-dialog-form" action="{{ route('account.destroy') }}" method="POST" id="delete-form">
            @csrf
            @method('DELETE')

            <span class="dialog-icon" aria-hidden="true">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2.5l8 14H2z"/><path d="M10 8v4M10 14.5v.01"/></svg>
            </span>

            <h2 id="delete-title">Hapus akun Anda?</h2>
            <p id="delete-desc">Akun <strong>{{ $user->email }}</strong> akan dihapus secara permanen dan tidak dapat dipulihkan.</p>

            <div class="st-confirm">
                <label for="delete-confirm">Ketik <strong>HAPUS</strong> untuk melanjutkan</label>
                <input type="text" id="delete-confirm" name="confirmation" autocomplete="off" autocapitalize="characters" spellcheck="false" required>
            </div>

            <p class="st-dialog-note">Pastikan Anda sudah memahami konsekuensi penghapusan akun sebelum melanjutkan.</p>

            <div class="dialog-actions">
                <button class="btn btn--ghost" type="button" id="cancel-delete">Batal</button>
                <button class="btn btn--danger" type="submit" id="confirm-delete" disabled>Ya, Hapus Akun</button>
            </div>
        </form>
    </dialog>
@endif

@endsection

@push('scripts')
<script>
(function () {
    document.querySelectorAll('[data-eye]').forEach(function (btn) {
        var input = btn.parentNode.querySelector('input');
        var on = btn.querySelector('.eye-on');
        var off = btn.querySelector('.eye-off');
        var label = btn.getAttribute('aria-label').replace('Tampilkan', '').trim();

        btn.addEventListener('click', function () {
            var show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            on.hidden = show;
            off.hidden = !show;

            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', (show ? 'Sembunyikan ' : 'Tampilkan ') + label);
        });
    });

    var newPass = document.getElementById('password');
    var confirmPass = document.getElementById('password_confirmation');
    var ruleLength = document.querySelector('[data-rule="length"]');
    var ruleMatch = document.querySelector('[data-rule="match"]');

    if (newPass && confirmPass && ruleLength && ruleMatch) {
        var checkRules = function () {
            ruleLength.classList.toggle('is-ok', newPass.value.length >= 8);
            ruleMatch.classList.toggle('is-ok', confirmPass.value.length > 0 && confirmPass.value === newPass.value);
        };

        newPass.addEventListener('input', checkRules);
        confirmPass.addEventListener('input', checkRules);
        checkRules();
    }

    function setAvatarFallback(element) {
        if (!element) {
            return;
        }

        var initial = element.getAttribute('data-avatar-fallback');
        element.innerHTML = '';
        element.textContent = initial || 'U';
    }

    document.querySelectorAll('[data-profile-image]').forEach(function (image) {
        image.addEventListener('error', function () {
            setAvatarFallback(image.parentElement);
        });

        if (image.complete && image.naturalWidth === 0) {
            setAvatarFallback(image.parentElement);
        }
    });

    var photoInput = document.getElementById('profile_photo');
    var photoPreview = document.getElementById('photo-preview');
    var photoForm = document.getElementById('photo-form');

    if (photoInput && photoPreview && photoForm) {
        var originalPreview = photoPreview.innerHTML;
        var photoSubmit = document.getElementById('photo-submit');
        var previewUrl = null;

        photoInput.addEventListener('change', function () {
            var file = photoInput.files && photoInput.files[0];

            if (!file) {
                return;
            }

            var allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

            if (!allowedTypes.includes(file.type)) {
                alert('Format foto harus JPG, JPEG, PNG, atau WebP.');
                photoInput.value = '';
                photoPreview.innerHTML = originalPreview;

                if (photoSubmit) {
                    photoSubmit.hidden = true;
                }

                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2 MB.');
                photoInput.value = '';
                photoPreview.innerHTML = originalPreview;

                if (photoSubmit) {
                    photoSubmit.hidden = true;
                }

                return;
            }

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }

            previewUrl = URL.createObjectURL(file);
            photoPreview.innerHTML = '';

            var image = document.createElement('img');
            image.src = previewUrl;
            image.alt = 'Pratinjau foto profil';

            photoPreview.appendChild(image);

            if (photoSubmit) {
                photoSubmit.hidden = false;
                photoSubmit.disabled = false;
                photoSubmit.textContent = 'Unggah Foto';
            }
        });

        photoForm.addEventListener('submit', function (event) {
            if (!photoInput.files || !photoInput.files.length) {
                event.preventDefault();
                alert('Pilih foto profil terlebih dahulu.');
                return;
            }

            if (photoSubmit) {
                photoSubmit.disabled = true;
                photoSubmit.textContent = 'Mengunggah...';
            }
        });
    }

    var spyLinks = [].slice.call(document.querySelectorAll('[data-spy]'));

    var setActive = function (id) {
        spyLinks.forEach(function (link) {
            link.classList.toggle('is-on', link.getAttribute('data-spy') === id);
        });
    };

    if ('IntersectionObserver' in window && spyLinks.length) {
        var spy = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActive(entry.target.id);
                }
            });
        }, {
            rootMargin: '-25% 0px -60% 0px',
            threshold: 0
        });

        spyLinks.forEach(function (link) {
            var target = document.getElementById(link.getAttribute('data-spy'));

            if (target) {
                spy.observe(target);
            }
        });
    }

    var dialog = document.getElementById('delete-dialog');
    var openBtn = document.getElementById('open-delete');
    var cancelBtn = document.getElementById('cancel-delete');
    var confirmBtn = document.getElementById('confirm-delete');
    var confirmInput = document.getElementById('delete-confirm');

    if (dialog && openBtn && cancelBtn && confirmBtn && confirmInput && typeof dialog.showModal === 'function') {
        var reset = function () {
            confirmInput.value = '';
            confirmBtn.disabled = true;
        };

        var checkDeleteConfirmation = function () {
            confirmBtn.disabled = confirmInput.value.trim() !== 'HAPUS';
        };

        openBtn.addEventListener('click', function () {
            reset();
            dialog.showModal();
            confirmInput.focus();
        });

        cancelBtn.addEventListener('click', function () {
            dialog.close();
        });

        dialog.addEventListener('close', function () {
            reset();
            openBtn.focus();
        });

        confirmInput.addEventListener('input', checkDeleteConfirmation);

        var deleteForm = document.getElementById('delete-form');

        if (deleteForm) {
            deleteForm.addEventListener('submit', function (event) {
                if (confirmInput.value.trim() !== 'HAPUS') {
                    event.preventDefault();
                    checkDeleteConfirmation();
                    return;
                }

                confirmBtn.disabled = true;
            });
        }
    }

    var invalid = document.querySelector('.is-invalid');

    if (invalid) {
        invalid.focus();
    }
})();
</script>
@endpush
