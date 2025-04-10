<form action="{{ isset($article) ? route('articles.update', $article->id) : route('articles.store') }}" method="POST">
  @csrf
  @if(isset($article)) @method('PUT') @endif

  <div class="mb-3">
      <label for="title" class="form-label fw-bold">Title</label>
      <input type="text" class="form-control" id="title" name="title" required value="{{ old('title', $article->title ?? '') }}">
  </div>

  <div class="mb-3">
      <label for="description" class="form-label fw-bold">Description</label>
      <textarea id="description" name="description" class="form-control">{{ old('description', $article->description ?? '') }}</textarea>
  </div>

  <div class="mb-3">
      <label for="scheduled_at" class="form-label fw-bold">Scheduled Date & Time</label>
      <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at"
          value="{{ old('scheduled_at', isset($article->scheduled_at) ? $article->scheduled_at->format('Y-m-d\TH:i') : '') }}">
  </div>
  <div class="col-md-12 text-end">
    <button type="submit" class="btn btn-success btn-sm"><i class='bx bx-save' ></i> {{ isset($article) ? 'Update' : 'Submit' }}</button>
  </div>
</form>
