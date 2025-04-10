@extends('layouts/contentNavbarLayout')

@section('title', ucfirst($type) . ' Articles')

@push('styles')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap5.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatables/css/buttons.bootstrap5.css') }}" rel="stylesheet">
<style>
    .dt-length {
        display: inline;
        margin-left: 1.5rem;
    }

    .dt-paging.paging_full_numbers {
        float: right;
    }

    .clear-float {
        clear: both;
    }

    @media (max-width: 767px) {
        .dt-length,
        .dt-paging.paging_full_numbers {
            float: none;
            margin: 1rem auto;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Articles /</span> {{ ucfirst($type) }} Article List</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bx bx-news"></i> Article List</h5>
        @if ($type == 'draft')
          @if(auth()->user()->role === 'admin')
              <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm"><i class='bx bx-plus-circle'></i>&nbsp;Add New Article</a>
          @endif
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="articleList" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Scheduled At</th>
                        <th class="text-center">Published At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->user->name ?? '-' }}</td>
                        <td>
                            @if ($article->status == 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif ($article->status == 'scheduled')
                                <span class="badge bg-warning">Scheduled</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $article->scheduled_at ? $article->scheduled_at->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $article->published_at ? $article->published_at->format('d-m-Y H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('articles.show', $article->id) }}" class="mx-1 btn btn-sm btn-info"><i class='bx bxs-show'></i></a>
                            @if(auth()->user()->role === 'admin')
                              <a href="{{ route('articles.edit', $article->id) }}" class="mx-1 btn btn-sm btn-primary"><i class='bx bx-edit' ></i></a>
                              <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $article->id }}"><i class='bx bx-trash' ></i></button>
                              <form id="delete-form-{{ $article->id }}" action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
