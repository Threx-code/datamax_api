<!--======================== MODAL FOR DELETING BOOKS ============================-->
<div class="modal fade" id="delete{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 10000000;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-contact delForm{{$book->id}}" action="{{ route('delete_book/', $book->id)}}" method="post">
          @csrf @method('delete')
          <input type="submit" class="empty-btn del{{$book->id}}" style="display: none;">
          <div class="submitLoader emptyclubLoader"></div>
          <p class="loaderMessage msg" style="text-align: center;">
          Are you sure you want to perform this action?</p>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger delBtn{{$book->id}}" type="button">Delete</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!--======================== MODAL FOR DELETING BOOKS ============================-->

<!-- comment this javascript if you do not wish to use javascript -->
<script type="text/javascript">
	var token = $('input[name="_token"]').val();
	$(document).ready(function(){

		$(".delBtn{{$book->id}}").on("click", function(){
			$(".del{{$book->id}}").click();
		});

		

		$(".delForm{{$book->id}}").on("submit", function(e){
			e.preventDefault();

			$.ajaxSetup({
				headers:{
					"X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url: "{{ route('delete_book/', $book->id)}}",
				method: "DELETE",
				data:{
					_token:token,
					id:{{$book->id}} 
				},
				success:function(result){
					$(".msg").html("The book {{$book->name}} was deleted successfully");
					$(".section{{$book->id}}").hide();
				},
				error:function(xhr){
					var data = xhr.responseJSON;

					const key = Object.keys(data);

					key.forEach((key, index) =>{
						$(".msg").html(data[index]);
					})
				}
			});
		})
		
	})
</script>