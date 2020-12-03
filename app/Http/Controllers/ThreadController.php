<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
	User,
	Thread
};

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    private $thread;

	public function __construct(Thread $thread)
	{
		$this->thread = $thread;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = $this->thread->orderBy('created_at', 'DESC')->paginate(15);

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->thread->create($request->all());

            dd('Tópico criado com sucesso!');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = $this->thread->whereSlug($thread)->first();

	    if(!$thread) return redirect()->route('threads.index');

	    return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = $this->thread->find($id);

        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $thread = $this->thread->find($id);

            $thread->update($request->all());

            dd('Tópico atualizado com sucesso!');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $thread = $this->thread->find($id);

            $thread->delete();

            dd('Tópico atualizado com sucesso!');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
