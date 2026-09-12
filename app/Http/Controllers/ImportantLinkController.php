<?php

namespace App\Http\Controllers;

use App\Models\ImportantLink;
use Illuminate\View\View;

class ImportantLinkController extends Controller
{
    public function index(): View
    {
        $links = ImportantLink::active()->ordered()->get()->groupBy('category');
        return view('links.index', compact('links'));
    }
}
