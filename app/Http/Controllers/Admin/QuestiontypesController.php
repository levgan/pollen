<?php

namespace App\Http\Controllers\Admin;

use App\Questiontype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestiontypesRequest;
use App\Http\Requests\Admin\UpdateQuestiontypesRequest;

class QuestiontypesController extends Controller
{
    /**
     * Display a listing of Questiontype.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('questiontype_access')) {
            return abort(401);
        }


                $questiontypes = Questiontype::all();

        return view('admin.questiontypes.index', compact('questiontypes'));
    }

    /**
     * Show the form for creating new Questiontype.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('questiontype_create')) {
            return abort(401);
        }
        
        $options = \App\Option::get()->pluck('title', 'id');


        return view('admin.questiontypes.create', compact('options'));
    }

    /**
     * Store a newly created Questiontype in storage.
     *
     * @param  \App\Http\Requests\StoreQuestiontypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestiontypesRequest $request)
    {
        if (! Gate::allows('questiontype_create')) {
            return abort(401);
        }
        $questiontype = Questiontype::create($request->all());
        $questiontype->option()->sync(array_filter((array)$request->input('option')));



        return redirect()->route('admin.questiontypes.index');
    }


    /**
     * Show the form for editing Questiontype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('questiontype_edit')) {
            return abort(401);
        }
        
        $options = \App\Option::get()->pluck('title', 'id');


        $questiontype = Questiontype::findOrFail($id);

        return view('admin.questiontypes.edit', compact('questiontype', 'options'));
    }

    /**
     * Update Questiontype in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestiontypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestiontypesRequest $request, $id)
    {
        if (! Gate::allows('questiontype_edit')) {
            return abort(401);
        }
        $questiontype = Questiontype::findOrFail($id);
        $questiontype->update($request->all());
        $questiontype->option()->sync(array_filter((array)$request->input('option')));



        return redirect()->route('admin.questiontypes.index');
    }


    /**
     * Display Questiontype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('questiontype_view')) {
            return abort(401);
        }
        
        $options = \App\Option::get()->pluck('title', 'id');
$questions = \App\Question::whereHas('questiontype',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$options = \App\Option::whereHas('questiontype',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $questiontype = Questiontype::findOrFail($id);

        return view('admin.questiontypes.show', compact('questiontype', 'questions', 'options'));
    }


    /**
     * Remove Questiontype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('questiontype_delete')) {
            return abort(401);
        }
        $questiontype = Questiontype::findOrFail($id);
        $questiontype->delete();

        return redirect()->route('admin.questiontypes.index');
    }

    /**
     * Delete all selected Questiontype at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('questiontype_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Questiontype::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
