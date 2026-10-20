<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Contracts\View\View;

final class ConcertController extends Controller
{
    public function show(Concert $concert): View
    {
        return view('concerts.show', [
            'concert' => $concert,
        ]);
    }
}
