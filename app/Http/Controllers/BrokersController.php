<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\DataBroker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrokersController extends Controller
{
    //
    public function index()
    {


        return view('brokers.index');
    }
}
