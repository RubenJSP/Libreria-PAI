<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Books') }}
                </h2>
            </div>
            <div class="col-md-4 col-12 text-right">
                <button class="btn btn-primary py-1" data-toggle="modal" data-target="#addBookModal"><i class="fas fa-plus-circle"></i> Add Book</button>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
    	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        		<div class="row no-gutters">
        			<div id="detailsCard" class="col-md-4 col-12 p-3" style="display: none">
        				<div class="shadow card mx-auto">
                            <div class="col">
                                <div class="text-right">
                                    <button type="button" class="close" aria-label="Close" onclick="hideDetails()">
                                        <span aria-hidden="true" class="position-absolute"><i class="fas fa-times-circle"></i></span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-img-top p-2" id="cardimgDetails"> 
                            </div>
                            <div class="card-body py-1 px-2">
                                <h4 class="card-title mb-0 font-weight-bold"><p id="titleDetails" class="mb-1"></p></h4>
                                <h5 class="card-title mb-0 font-weight-bold">Autor: <span id="autorDetails" class="font-weight-normal float-right"></span></h5>
                                <h6 class="card-title mb-0 font-weight-bold">Year: <span id="yearDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Category: <span id="categoryDetails" class="font-weight-normal float-right"></span></h6>
                                <p class="mb-0 font-weight-bold text-justify">Description: <span class="card-text font-weight-normal" id="descriptionDetails" class="font-weight-normal float-right"></span></p>
                                <h6 class="card-title mb-0 font-weight-bold">Pages: <span id="pagesDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Editorial: <span id="editorialDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Edition: <span id="editionDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">ISBN: <span id="isbnDetails" class="font-weight-normal float-right"></span></h6>
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
													<i class="fas fa-info-circle"></i> Details
												</button>
												<button type="button" class="btn btn-sm btn-primary">
													<i class="fas fa-edit"></i> Edit
												</button>
												<button type="button" class="btn btn-sm btn-danger">
													<i class="fas fa-trash-alt"></i> Delete
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

    <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{url('books')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                </div>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Adventure III" aria-label="Title" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Autor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-book-reader"></i></span>
                                        </div>
                                        <input type="text" id="autor" name="autor" class="form-control" placeholder="Robert James" aria-label="Autor" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                        </div>
                                        <select class="custom-select" name="category_id" id="inputGroupSelect01">
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-paragraph"></i></span>
                                </div>
                                <textarea id="description" class="form-control" name="description" aria-label="With textarea" cols="5" ></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Year</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="number" id="year" name="year" class="form-control" placeholder="1970" aria-label="year" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Edition</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ol"></i></span>
                                        </div>
                                        <input type="number" id="edition"  name="edition" class="form-control" placeholder="II" aria-label="Edition" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Editorial</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-university"></i></span>
                                        </div>
                                        <input type="text" id="editorial"  name="editorial" class="form-control" placeholder="Cometa" aria-label="Editorial" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ISBN</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" id="isbn" name="isbn"  class="form-control" placeholder="AB-125AC-55" aria-label="ISBN" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                        

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pages</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-book-open"></i></span>
                                        </div>
                                        <input type="number" id="pages"  name="pages" class="form-control" placeholder="600" aria-label="Pages" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cover</label>
                                    {{--<div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="cover">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>--}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-upload"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="cover">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <input type="hidden" id="id" name="id" value="">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
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