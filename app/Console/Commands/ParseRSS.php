<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use SimplePie;

class ParseRSS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:pars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse RSS Feed';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $feed = new SimplePie();
        $feed->set_feed_url('https://lifehacker.com/rss');
        $feed->init();
        $feed->handle_content_type();

        foreach ($feed->get_items() as $item) {
            Post::updateOrCreate(
                ['link' => $item->get_permalink()],
                [
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'published_at' => $item->get_date('Y-m-d H:i:s')
                ]
            );
        }
    }

}
