
@extends('layouts.dashboard')

@section('title', 'Pengajuan Penulis')

@section('content')
<style>
    .application-page {
        display: grid;
        gap: 22px;
    }

    .application-heading h1 {
        margin: 0 0 7px;
        color: var(--text, #1f2937);
        font-size: 25px;
        font-weight: 800;
    }

    .application-heading p {
        margin: 0;
        color: var(--muted, #6b7280);
        font-size: 14px;
        line-height: 1.6;
    }

    .application-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .application-stat {
        padding: 19px;
        background: var(--white, #fff);
        border: 1px solid var(--border, #e5e7eb);
        border-radius: 15px;
    }

    .application-stat span {
        display: block;
        color: var(--muted, #6b7280);
        font-size: 13px;
    }

    .application-stat strong {
        display: block;
        margin-top: 7px;
        color: var(--text, #1f2937);
        font-size: 25px;
        font-weight: 800;
    }

    .application-list {
        display: grid;
        gap: 16px;
    }

    .application-card {
        min-width: 0;
        padding: 22px;
        background: var(--white, #fff);
        border: 1px solid var(--border, #e5e7eb);
        border-radius: 17px;
    }

    .application-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 17px;
    }

    .application-person {
        min-width: 0;
    }

    .application-person h3 {
        margin: 0 0 5px;
        color: var(--text, #1f2937);
        font-size: 17px;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .application-person p {
        margin: 0;
        color: var(--muted, #6b7280);
        font-size: 13px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .application-status {
        flex-shrink: 0;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .status-pending {
        color: #9a6700;
        background: #fff4d6;
    }

    .status-approved {
        color: #167447;
        background: #dcfce7;
    }

    .status-rejected {
        color: #b42318;
        background: #fee4e2;
    }

    .application-details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 13px;
        margin-bottom: 17px;
    }

    .application-detail {
        min-width: 0;
        padding: 12px 14px;
        background: var(--background, #f8fafc);
        border-radius: 11px;
    }

    .application-detail span {
        display: block;
        margin-bottom: 5px;
        color: var(--muted, #6b7280);
        font-size: 11px;
    }

    .application-detail strong {
        color: var(--text, #1f2937);
        font-size: 13px;
        font-weight: 650;
        overflow-wrap: anywhere;
    }

    .application-reason {
        margin-bottom: 18px;
    }

    .application-reason h4 {
        margin: 0 0 8px;
        color: var(--text, #1f2937);
        font-size: 13px;
    }

    .application-reason p {
        margin: 0;
        padding: 14px;
        color: var(--text, #374151);
        background: var(--background, #f8fafc);
        border-radius: 11px;
        font-size: 13px;
        line-height: 1.7;
        white-space: pre-line;
        overflow-wrap: anywhere;
    }

    .application-note {
        margin-top: 13px;
        color: var(--muted, #6b7280);
        font-size: 12px;
        line-height: 1.7;
    }

    .application-note p {
        margin: 8px 0 0;
        padding: 11px 13px;
        color: var(--text, #374151);
        background: var(--background, #f8fafc);
        border-radius: 9px;
    }

    .application-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: flex-start;
    }

    .application-actions form {
        margin: 0;
    }

    .application-actions button {
        min-height: 40px;
        padding: 9px 15px;
        border: 0;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity .2s, transform .2s;
    }

    .application-actions button:hover {
        opacity: .9;
        transform: translateY(-1px);
    }

    .application-approve {
        color: #fff;
        background: #16834a;
    }

    .application-reject {
        flex-shrink: 0;
        color: #fff;
        background: #dc4444;
    }

    .application-reject-form {
        display: flex;
        flex: 1;
        min-width: 230px;
        gap: 8px;
    }

    .application-reject-form input {
        width: 100%;
        min-width: 0;
        min-height: 40px;
        padding: 9px 11px;
        border: 1px solid var(--border, #e5e7eb);
        border-radius: 9px;
        background: var(--white, #fff);
        color: var(--text, #1f2937);
        font-size: 12px;
    }

    .application-reject-form input:focus {
        outline: 2px solid rgba(37, 99, 235, .15);
        border-color: var(--primary, #2563eb);
    }

    .application-empty {
        padding: 45px 20px;
        text-align: center;
        color: var(--muted, #6b7280);
        background: var(--white, #fff);
        border: 1px dashed var(--border, #e5e7eb);
        border-radius: 16px;
    }

    .application-empty h3 {
        margin: 0 0 8px;
        color: var(--text, #1f2937);
        font-size: 17px;
    }

    .application-empty p {
        margin: 0;
        font-size: 13px;
    }

    .application-pagination {
        margin-top: 5px;
    }

    .application-pagination nav {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .application-pagination nav > div {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 9px;
    }

    .application-pagination nav a,
    .application-pagination nav span[aria-current="page"] span,
    .application-pagination nav span[aria-disabled="true"] span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        min-height: 40px;
        padding: 8px 12px;
        border: 1px solid var(--border, #e5e7eb);
        border-radius: 9px;
        font-size: 13px;
        font-weight: 650;
        text-decoration: none;
    }

    .application-pagination nav a {
        color: var(--text, #374151);
        background: var(--white, #fff);
    }

    .application-pagination nav a:hover {
        background: var(--background, #f8fafc);
    }

    .application-pagination nav span[aria-current="page"] span {
        color: #fff;
        background: var(--primary, #2563eb);
        border-color: var(--primary, #2563eb);
    }

    .application-pagination nav span[aria-disabled="true"] span {
        color: var(--muted, #9ca3af);
        background: var(--background, #f8fafc);
    }

    @media (max-width: 650px) {
        .application-summary {
            grid-template-columns: 1fr;
        }

        .application-details {
            grid-template-columns: 1fr;
        }

        .application-top {
            flex-direction: column;
        }

        .application-reject-form {
            flex-direction: column;
        }

        .application-reject-form button {
            width: 100%;
        }

        .application-actions > form:first-child,
        .application-actions > form:first-child button {
            width: 100%;
        }

        .application-reject-form {
            width: 100%;
            flex-basis: 100%;
        }

        .application-pagination nav > div {
            gap: 6px;
        }
    }

    @media (max-width: 380px) {
        .application-card {
            padding: 16px;
        }

        .application-stat {
            padding: 16px;
        }

        .application-heading h1 {
            font-size: 22px;
        }

        .application-pagination nav a,
        .application-pagination nav span[aria-current="page"] span,
        .application-pagination nav span[aria-disabled="true"] span {
            min-width: 35px;
            min-height: 36px;
            padding: 6px 9px;
        }
    }
</style>

<div class="application-page">

    <div class="application-heading">
        <h1>Pengajuan Menjadi Penulis</h1>
        <p>Periksa permohonan pengguna dan tentukan apakah mereka dapat bergabung sebagai penulis RuangKabar.</p>
    </div>

    <div class="application-summary">
        <div class="application-stat">
            <span>Menunggu Persetujuan</span>
            <strong>{{ $applications->getCollection()->where('status', 'pending')->count() }}</strong>
        </div>

        <div class="application-stat">
            <span>Total Pengajuan</span>
            <strong>{{ $applications->total() }}</strong>
        </div>

        <div class="application-stat">
            <span>Halaman</span>
            <strong>{{ $applications->currentPage() }} / {{ max(1, $applications->lastPage()) }}</strong>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="application-list">
        @forelse ($applications as $application)
            <article class="application-card">

                <div class="application-top">
                    <div class="application-person">
                        <h3>{{ $application->user->name ?? 'Pengguna tidak ditemukan' }}</h3>
                        <p>
                            {{ $application->user->username ?? '-' }}
                            · Diajukan {{ $application->created_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <span class="application-status status-{{ $application->status }}">
                        {{ [
                            'pending' => 'Menunggu',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                        ][$application->status] ?? ucfirst($application->status) }}
                    </span>
                </div>

                <div class="application-details">
                    <div class="application-detail">
                        <span>Nama Pengguna</span>
                        <strong>{{ $application->user->name ?? '-' }}</strong>
                    </div>

                    <div class="application-detail">
                        <span>Username</span>
                        <strong>{{ $application->user->username ?? '-' }}</strong>
                    </div>

                    <div class="application-detail">
                        <span>Email</span>
                        <strong>{{ $application->user->email ?? 'Belum diisi' }}</strong>
                    </div>

                    <div class="application-detail">
                        <span>Tanggal Pengajuan</span>
                        <strong>{{ $application->created_at?->format('d M Y, H:i') ?? '-' }}</strong>
                    </div>
                </div>

                <div class="application-reason">
                    <h4>Alasan Ingin Menjadi Penulis</h4>
                    <p>{{ $application->reason }}</p>
                </div>

                @if ($application->status === 'pending')
                    <div class="application-actions">

                        <form method="POST"
                            action="{{ route('admin.author-applications.approve', $application) }}"
                            onsubmit="return confirm('Setujui pengajuan ini dan ubah role pengguna menjadi penulis?')">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="application-approve">
                                Setujui Pengajuan
                            </button>
                        </form>

                        <form class="application-reject-form"
                            method="POST"
                            action="{{ route('admin.author-applications.reject', $application) }}"
                            onsubmit="return confirm('Tolak pengajuan menjadi penulis ini?')">
                            @csrf
                            @method('PATCH')

                            <input type="text"
                                name="admin_note"
                                maxlength="2000"
                                placeholder="Alasan penolakan (opsional)">

                            <button type="submit" class="application-reject">
                                Tolak Pengajuan
                            </button>
                        </form>

                    </div>
                @else
                    <div class="application-note">
                        Diproses oleh {{ $application->reviewer->name ?? 'Admin' }}
                        pada {{ $application->reviewed_at?->format('d M Y, H:i') ?? '-' }}

                        @if ($application->admin_note)
                            <p>Catatan admin: {{ $application->admin_note }}</p>
                        @endif
                    </div>
                @endif

            </article>
        @empty
            <div class="application-empty">
                <h3>Belum Ada Pengajuan</h3>
                <p>Pengajuan menjadi penulis dari pengguna akan muncul di halaman ini.</p>
            </div>
        @endforelse
    </div>

    @if ($applications->hasPages())
        <div class="application-pagination">
            {{ $applications->links('pagination::tailwind') }}
        </div>
    @endif

</div>
@endsection
