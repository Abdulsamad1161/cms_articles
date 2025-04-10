<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Carbon\Carbon;

class PublishScheduledArticles extends Command
{
  protected $signature = 'articles:publish-scheduled';
  protected $description = 'Publish scheduled articles whose scheduled_at is due';

  public function handle()
  {
    $articles = Article::where('status', 'draft')
      ->where('scheduled_at', '<=', Carbon::now())
      ->get();

    foreach ($articles as $article) {
      $article->status = 'published';
      $article->published_at = Carbon::now();
      $article->save();

      $this->info("Published Article ID: {$article->id}");
    }

    return Command::SUCCESS;
  }
}
