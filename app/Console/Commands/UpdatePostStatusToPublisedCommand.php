<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Jobs\UpdatePostStatusToPublishedJob;
use App\Models\Post\Post;
use Illuminate\Console\Command;

class UpdatePostStatusToPublisedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-post:published';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::whereIn('status', [PostStatus::DRAFT, PostStatus::PLANNED])
            ->whereDate('published_at', '<=', now())->get();
        foreach ($posts as $post) {
            UpdatePostStatusToPublishedJob::dispatch($post);
        }
    }
}
