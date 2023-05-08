<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
       $user = auth()->user();
       $team = $user->currentTeam;

        return Inertia::render('Dashboard/index');
    }

   
}
