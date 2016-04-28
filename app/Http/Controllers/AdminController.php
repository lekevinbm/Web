<?php

namespace App\Http\Controllers;

use App\Project as Project;

use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
      $project = new Project();
      $projecten = $project->getAll();
      return view('admin/index', ['projecten' => $projecten, 'title' => 'home']);
    }

    /*
      Als er een POST word verzonden steek dan waarden van formulier in database
      Als er geen POST is verzonden toon dan de creatie-pagina.
    */
    public function create(Request $request)
    {
      $project = new Project();

      if($request->isMethod('post')){

        $naam = $request->input('naam');
        $beschrijving = $request->input('beschrijving');
        $locatie = $request->input('locatie');

        $project->createNew($naam, $beschrijving, $locatie);

        return redirect('admin/');

      }

      $projecten = $project->getAll();
      return view('admin/project/new', ['projecten' => $projecten, 'title' => 'Nieuw Project']);
    }
}
