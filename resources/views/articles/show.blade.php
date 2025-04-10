@extends('layouts/contentNavbarLayout')

@section('title', 'View Article')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card w-100" style="max-width: 1000px;"> <!-- limit width here -->
        <div class="card-body">
            <h5 class="card-title text-center">{{ $article->title }}</h5>
            <p><strong>Author:</strong> {{ $article->user->name ?? '-' }}</p>
            <p><strong>Status:</strong>
                @if ($article->status == 'published')
                    <span class="badge bg-success">Published</span>
                @elseif ($article->status == 'scheduled')
                    <span class="badge bg-warning">Scheduled</span>
                @else
                    <span class="badge bg-secondary">Draft</span>
                @endif
            </p>
            @if ($article->status == 'published')
            <p><strong>Published At:</strong> {{ $article->published_at ? $article->published_at->format('d-m-Y H:i') : '-' }}</p>
            @else
            <p><strong>Scheduled At:</strong> {{ $article->scheduled_at ? $article->scheduled_at->format('d-m-Y H:i') : '-' }}</p>
            @endif

            <hr>
            <div class="description-content">
              {!! $article->description !!}
          </div>

            <div class="mt-4">
              <a href="javascript:history.back()" class="btn btn-secondary btn-sm mx-1"><i class='bx bxs-direction-left'></i>&nbsp;Back to List</a>
              @if(auth()->user()->role === 'admin')
              <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary btn-sm"><i class='bx bxs-edit'></i>&nbsp;Edit</a>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection

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
