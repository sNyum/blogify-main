@extends('layouts.app')

@section('title', $modul->judul)

@section('content')
    <h1>{{ $modul->judul }}</h1>
    <p>{{ $modul->deskripsi }}</p>

    @foreach ($modul->files as $file)
        <h3>{{ $file->judul }}</h3>

        <iframe
            src="{{ asset('storage/' . $file->file) }}"
            width="100%"
            height="600">
        </iframe>

        <br>
        <a href="{{ asset('storage/' . $file->file) }}" download>
            Download
        </a>

        <hr>
    @endforeach
@endsection
