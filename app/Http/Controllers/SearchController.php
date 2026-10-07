<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search products catalog.
     */
    public function index(Request $request, ShopController $shopController): View
    {
        return $shopController->index($request);
    }
}
