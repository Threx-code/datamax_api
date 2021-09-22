<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client; 

class IceAndFireAPIController extends Controller
{   
    /**
     * [$url this variable will hold the https://www.anapioficeandfire.com/api/books/ link]
     * @var [string]
     */
    protected $url;

    /**
     * [$name_explode this is going to hold the array of exploded $_SERVER['REQUEST_URI']. This allows us to be able to get the every other value after the ? mark in the $_SERVER['REQUEST_URI']]
     * @var [array]
     */
    protected $name_explode;

    /**
     * [$name description]
     * @var [string]
     */
    protected $name;

    /**
     * [$client this will hold an instance of Client()]
     * @var [object]
     */
    protected $client;

    /**
     * [$response this will hold the return response from https://www.anapioficeandfire.com/api/books/]
     * @var [array]
     */
    protected $response;

    /**
     * [$bookList this will hold loop data from $response]
     * @var array
     */
    protected $bookList = [];
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // we first explode the url and pass the array value to $this->name_explode
        $this->name_explode = explode("?", $_SERVER['REQUEST_URI']);

        // we want this to be able to work for both a url without parameters and url with parameters. So we check if the exploded $_SERVER['REQUEST_URI'][1] is not empty, then the url will carry a parameter else it will be just a general request without parameters
        // 
        // URI without parameter https://www.anapioficeandfire.com/api/books
        // 
        // URI with a parameter https://www.anapioficeandfire.com/api/books?name=game of Thrones
        // 
        if(!empty($this->name_explode[1])) $this->name = "?".$this->name_explode[1];


        // we initialize the GuzzleHttp\Client
        $this->client = new Client();

        // we create the external endpoint
        $this->url = "https://www.anapioficeandfire.com/api/books".$this->name;

        // we pass the response from the external endpoint to $this->response
        $this->response = $this->client->request("GET", $this->url);
        
        // we want to be able to serialize the $this->response data. We first convert it to workable array
        $result = json_decode($this->response->getBody(), true);
        
        // we loop through the array
        foreach($result as $key => $book){
            // we format the $book['released'] instead of return "1996-08-01T00:00:00", we want to return just the date without time.
            $date_released = explode("T", $book['released']);
           
           // we passed all the data to $this->bookList[] array
            $this->bookList[] = [
                'name' => $book['name'],
                'isbn' => $book['isbn'],
                'authors' => $book['authors'],
                'number_of_pages' => $book['numberOfPages'],
                'publisher' => $book['publisher'],
                'country' => $book['country'],
                'release_date' => $date_released[0]
            ];
        }
        
        // we returned the data in json format
        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "data" => $this->bookList
        ], 200);
    }
}


