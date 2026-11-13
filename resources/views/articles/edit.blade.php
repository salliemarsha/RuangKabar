@extends('layouts.dashboard')

@section('title', 'Edit Artikel')

@section('content')
    @php
        $mIsAdmin = auth()->user()->role === 'admin';
        $mDash = $mIsAdmin ? '/admin/dashboard' : '/penulis/dashboard';
    @endphp

    <nav class="crumbs" aria-label="Breadcrumb">
        <ol>
            <li><a href="{{ $mDash }}">{{ $mIsAdmin ? 'Admin' : 'Penulis' }}</a></li>
            <li><a href="{{ route('articles.index') }}">Artikel</a></li>
            <li aria-current="page">Edit</li>
        </ol>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="hero-inner">
            <a class="back-link" href="{{ route('articles.index') }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 8H3M7 4L3 8l4 4"/></svg>
                Kembali ke daftar artikel
            </a>
            <span class="hero-label">ARTIKEL</span>
            <h1 class="hero-title" id="page-title">Edit Artikel</h1>
            <p class="hero-lead">Perbarui isi dan pengaturan artikel. Gambar lama tetap dipakai kecuali Anda memilih gambar pengganti.</p>

            <div class="edit-meta">
                <span class="meta-chip"><strong>Slug</strong>{{ $article->slug }}</span>
                <span class="meta-chip"><strong>Status</strong>{{ ucfirst($article->status) }}</span>
                @if ($article->created_at)
                    <span class="meta-chip"><strong>Dibuat</strong>{{ $article->created_at->locale('id')->translatedFormat('d F Y') }}</span>
                @endif
            </div>
        </div>
    </section>

    @include('articles.form')
@endsection