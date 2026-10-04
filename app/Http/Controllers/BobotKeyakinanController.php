<?php

namespace App\Http\Controllers;

use App\Models\BobotKeyakinan;
use Illuminate\View\View;

class BobotKeyakinanController extends Controller
{
    /**
     * Display a listing of bobot keyakinan CF.
     */
    public function index(): View
    {
        $bobotList = BobotKeyakinan::orderBy('urutan')->get();

        return view('admin.bobot-keyakinan.index', compact('bobotList'));
    }
}
