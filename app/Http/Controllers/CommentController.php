<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['index', 'store', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CommentRequest $request)
    {
        $comments = Comment::filter($request->all())->get();
        $users = User::all();
        $books = Book::all();
        foreach($comments as $comment){
            $book = $books->find($comment->book_id);
            $user = $users->find($comment->borrower_id);
            $comment->book = $book;
            $comment->borrower = $user;
        }
        return $comments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comments = Comment::create($request->all());
        $users = User::all();
        $books = Book::all();
        foreach($comments as $comment){
            $book = $books->find($comment->book_id);
            $user = $users->find($comment->borrower_id);
            $comment->book = $book;
            $comment->borrower = $user;
        }
        return $books;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::where('comment_id', $id)->first();
        $books = Book::all();
        $borrowers = User::all();
        $book = $books->find($comment->book_id);
        $user = $borrowers->find($comment->borrower_id);
        $comment->book = $book;
        $comment->borrower = $user;
        
        return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request)
    {
        $comment = Comment::where('book_id', $request->comment_id)
            ->update(
                $request->except('book_image')
                // ['name_book' => 'sách bị đổi tên']
            );
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id)->delete();
        $books = Book::all();
        $borrowers = User::all();
        $book = $books->find($comment->book_id);
        $user = $borrowers->find($comment->borrower_id);
        $comment->book = $book;
        $comment->borrower = $user;
        return $comment;
    }

}