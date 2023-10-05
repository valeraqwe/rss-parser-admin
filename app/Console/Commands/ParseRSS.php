<?php

namespace App\Console\Commands;

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
    public function handle()
    {
        $feed = new SimplePie();
        $feed->set_feed_url('https://lifehacker.com/rss');
        $feed->init();
        $feed->handle_content_type();

        foreach ($feed->get_items() as $item) {
            // Здесь будет код для сохранения каждой записи в базу данных
        }
    }

}
