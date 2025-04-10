@extends('layouts.landingPageLayout')

@section('title', 'CMS - Articles')

@section('layoutContent')
<div class="container mt-5">
    <div class="row">
        <div class="col text-center mb-4">
            <p class="lead">Explore our latest articles and insights.</p>
        </div>
    </div>
    <div class="row">
        @forelse ($articles as $article)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-light rounded">
                <div class="card-body-article-title">
                    <h5 class="card-title text-center mb-3" style="cursor: pointer;"
                        onclick="showArticleModal({{ $article->id }})">{{ $article->title }}</h5>
                </div>
                <div class="card-body">
                    <!-- Article Author and Published Date -->
                    <p class="card-subtitle text-muted text-center mb-3">
                        <strong>Author:</strong> {{ $article->user->name ?? 'Unknown' }} |
                        <strong>Published:</strong>
                        {{ $article->published_at ? $article->published_at->format('d-m-Y') : '-' }}
                    </p>
                    <hr>
                    <!-- Render Description with HTML content (including images) -->
                    <div class="description-content mb-3">
                        {!! \Illuminate\Support\Str::limit($article->description, 1000, '...') !!}
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm" onclick="showArticleModal({{ $article->id }})"
                                data-bs-toggle="modal" data-bs-target="#articleModal"><i
                                    class='bx bxs-show'></i>&nbsp;View
                                More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info w-100 text-center">No published articles found.</div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="articleModal" tabindex="-1" aria-labelledby="articleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articleModalLabel">Article Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5 id="modalArticleTitle"></h5>
                <p id="modalArticleAuthor"></p>
                <p id="modalArticleContent"></p>
                <div class="image-container">
                    <!-- Use a placeholder if no image exists -->
                    <img id="modalArticleImage" class="img-fluid" alt="Article Image" src="" style="display: none;" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
.description-content {
    max-width: 100%;
    overflow: hidden;
    word-break: break-word;
    font-size: 14px;
    line-height: 1.6;
    height: 350px;
    position: relative;
}

.description-content .image {
    max-width: 100%;
    margin: 1rem auto;
    text-align: center;
}

.description-content img {
    max-width: 100%;
    height: 150px;
    display: inline-block;
    object-fit: contain;
}

/* Hover effect on cards */
.card:hover {
    transform: scale(1.02);
    /* Less size increase */
    transition: transform 0.5s ease-in-out;
    /* Slower transition */
}

.container {
    padding: 20px;
}

.article-image img {
    max-width: 100%;
    height: auto;
    object-fit: cover;
}

/* Ellipsis for overflowed description */
.description-content::after {
    content: '...';
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    text-align: center;
    background: rgba(255, 255, 255, 0.8);
    padding: 5px;
    display: block;
}

.modal-body {
    max-height: 70vh;
    overflow-y: auto;
}

.card-body-article-title {
    padding: 17px;
    background: #60B5FF;
    border-radius: 10px 10px 0px 0px;
}

.card-body-article-title h5 {
    color: white !important;
    font-size: 18px !important;
}

.modal-body .image {
    max-width: 100%;
    margin: 1rem auto;
    text-align: center;
}

.modal-body img {
    max-width: 100%;
    height: 150px;
    display: inline-block;
    object-fit: contain;
}
</style>

<script>
var articles = @json($articles);

function showArticleModal(articleId) {
    // Find the article by its ID
    var article = articles.find(function(item) {
        return item.id === articleId;
    });

    // Populate modal fields
    document.getElementById('modalArticleTitle').innerText = article.title;
    document.getElementById('modalArticleContent').innerHTML = article.description;

    // Check if the article image exists
    var imageElement = document.getElementById('modalArticleImage');
    if (article.image && article.image !== "") {
        imageElement.src = article.image;
        imageElement.style.display = 'block'; // Show image
    } else {
        imageElement.src = ''; // Set source to empty if no image exists
        imageElement.style.display = 'none'; // Hide image
    }
}
</script>