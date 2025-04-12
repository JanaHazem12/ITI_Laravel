<?php

namespace App\Jobs;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class PruneOldPostsJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable, InteractsWithQueue,SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $post;

    public function __construct(Post $post)
    {
        $this->post=$post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        if($this->post->created_at->lt(Carbon::now()->subYears(2))){
            $this->post->delete();
        }

        // getting the posts that were created <= 2 years ago AND deleting them
        // $oldPosts = Post::where('created_at', '<=', Carbon::now()->subYears(2))->get();

        // // loop over ALL these posts and dispatch the job to delete them one by one
        // foreach ($oldPosts as $post) {
        //     $post->delete();
        // }
    }
}