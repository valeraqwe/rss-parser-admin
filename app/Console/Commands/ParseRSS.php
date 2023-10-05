<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Feed\Feed;

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
        $feed = Feed::loadRss('https://lifehacker.com/rss');

        foreach ($feed->item as $item) {
            Post::updateOrCreate(
                ['link' => (string) $item->link],
                [
                    'title' => (string) $item->title,
                    'description' => (string) $item->description,
                    'published_at' => (string) $item->pubDate
                ]
            );
        }
    }

}
