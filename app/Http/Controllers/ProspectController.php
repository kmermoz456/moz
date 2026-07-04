<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProspectRequest;
use App\Models\Prospect;

class ProspectController extends Controller
{
    public function store(ProspectRequest $request)
    {
        Prospect::create($request->validated());

        return back()->with('success', 'Merci ! Nous vous recontactons très vite sur WhatsApp.');
    }
}
