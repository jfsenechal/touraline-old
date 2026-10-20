<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Contracts\View\View;

final class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'concerts' => Concert::query()->ordered()->get(),
        ]);
    }
}
