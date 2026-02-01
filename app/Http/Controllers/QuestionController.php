<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct(private QuestionService $service) { }

    public function index(){
        $questions = $this->service->getAll();
        return view('questions.index', compact('questions'));
    }

    public function show($id){
        $question = $this->service->getOne($id);
        $question->load('responses.user');
        return view('questions.show', compact('question'));
    }

    public function create(){
        return view('questions.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required'
        ]);

        $this->service->create($data);
        return redirect()->route('questions.index');
    }

    public function edit($id){
        $question = $this->service->getOne($id);
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'location' => 'required'
        ]);

        $this->service->update($id, $data);
        return redirect()->route('questions.show', $id)
                         ->with('success', 'Question modifiée');
    }

    public function destroy($id){
        $this->service->delete($id);
        return redirect()->route('questions.index');
    }
}
