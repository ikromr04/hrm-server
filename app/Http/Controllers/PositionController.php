<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
  public function index()
  {
    $positions = Position::get();
    
    return response($positions, 200);
  }
}
