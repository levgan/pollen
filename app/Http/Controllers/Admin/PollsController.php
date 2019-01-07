<?php

namespace App\Http\Controllers\Admin;

use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePollsRequest;
use App\Http\Requests\Admin\UpdatePollsRequest;

class PollsController extends Controller
{
    /**
     * Display a listing of Poll.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('poll_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('poll_delete')) {
                return abort(401);
            }
            $polls = Poll::onlyTrashed()->get();
        } else {
            $polls = Poll::all();
        }

        return view('admin.polls.index', compact('polls'));
    }

    /**
     * Show the form for creating new Poll.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('poll_create')) {
            return abort(401);
        }
        
        $questions = \App\Question::get()->pluck('title', 'id');


        return view('admin.polls.create', compact('questions'));
    }

    /**
     * Store a newly created Poll in storage.
     *
     * @param  \App\Http\Requests\StorePollsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePollsRequest $request)
    {
        if (! Gate::allows('poll_create')) {
            return abort(401);
        }
        $poll = Poll::create($request->all());
        $poll->question()->sync(array_filter((array)$request->input('question')));



        return redirect()->route('admin.polls.index');
    }


    /**
     * Show the form for editing Poll.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('poll_edit')) {
            return abort(401);
        }
        
        $questions = \App\Question::get()->pluck('title', 'id');


        $poll = Poll::findOrFail($id);

        return view('admin.polls.edit', compact('poll', 'questions'));
    }

    /**
     * Update Poll in storage.
     *
     * @param  \App\Http\Requests\UpdatePollsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePollsRequest $request, $id)
    {
        if (! Gate::allows('poll_edit')) {
            return abort(401);
        }
        $poll = Poll::findOrFail($id);
        $poll->update($request->all());
        $poll->question()->sync(array_filter((array)$request->input('question')));



        return redirect()->route('admin.polls.index');
    }


    /**
     * Display Poll.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('poll_view')) {
            return abort(401);
        }
        
        $questions = \App\Question::get()->pluck('title', 'id');
$responses = \App\Response::where('poll_id', $id)->get();$questions = \App\Question::whereHas('poll',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$polltokens = \App\Polltoken::where('poll_id', $id)->get();

        $poll = Poll::findOrFail($id);

        return view('admin.polls.show', compact('poll', 'responses', 'questions', 'polltokens'));
    }


    /**
     * Remove Poll from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('poll_delete')) {
            return abort(401);
        }
        $poll = Poll::findOrFail($id);
        $poll->delete();

        return redirect()->route('admin.polls.index');
    }

    /**
     * Delete all selected Poll at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('poll_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Poll::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Poll from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('poll_delete')) {
            return abort(401);
        }
        $poll = Poll::onlyTrashed()->findOrFail($id);
        $poll->restore();

        return redirect()->route('admin.polls.index');
    }

    /**
     * Permanently delete Poll from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('poll_delete')) {
            return abort(401);
        }
        $poll = Poll::onlyTrashed()->findOrFail($id);
        $poll->forceDelete();

        return redirect()->route('admin.polls.index');
    }
}
