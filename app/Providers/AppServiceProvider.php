<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_active', function ($attribute, $value, $parameters, $validator) {
            return User::where($parameters[0], $value)->active()->count();
        });

        Validator::extend('belongs_to_user', function ($attribute, $value, $parameters, $validator) {
            $user = auth()->user();
            if (!$user) {
                return false;
            }

            return DB::table($parameters[0])->where('id', $value)->where('user_id', $user->id)->count();
        });

        Validator::extend('unique_phone', function ($attribute, $value, $parameters, $validator) {
            $parameters[1] = isset($parameters[1]) ? $parameters[1] : 'phone';
            $value = '+' . preg_replace('~[^\d]~', '', $value);

            $query = DB::table($parameters[0])->where($parameters[1], $value);
            if (isset($parameters[2]) && isset($parameters[3])) {
                $query->where($parameters[2], '!=', $parameters[3]);
            }

            return !$query->count();
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
