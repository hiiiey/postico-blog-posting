<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryTabs extends Component
{

    public function __construct() {}


    public function render(): View|Closure|string
    {
        $categories = Category::get();
        return view('components.category-tabs', [
            'categories' => $categories,
        ]);
    }
}
