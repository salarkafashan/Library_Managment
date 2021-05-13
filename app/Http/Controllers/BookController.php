<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceCollection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $book =  Book::paginate(25);
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
    public function store(Request $request)
    {
        $data = $this->validateRequest();
        $book = Book::create($data);
        return new BookResource($book);
        // return response()->json($book);
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
    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);

            $data = $this->validateRequest();
            $book->update($data);
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

    private function validateRequest(){
        return request()->validate([

            "author_id"     => 'sometimes','nullable','integer',
            "publisher_id"  => 'sometimes','nullable','integer',
            "category_id"   => 'required','integer',
            "age_id"        => 'required','integer',
            "shelf_id"      => 'sometimes','nullable','integer',
            "title"         => 'required','string', 'min:1',
            "description"   => 'required','string', 'min:30', 'max:300',
            "tags"          => 'sometimes','nullable','string',
            "pages"         => 'required','string', 'min:1',
            "stock"         => 'required', 'min:1',
            "Language"      => 'required','string',
            "weight"        => 'sometimes','nullable','min:1',
            "Dimensions"    => 'sometimes','nullable','min:3',
            "reward"        => 'sometimes','nullable','string',
            "release_date"  => 'sometimes','nullable','date',
            "cover_image"   => 'sometimes','nullable','string',
        ]);
    }
}
