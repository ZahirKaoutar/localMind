<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function __construct(private ResponseService $service) { }

    // Ajouter une réponse
    public function store(Request $request, int $questionId)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        $this->service->create($data, $questionId);

        return redirect()->route('questions.show', $questionId)
                         ->with('success', 'Réponse ajoutée !');
    }
      public function edit($id){
        $rep = $this->service->getOne($id);
        return view('edite', compact('rep'));
    }

    // Modifier une réponse
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        $this->service->update($id, $data);

       
       return redirect()->route('questions.index');
                        
    }

    // Supprimer une réponse
    public function destroy(int $id)
    {
        $this->service->delete($id);

        return back()->with('success', 'Réponse supprimée !');
    }
}
