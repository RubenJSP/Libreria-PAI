<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Categories') }}
                </h2>
            </div>
            <div class="col-md-4 col-12 text-right">
                <button class="btn btn-primary py-1" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus-circle"></i> Add Category</button>
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
									<th scope="col">Category</th>
									<th scope="col">Description</th>
                                    <th scope="col">Actions</th>
								</tr>
							</thead>
							<tbody>
								@if(@isset($categories) && count($categories)>0)
                    				@foreach ($categories as $category)
										<tr id="Category{{$category->id}}">
											<th>{{$category->id}}</th>
											<td>{{$category->name}}</td>
											<td>{{$category->description}}</td>
											<td>
												<button onclick="editCategory({{$category}})" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal">
													<i class="fas fa-edit" ></i> Edit
												</button>
												<button onclick="deleteRecord('Category','{{url('categories')}}',{{$category->id}})"type="button" class="btn btn-sm btn-danger">
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

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('categories')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Romance" aria-label="Name" aria-describedby="basic-addon1">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{url('categories')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Romance" aria-label="Name" aria-describedby="basic-addon1">
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

        function editCategory(category){
            console.log(category)
            $('#id').val(category.id);

            $('#editCategoryModal #name').val(category.name);
            $('#editCategoryModal #description').val(category.description);
        }
    </script>
</x-slot>

</x-app-layout>