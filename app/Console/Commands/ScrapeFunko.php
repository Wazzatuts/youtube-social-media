<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;

class ScrapeFunko extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:funko';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Funko POP! Vinyl Scraper';

    /**
     * The list of funko collection slugs.
     *
     * @var array
     */
    protected $collections = [
        'animation',
        'disney',
        'games',
        'heroes',
        'marvel',
        'monster-high',
        'movies',
        'pets',
        'rocks',
        'sports',
        'star-wars',
        'television',
        'the-vault',
        'the-vote',
        'ufc',
    ];

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
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->collections as $collection) {
            $this->scrape($collection);
        }
    }

    /**
     * For scraping data for the specified collection.
     *
     * @param string $collection
     * @return boolean
     */
    public static function scrape($collection)
    {
        $goutte = new Client();
        $crawler = $goutte->request('GET', 'https://www.symfony.com/blog/');

        $link = $crawler->selectLink('Security Advisories')->link();
        $crawler = $goutte->click($link);

        $crawler->filter('h2 > a')->each(function ($node) {
            print $node->text()."\n";
        });

        return true;
    }
}
