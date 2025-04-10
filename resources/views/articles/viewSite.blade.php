@extends('layouts/contentNavbarLayout')

@section('title', 'CMS - Articles')

@section('content')
<div class="d-flex justify-content-center">
    <div class="w-100" style="max-width: 1000px;"> <!-- wrapper container -->
        @forelse ($articles as $article)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $article->title }}</h5>
                    <p><strong>Author:</strong> {{ $article->user->name ?? '-' }}</p>
                    <p><strong>Published At:</strong>
                        {{ $article->published_at ? $article->published_at->format('d-m-Y H:i') : '-' }}
                    </p>

                    <hr>
                    <div class="description-content">
                        {!! \Illuminate\Support\Str::limit($article->description, 300, '...') !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">No published articles found.</div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
  .description-content {
      max-width: 100%;
      overflow-x: auto;
      word-break: break-word;
  }

  .description-content figure.image {
      max-width: 100%;
      margin: 1rem auto;
      text-align: center;
  }

  .description-content figure.image img {
      max-width: 100%;
      height: auto;
      display: inline-block;
      object-fit: contain;
  }
</style>
@endpush
