@extends('layout.app')
@section('content')

	<form class="editform" action="{{ route('update/', $book->id)}}" method="post" style="margin-top:30px;">
		@csrf @method('put')
		<div class='alert alert-info updateMsg'>Edit Book</div>   
		<label>Name</label>
		<div class="input-group">
			<input type="text" class="form-control bookname"  name="name" value="{{$book->name}}">
		</div>

		<label>ISBN</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="isbn" value="{{$book->isbn}}">
		</div>

		<label>authors</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="authors[]" 
			value="@foreach($book->authors as $author) {{$author}} @endforeach">
		</div>

		<label>Country</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="country" value="{{$book->country}}">
		</div>

		<label>Number of Pages</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="number_of_pages" value="{{$book->number_of_pages}}">
		</div>

		<label>Publisher</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="publisher" value="{{$book->publisher}}">
		</div>

		<label>Release Date</label>
		<div class="input-group">
			<input type="text" class="form-control"  name="release_date" value="{{$book->release_date}}">
		</div>

		<br>
		<input type="submit" value="Update" class="btn btn-info"/>
	</form>

<!-- comment this javascript if you do not wish to use javascript -->
<script type="text/javascript">
	var token = $('input[name="_token"]').val();
	$(document).ready(function(){
		$(".editform").on("submit", function(e){
			e.preventDefault();

			var bookName = $(".bookname").val();

			$.ajaxSetup({
				headers:{
					"X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url: "{{ route('update/', $book->id)}}",
				method: "PUT",
				data:$(".editform").serialize(),
				success:function(result){
					$(".updateMsg").html("The book "+ bookName +" was updated successfully");
					$(".section{{$book->id}}").hide();
				},
				error:function(xhr){
					var data = xhr.responseJSON;
					//Object.values(data);
					//Object.keys(data);
					
					const keys = Object.keys(data);
					keys.forEach((key, index) => {
						$(".updateMsg").html(data[key]);
					});
					
				}
			});
		})
	})
</script>

@endsection
