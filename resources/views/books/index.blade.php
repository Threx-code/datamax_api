@extends('layout.app')
@section('content')

@csrf
<div class="book_content"></div>
<br>
<button class="btn btn-info" id="loadMore">Load More</button>
      
<script type="text/javascript">
     var max = false;
    var start = 0;
    var limit = 10;
    var token = $('input[name="_token"]').val();

    $(document).ready(function(){
       getBook();

       $("#loadMore").on("click", function(){
        getBook();
       });

        function getBook(){
            if (max)
                return;

            $.ajaxSetup({
                headers:{
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('fetch_books')}}",
                method: "GET",
                data:{
                    _token:token,
                    start:start,
                    limit:limit
                },
                success:function(books){
                    if(books == max || books == 0 ){
                        max = true;
                        $("#loadMore").hide();
                    }
                    else{
                        start += limit;
                        $(".book_content").append(books);
                    }
                }
            })
        }
    })
</script>

@endsection