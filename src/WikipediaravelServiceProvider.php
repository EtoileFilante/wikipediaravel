<?php
namespace EtoileFilante\Wikipediaravel;

use Illuminate\Support\ServiceProvider;
use EtoileFilante\Wikipediaravel\Wikipediaravel;

class WikipediaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Wikipediaravel::class, function () {
            return new Wikipediaravel(env('WIKIPEDIARAVEL_FORMAT','json'), env('WIKIPEDIARAVEL_LANG','fr'));
        });

        $this->app->alias(Wikipediaravel::class, 'wikipediaravel');
    }
}