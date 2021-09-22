@foreach($books as $key => $book)
    <section class="interior_area card shadow section{{$book->id}}" style="padding: 20px 20px 20px 10px; margin-bottom: 10px;">
        <div class="container">
            <div class="interior_inner row">
                <div class="col-lg-10">
                    <div class="interior_text">
                        <h4><small>Title:</small> {{$book->name}}</h4>
                        <div>
                            <small>
                                <strong>Released date:</strong>{{$book->release_date}}
                                <strong>Authors:</strong> 
                                @foreach($book->authors as $author)
                                    {{$author}} / 
                                @endforeach
                            </small>
                        </div>
                        <div>
                            <small>
                            <strong>number of Pages:</strong> {{$book->number_of_pages}} 
                            <strong>ISBN:</strong> {{$book->isbn}}
                        </small>
                        </div>
                        <div>
                            <small>
                            <strong>Country:</strong> {{$book->country}} 
                            <strong>Publisher:</strong> {{$book->publisher}}
                        </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div style="margin-left:10px;">
                       <a href="{{ route('edit/', $book->id)}}" class="btn btn-info" style="margin-bottom: 20px; text-decoration: none;">
                       Edit</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#delete{{$book->id}}">Delete</button> 
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@include('books.modals.delete_book')
@endforeach