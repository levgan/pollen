<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsRequest;

class QuestionsController extends Controller
{
    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('question_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('question_delete')) {
                return abort(401);
            }
            $questions = Question::onlyTrashed()->get();
        } else {
            $questions = Question::all();
        }

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('question_create')) {
            return abort(401);
        }
        
        $questiontypes = \App\Questiontype::get()->pluck('title', 'id');

        $options = \App\Option::get()->pluck('title', 'id');

        $polls = \App\Poll::get()->pluck('title', 'id');


        return view('admin.questions.create', compact('questiontypes', 'options', 'polls'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionsRequest $request)
    {
        if (! Gate::allows('question_create')) {
            return abort(401);
        }
        $question = Question::create($request->all());
        $question->questiontype()->sync(array_filter((array)$request->input('questiontype')));
        $question->option()->sync(array_filter((array)$request->input('option')));
        $question->poll()->sync(array_filter((array)$request->input('poll')));



        return redirect()->route('admin.questions.index');
    }


    /**
     * Show the form for editing Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('question_edit')) {
            return abort(401);
        }
        
        $questiontypes = \App\Questiontype::get()->pluck('title', 'id');

        $options = \App\Option::get()->pluck('title', 'id');

        $polls = \App\Poll::get()->pluck('title', 'id');


        $question = Question::findOrFail($id);

        return view('admin.questions.edit', compact('question', 'questiontypes', 'options', 'polls'));
    }

    /**
     * Update Question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionsRequest $request, $id)
    {
        if (! Gate::allows('question_edit')) {
            return abort(401);
        }
        $question = Question::findOrFail($id);
        $question->update($request->all());
        $question->questiontype()->sync(array_filter((array)$request->input('questiontype')));
        $question->option()->sync(array_filter((array)$request->input('option')));
        $question->poll()->sync(array_filter((array)$request->input('poll')));



        return redirect()->route('admin.questions.index');
    }


    /**
     * Display Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('question_view')) {
            return abort(401);
        }
        
        $questiontypes = \App\Questiontype::get()->pluck('title', 'id');

        $options = \App\Option::get()->pluck('title', 'id');

        $polls = \App\Poll::get()->pluck('title', 'id');
$polls = \App\Poll::whereHas('question',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$responses = \App\Response::where('question_id', $id)->get();$options = \App\Option::whereHas('question',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $question = Question::findOrFail($id);

        return view('admin.questions.show', compact('question', 'polls', 'responses', 'options'));
    }


    /**
     * Remove Question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->restore();

        return redirect()->route('admin.questions.index');
    }

    /**
     * Permanently delete Question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('question_delete')) {
            return abort(401);
        }
        $question = Question::onlyTrashed()->findOrFail($id);
        $question->forceDelete();

        return redirect()->route('admin.questions.index');
    }
}
