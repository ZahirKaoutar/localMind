<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  

    public function __construct(private AdminService $service){}

    public function index(){
        $stats = $this->service->getStats();
        $users = $this->service->getUsers();

        return view('admin.dashboard', compact('stats','users'));
    }
}


