<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:200'],
            'content' => ['required'],
        ]);

        try {
            $article = Articles::create([
                'title' => $request->title,
                'content' => $request->content,
                'createdby' => Auth::id()
            ]);
            Session::flash('article-created', 'Your Article Has Been Created Successfully');
            return Redirect::to('/articles');
        } catch (\Throwable $th) {
            echo "Sorry We Have an unexpected Error !";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $articles = Articles::orderBy('id', 'desc')->paginate(6);
        // return the json response
        if ($request->get("request") && $request->get("request") == "api") {
            return response()->json($articles);
        }
        // return the view on the first load
        return Inertia::render('Articles', [
            'articles' => $articles,
            'loadedPages' => [$articles->currentPage()],
            "articleCreated" => Session::has('article-created') ? Session::get('article-created') : null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function edit(Articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articles  $articles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articles $articles)
    {
        //
    }
}
