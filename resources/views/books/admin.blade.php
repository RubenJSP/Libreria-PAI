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
        			<div class="col p-3">
        				<table class="table table-striped table-hover table-sm">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Title</th>
									<th scope="col">Autor</th>
									<th scope="col">Year</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Status</th>
									<th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(@isset($books) && count($books)>0)
                    				@foreach ($books as $book)
										<tr id="Book{{$book->id}}">
											<th>{{$book->id}}</th>
											<td>{{$book->title}}</td>
											<td>{{$book->autor}}</td>
                                            <td>{{$book->year}}</td>
                                            <td>{{$book->isbn}}</td>
											<td>
                                                @if($book->status==0)
                                                    <p class="text-success"><i class="fas fa-circle"></i> Available</p> 
                                                @else
                                                    <p class="text-warning"><i class="fas fa-circle"></i> Borrowed </p>
                                                @endif
                                            </td>
											<td>
                                                <a href="{{url('/books/details/'.$book->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-info-circle"></i> Details
                                                </a>
												<button onclick="editBook({{$book}})" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editBookModal">
													<i class="fas fa-edit" ></i> Edit
												</button>
												<button onclick="deleteRecord('Book','{{url('books')}}',{{$book->id}})"type="button" class="btn btn-sm btn-danger">
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
                <form method="POST" action="{{url('books')}}" enctype="multipart/form-data">
                    @csrf
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
                                            <label class="input-group-text" for="category_id">Options</label>
                                        </div>
                                        <select class="custom-select" name="category_id" id="category_id">
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-upload"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cover" aria-describedby="inputGroupFileAddon01" name="cover">
                                            <label class="custom-file-label" for="cover">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
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
                                            <label class="input-group-text" for="category_id">Options</label>
                                        </div>
                                        <select class="custom-select" name="category_id" id="category_id">
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

        function editBook(book){
            $('#id').val(book.id);
            $('#editBookModal #title').val(book.title);
            $('#editBookModal #autor').val(book.autor);
            $('#editBookModal #category_id').val(book.category_id);
            $('#editBookModal #description').val(book.description);
            $('#editBookModal #year').val(book.year);
            $('#editBookModal #isbn').val(book.isbn);
            $('#editBookModal #pages').val(book.pages);
            $('#editBookModal #edition').val(book.edition);
            $('#editBookModal #editorial').val(book.editorial);
        }
    </script>
</x-slot>

</x-app-layout>