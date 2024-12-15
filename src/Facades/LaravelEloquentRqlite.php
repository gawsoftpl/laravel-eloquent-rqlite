<?php

namespace Gawsoft\LaravelEloquentRqlite\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gawsoft\LaravelEloquentRqlite\LaravelEloquentRqlite
 */
class LaravelEloquentRqlite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Gawsoft\LaravelEloquentRqlite\LaravelEloquentRqlite::class;
    }
}
