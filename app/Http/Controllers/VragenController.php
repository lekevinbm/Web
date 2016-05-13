<?php

namespace App\Http\Controllers;

use App\InspraakVraag;
use Illuminate\Http\Request;

use App\Http\Requests;

class VragenController extends Controller
{
    public function genereerVragen($aantal_vragen){
      $vraag = new InspraakVraag();

      $random_vragen = $vraag->getRandomVragen($aantal_vragen);

      return response()->json($random_vragen);
    }
}
