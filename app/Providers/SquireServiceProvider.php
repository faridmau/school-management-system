<?php

namespace App\Providers;

use Squire\Repository;
use App\Models\Lookup\Country;
use Illuminate\Support\ServiceProvider;

// Add this class because need to use our custom model Country and State
class SquireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Repository::registerSource(Country::class, 'en', base_path('/vendor/squirephp/countries-en/resources/data.csv'));
        // Repository::registerSource(State::class, 'en', base_path('/vendor/squirephp/regions-en/resources/data.csv'));
        // Repository::registerSource(Timezone::class, 'en', base_path('/vendor/squirephp/timezones-en/resources/data.csv'));
    }
}
