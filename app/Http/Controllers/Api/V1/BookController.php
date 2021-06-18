<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BookRequest;
use App\Http\Resources\V1\BookResource;
use App\Http\Resources\V1\BookResourceCollection;
use App\Models\Author;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book =  Book::with([
            'Category'   => function($query){$query->addSelect(array('id', 'name'));},
            'Author'     => function($query){$query->addSelect(array('id', 'name'));},
            'Publisher'  => function($query){$query->addSelect(array('id', 'name'));},
            'Shelf'      => function($query){$query->addSelect(array('id', 'address'));},
            'Age'        => function($query){$query->addSelect(array('id', 'title','range'));}
            ]);
        return new BookResourceCollection($book->paginate(25));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest  $request)
    {
        $validated = $request->validated();
        $book = Book::create($validated);
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        try {
            $book = Book::with([
                'Category'   => function($query){$query->addSelect(array('id', 'name'));},
                'Author'     => function($query){$query->addSelect(array('id', 'name'));},
                'Publisher'  => function($query){$query->addSelect(array('id', 'name'));},
                'Shelf'      => function($query){$query->addSelect(array('id', 'address'));},
                'Age'        => function($query){$query->addSelect(array('id', 'title','range'));}
                ])->findOrFail($id); 
        }
        catch (ModelNotFoundException $e) {

            return response()->json(['errors'=>'Book Not Found'],Response::HTTP_NOT_FOUND);
        }
        
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest  $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $validated = $request->validated();
            $book->update($validated);
        }
        catch (ModelNotFoundException $e) {

            return response()->json(['errors'=>'Book Not Found'],Response::HTTP_NOT_FOUND);
        }
        
        return new BookResource($book);
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
            $book = Book::findOrFail($id);
            $book->delete();
        }
        catch (ModelNotFoundException $e) {

            return response()->json(['errors'=>'Book Not Found'],Response::HTTP_NOT_FOUND);
        }
        
        return response()->json(['message'=>'successfully deleted']);
    }
}
