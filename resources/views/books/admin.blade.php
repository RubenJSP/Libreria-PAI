<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Books') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
    	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        		<div class="row no-gutters">
        			<div id="detailsCard" class="col-4 p-3" style="display: none">
        				<div class="shadow card-deck mx-auto">
                            <div class="col">
                                <button type="button" class="close position-absolute" aria-label="Close" onclick="hideDetails()">
                                    <span aria-hidden="true">&times;Close</span>
                                </button>
                            </div>
                            
                            <div class="card-img-top p-2" id="cardimgDetails">
                                
                            </div>
                            <div class="card-body py-1 px-2">
                                <h4 class="card-title"><p id="titleDetails"></p></h4>
                                <h6 class="card-title">Year: <span id="yearDetails"></span></h6>
                                <h5 class="card-title">Autor: <span id="autorDetails"></span></h5>
                                <h6 class="card-title">Category: <span id="categoryDetails"></span></h6>
                                <p>Description: <span class="card-text" id="descriptionDetails"></span></p>
                                <h6 class="card-title">Pages: <span id="pagesDetails"></span></h6>
                                <h6 class="card-title">Editorial: <span id="editorialDetails"></span></h6>
                                <h6 class="card-title">Edition: <span id="editionDetails"></span></h6>
                                <h6 class="card-title">ISBN: <span id="isbnDetails"></span></h6>
                            </div>
                            <div class="card-footer bg-transparent py-2">
                            </div>   
                        </div>
        			</div>
        			<div class="col p-3">
        				<table class="table table-sm">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Title</th>
									<th scope="col">Autor</th>
									<th scope="col">Status</th>
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>

								@if(@isset($books) && count($books)>0)
                    				@foreach ($books as $book)
										<tr>
											<th>1</th>
											<td>{{$book->title}}</td>
											<td>{{$book->autor}}</td>
											<td>@if($book->status==0)Available @else Borrowed @endif</td>
											<td>
												<button onclick="showDetails({{$book}},{{$book->category}})" type="button" class="btn btn-sm btn-info">
													Details
												</button>
												<button type="button" class="btn btn-sm btn-primary">
													Edit
												</button>
												<button type="button" class="btn btn-sm btn-danger">
													Delete
												</button>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
        			</div>

        		</div>

        	</div>
        </div>
    </div>

<x-slot name="scripts">
    <script type="text/javascript">
    	function hideDetails(){
            $('#imgDetails').remove();
            $('#titleDetails').text();
            $('#autorDetails').text();
            $('#yearDetails').text();
            $('#categoryDetails').text();
            $('#descriptionDetails').text();
            $('#pagesDetails').text();
            $('#editorialDetails').text();
            $('#editionDetails').text();
            $('#isbnDetails').text();
            $('#detailsCard').hide();
    	}

        function showDetails(book,category){

        	$('#detailsCard').show(1000);

            if($('#imgDetails')!=null){
                $('#imgDetails').remove();
            }
            $('#btnNotAvaibleDetails').hide();
            $('#titleDetails').text(book.title);
            $('#autorDetails').text(book.autor);
            $('#yearDetails').text(book.year);
            $('#categoryDetails').text(category.name);
            $('#descriptionDetails').text(book.description);
            $('#pagesDetails').text(book.pages);
            $('#editorialDetails').text(book.editorial);
            $('#editionDetails').text(book.edition);
            $('#isbnDetails').text(book.isbn);
            var img = $('<img />', { 
                id: 'imgDetails',
                src: 'img/books/'+book['cover'],
                class: 'card-img my-auto'
            });
            img.appendTo($('#cardimgDetails'));

            if (book.status==0){
                $('#detailsGet').show();
                $('#idDetails').val(book.id);
            }
            else{
                $('#detailsGet').hide();
                $('#idDetails').val("");
                $('#btnNotAvaibleDetails').show();  
            }
        }
    </script>
</x-slot>

</x-app-layout>