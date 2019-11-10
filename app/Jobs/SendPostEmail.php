<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Post;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data= array(
            'title'=> $this->post->title,
            'title_link'=> $this->post->title_link,
            'content_post' => $this->post->content_post,
            'image' => $this->post->image,
        );

        Mail::send('emails.post', $data, function($message){
            $message->from('test1@gmail.com', 'Laravel Queues');
            $message->to('test2@gmail.com')->subject('There is a new post');
        });
    }
}