<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{   
    /**
     * [$bookList declared an empty $bookList array. this array is going to 
     * hold all the list of books to be returned when books are requested]
     * @var array
     */
    protected $bookList = [];


    /**
     * [$books this is going to hold the array of data that's created. However only if we want additional paramters to be returned that when you can use this varaible, else just return the request->all() which also holds all the data stored into the database]
     * @var [type]
     */
    protected $books;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * we loop through list of books created and returned only the needed parameter/columns. If you want to return the created_at and updated_at columns, you don't need to loop through the book model, you can just return Book::all()
         * @var [type]
         */
        foreach(Book::all() as $key => $book){
            $this->bookList[] = [
                'id' => $book->id,
                'name' => $book->name,
                'isbn' => $book->isbn,
                'authors' => $book->authors,
                'country' => $book->country,
                'number_of_pages' => $book->number_of_pages,
                'publisher' => $book->publisher,
                'release_date' => $book->release_date
            ];
        }

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => $this->bookList
        ], 200);
    }


    /**
     * [front_end return a view to the front-end]
     * @return [type] [description]
     */
    public function front_end()
    {
        return view('books.index');
    }

    /**
     * [fetch_books fetch books 10 each request]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function fetch_books(Request $request)
    {
        $books = Book::orderBy('id', 'desc')
            ->offset($request->start)
            ->take($request->limit)
            ->get();

        echo view('books.load-books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateBookRequest  $request // we are using a CreateBookRequest which extends a FormRequest class helper. We want to separate the validation rules from the controller method
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        // validate that the required parameters are properly entered
        // this ensure that no sql injection and all required parameters are entered before submitting to the database
        if($request->validated()){
            $this->books = Book::create([
                'name' => $request->name,
                'isbn' => $request->isbn,
                'authors' => $request->authors,
                'country' => $request->country,
                'number_of_pages' => $request->number_of_pages,
                'publisher' => $request->publisher,
                'release_date' => $request->release_date
            ]);

            // return a json response of 201 created with the data to tell the user that the data has been succesfully created. 
            // 
            //  We returned the request->all() because the requirement says just the data in the create request. 
            //  
            //   we could have returned the $book variable which also holds the data of the just created book with additional parameters such as the book id which could be used later to either fetch single book or delete the book, and also the created_at and updated_at columns are available in the $this->books variable.
            //   
            //    If you need to display these values, replace the $request->all() with $this->books
            //     
            return response()->json([
                "status_code" => 201,
                "status" => "success",
                "data" => [["books"=>$request->all()]]
            ], 201);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param   $book this could be  id, name, country, publisher, release_date
     * @return \Illuminate\Http\Response
     */
    public function show($book)
    {   
        /**
         * [$data // this will hold arrays of books depending on what the search parameter used]
         * @var array
         */
        $data = []; 

        /**
         * [$status_code // this is a default status code response if there is or are no books]
         * @var integer
         */
        $status_code = 204;

        /**
         * [$status // this is a default status message]
         * @var string
         */
        $status = "No content"; 

        
        /**
         * [$this->book we select book(s) based on the parameter entered. if its just an id, it will return just a book. If it's a name or publisher, or release date, or country, it will return all the books that match the parameter]
         * @var [type]
         */
        $this->book = Book::where('id', $book)
        ->orWhere('name', $book)
        ->orWhere('country', $book)
        ->orWhere('publisher', $book)
        ->orWhere('release_date', $book)
        ->get();

        /**
         *  we want to make sure that the $this->book is not empty so that we can return a success status and 200 status code
         */
        if(!empty(json_decode($this->book, true))){
            $status_code = 200;
            $status = "success";

            /**
             *  loop through the $this->book array. pass each fetched book as a data to the data array
             */
            foreach($this->book as $key => $book){
                $data[] = [
                    'id' => $book->id,
                    'name' => $book->name,
                    'isbn' => $book->isbn,
                    'authors' => $book->authors,
                    'country' => $book->country,
                    'number_of_pages' => $book->number_of_pages,
                    'publisher' => $book->publisher,
                    'release_date' => $book->release_date
                ];
            }
        }


        /**
         *  return a json response of either empty array or a single array, or a list of data
         */
        return response()->json([
            "status_code" => $status_code,
            "status" => $status,
            "data" => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $book = Book::where('id', $id)->get()->first();
         echo view('books.edit_book', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request UpdateBookRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
         // validate that the required parameters are properly entered
        // this ensure that no sql injection and all required parameters are entered before submitting to the database
        if($request->validated()){
            $this->books = Book::where('id', $id)->get()->first();

            /**
             *  this allows us to be able to update any of the columns either as mass update or single column update
             */
            $this->books->update([
                'name' => $request->name ?? $this->books->name,
                'isbn' => $request->isbn ?? $this->books->isbn,
                'authors' => $request->authors ?? $this->books->authors,
                'country' => $request->country ?? $this->books->country,
                'number_of_pages' => $request->number_of_pages ?? $this->books->number_of_pages,
                'publisher' => $request->publisher ?? $this->books->publisher,
                'release_date' => $request->release_date ?? $this->books->release_date
            ]);

            // return a json response of 200 success with the data to tell the user that the data has been succesfully created. 
            // 
            //  We returned the request->all() because the requirement says just the data in the create request. 
            //  
            //   we could have returned the $book variable which also holds the data of the just created book with additional parameters such as the book id which could be used later to either fetch single book or delete the book, and also the created_at and updated_at columns are available in the $this->books variable.
            //   
            //    If you need to display these values, replace the $request->all() with $this->books
            //     
            return response()->json([
                "status_code" => 200,
                "status" => "success",
                "message" => "The book ". $request->name . " was updated successfully",
                "data" => [
                    'id' => $this->books->id,
                    'name' => $this->books->name,
                    'isbn' => $this->books->isbn,
                    'authors' => $this->books->authors,
                    'country' => $this->books->country,
                    'number_of_pages' => $this->books->number_of_pages,
                    'publisher' => $this->books->publisher,
                    'release_date' => $this->books->release_date
                ]
            ], 200);
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
        $book = "No book to delete";
        $this->books = Book::where('id', $id)->get()->first();
         /**
         *  we want to make sure that the $this->book is not empty so that we can return a success status and 200 status code
         */
        if(!empty(json_decode($this->books, true))){
            $book = "The book " . $this->books->name . " was deleted successfully";
            $this->books->delete();
        }

        /**
         *  return a response of whether there is a book deleted or no book to delete
         */
        return response()->json([
            "status_code" => 204,
            "status" => "success",
            "message" => $book 
        ]);
    }
}

