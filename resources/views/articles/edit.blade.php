@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Article')

@section('content')
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Articles /</span> Edit Article</h4>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bx bx-news"></i> Edit New Article</h5>
        <a href="javascript:history.back()" class="btn btn-secondary btn-sm"><i class='bx bxs-direction-left'></i>&nbsp;Back to List</a>
    </div>
    <div class="card-body">
      @include('articles.form', ['article' => $article])
    </div>
  </div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
          .create(document.querySelector('#description'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
            }
          })
          .catch(error => {
            console.error(error);
          });
    });
</script>
