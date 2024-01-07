<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    SiteCategory,
    Site
};

class DatabaseSeeder extends Seeder
{
    protected const SITE_CATEGORIES = [
        ['name' => 'Cloud services',               'type' => 'cloud'],
        ['name' => 'Javascript libs / frameworks', 'type' => 'js'],
        ['name' => 'Mobile SDKs',                  'type' => 'mobile'],
        ['name' => 'PHP frameworks',               'type' => 'php']
    ];

    protected const SITES = [
        ['name' => 'Amazon AWS',      'type' => 'cloud',  'url' => 'https://aws.amazon.com',        'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Microsoft Azure', 'type' => 'cloud',  'url' => 'https://azure.microsoft.com',   'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Google Cloud',    'type' => 'cloud',  'url' => 'https://cloud.google.com',      'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Firebase',        'type' => 'cloud',  'url' => 'https://firebase.google.com',   'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Heroku',          'type' => 'cloud',  'url' => 'https://www.heroku.com',        'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Vercel',          'type' => 'cloud',  'url' => 'https://vercel.com',            'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Netlify',         'type' => 'cloud',  'url' => 'https://www.netlify.com',       'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Cloudflare',      'type' => 'cloud',  'url' => 'https://www.cloudflare.com',    'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Appwrite',        'type' => 'cloud',  'url' => 'https://appwrite.io',           'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Laravel',         'type' => 'php',    'url' => 'https://laravel.com',           'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Symfony',         'type' => 'php',    'url' => 'https://symfony.com',           'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Slim',            'type' => 'php',    'url' => 'https://www.slimframework.com', 'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'CakePHP',         'type' => 'php',    'url' => 'https://cakephp.org',           'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'React',           'type' => 'js',     'url' => 'https://react.dev',             'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Vue.js',          'type' => 'js',     'url' => 'https://vuejs.org',             'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Svelte',          'type' => 'js',     'url' => 'https://svelte.dev',            'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'React Native',    'type' => 'mobile', 'url' => 'https://reactnative.dev',       'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Flutter',         'type' => 'mobile', 'url' => 'https://flutter.dev',           'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
        ['name' => 'Iconic',          'type' => 'mobile', 'url' => 'https://ionicframework.com',    'image_url' => 'https://requiredev.s3.eu-west-2.amazonaws.com/devsites/amazon.png'],
    ];

    public function run()
    {
        $siteCategoryIds = $this->createSiteCategories();
        $this->createSites($siteCategoryIds);
    }

    protected function createSiteCategories(): array
    {
        $siteCategoryIds = [];

        foreach (self::SITE_CATEGORIES as $siteCategory) {
            $name = $siteCategory['name'];
            $type = $siteCategory['type'];

            $siteCategory = SiteCategory::create(['name' => $name]);
            $siteCategoryIds[$type] = $siteCategory->id;
        }
        return $siteCategoryIds;
    }

    protected function createSites(array $siteCategoryIds): void
    {
        foreach (self::SITES as $site) {
            $type           = $site['type'];
            $siteCategoryId = $siteCategoryIds[$type];

            $site = Site::create([
                'site_category_id' => $siteCategoryId,
                'name'             => $site['name'],
                'url'              => $site['url'],
                'image_url'        => $site['image_url']
            ]);
        }
    }
}
