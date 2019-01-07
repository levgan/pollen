<?php

namespace App\Http\Controllers\Admin;

use App\Polltoken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePolltokensRequest;
use App\Http\Requests\Admin\UpdatePolltokensRequest;

class PolltokensController extends Controller
{
    /**
     * Display a listing of Polltoken.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('polltoken_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('polltoken_delete')) {
                return abort(401);
            }
            $polltokens = Polltoken::onlyTrashed()->get();
        } else {
            $polltokens = Polltoken::all();
        }

        return view('admin.polltokens.index', compact('polltokens'));
    }

    /**
     * Show the form for creating new Polltoken.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('polltoken_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $polls = \App\Poll::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.polltokens.create', compact('users', 'polls'));
    }

    /**
     * Store a newly created Polltoken in storage.
     *
     * @param  \App\Http\Requests\StorePolltokensRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolltokensRequest $request)
    {
        if (! Gate::allows('polltoken_create')) {
            return abort(401);
        }
        $polltoken = Polltoken::create($request->all());



        return redirect()->route('admin.polltokens.index');
    }


    /**
     * Show the form for editing Polltoken.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('polltoken_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $polls = \App\Poll::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $polltoken = Polltoken::findOrFail($id);

        return view('admin.polltokens.edit', compact('polltoken', 'users', 'polls'));
    }

    /**
     * Update Polltoken in storage.
     *
     * @param  \App\Http\Requests\UpdatePolltokensRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolltokensRequest $request, $id)
    {
        if (! Gate::allows('polltoken_edit')) {
            return abort(401);
        }
        $polltoken = Polltoken::findOrFail($id);
        $polltoken->update($request->all());



        return redirect()->route('admin.polltokens.index');
    }


    /**
     * Display Polltoken.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('polltoken_view')) {
            return abort(401);
        }
        $polltoken = Polltoken::findOrFail($id);

        return view('admin.polltokens.show', compact('polltoken'));
    }


    /**
     * Remove Polltoken from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('polltoken_delete')) {
            return abort(401);
        }
        $polltoken = Polltoken::findOrFail($id);
        $polltoken->delete();

        return redirect()->route('admin.polltokens.index');
    }

    /**
     * Delete all selected Polltoken at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('polltoken_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Polltoken::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Polltoken from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('polltoken_delete')) {
            return abort(401);
        }
        $polltoken = Polltoken::onlyTrashed()->findOrFail($id);
        $polltoken->restore();

        return redirect()->route('admin.polltokens.index');
    }

    /**
     * Permanently delete Polltoken from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('polltoken_delete')) {
            return abort(401);
        }
        $polltoken = Polltoken::onlyTrashed()->findOrFail($id);
        $polltoken->forceDelete();

        return redirect()->route('admin.polltokens.index');
    }
}
