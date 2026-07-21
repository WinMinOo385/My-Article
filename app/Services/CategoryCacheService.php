<?php

namespace App\Services;

use App\Models\Categories;
use Illuminate\Support\Facades\Cache;

class CategoryCacheService
{

    const CACHE_KEY = 'categories';
    

    const CACHE_DURATION = 3600;
    
    /**
     * get categories from cache or database
     * 
     * @return array
     */
    public function getCategories(): array
    {
        if (Cache::has(self::CACHE_KEY)) {
            return Cache::get(self::CACHE_KEY);
        }
        
        $categories = Categories::select('name', 'id')->get()->toArray();
        Cache::put(self::CACHE_KEY, $categories, self::CACHE_DURATION);
        
        return $categories;
    }
    
    /**
     * delete categories cache
     * 
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}