<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tittle</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Pedir</th>
                        <th scope="col">cover</th>
                      </tr>
                    </thead>
                    <tbody>
                     @if(@isset($books) && count($books)>0)
                         @foreach ($books as $book)
                             <tr> 
                                 <th scope = "row">
                                     {{$book->id}}
                                 </th>
                                 <td>
                                    {{$book->title}}
                                </td>
                                <td>
                                    {{$book->description}}
                                </td>
                                <td>
                                    {{$book->category->name}}
                                </td>
                                <td>
                                  @if($book->status == 0)
                                    <form action="{{url('loan')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$book->id}}">
                                        <button type="submit" class="btn btn-primary">Get</button>
                                    </form>
                                    @else
                                      <h5>PRESTADO</h5>
                                      <button  type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal"
                                      onclick="edit({{$book}})"> 
                                        update
                                      </button>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <img src="{{asset('img/books/'.$book->cover)}}" class="rounded float-left" alt="cover">
                                    </div>
                                </td>
                             </tr>
                         @endforeach
                     @endif
                    </tbody>
                  </table>
                    <h3 class="h3"> RETURN BOOKS</h3>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tittle</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     @if(@isset($loans) && count($loans)>0)
                         @foreach ($loans as $loan)
                             <tr> 
                                 <th scope = "row">
                                     {{$loan->id}}
                                 </th>
                                 <td>
                                    {{$loan->books->title}}
                                 </td>
                                 <td>
                                    <form action="{{url('loan')}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$loan->id}}">
                                        <button type="submit" class="btn btn-primary">RETURN BOOK</button>
                                    </form>
                                 </td>
                             </tr>
                         @endforeach
                     @endif
                    </tbody>
                  </table>
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
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Adventure III" aria-label="Title" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book title.</small>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <textarea id="description" class="form-control" name="description" aria-label="With textarea" cols="5" ></textarea>
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book title.</small>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Year</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="number" id="year" name="year" class="form-control" placeholder="1970" aria-label="year" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="bookYear" class="form-text text-muted">Book year.</small>
                              </div>
                              
                              <div class="form-group">
                                <label for="exampleInputEmail1">Pages</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="number" id="pages"  name="pages" class="form-control" placeholder="600" aria-label="Pages" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book pages.</small>
                              </div>
        
                              <div class="form-group">
                                <label for="exampleInputEmail1">ISBN</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="text" id="isbn" name="isbn"  class="form-control" placeholder="AB-125AC-55" aria-label="ISBN" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book ISBN.</small>
                              </div>
        
                              <div class="form-group">
                                <label for="exampleInputEmail1">Editorial</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="text" id="editorial"  name="editorial" class="form-control" placeholder="Cometa" aria-label="Editorial" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book Editorial.</small>
                              </div>
        
                              <div class="form-group">
                                <label for="exampleInputEmail1">Edition</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="number" id="edition"  name="edition" class="form-control" placeholder="II" aria-label="Edition" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book Edition.</small>
                              </div>
        
                              <div class="form-group">
                                <label for="exampleInputEmail1">Autor</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="text" id="autor" name="autor" class="form-control" placeholder="Robert James" aria-label="Autor" aria-describedby="basic-addon1">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book Autor.</small>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <select class="from-control" name="category_id">
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book Category.</small>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Cover</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    <input type="file"  name="cover" class="form-control" name="cover">
                                  </div>                          
                                <small id="emailHelp" class="form-text text-muted">Book Cover Image.</small>
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
              <x-jet-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>
        
                <x-jet-validation-errors class="mb-4" />
        
                <form method="POST" action="{{ url('createAdmin') }}">
                    @csrf
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
        
                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>
        
                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>
        
                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
        
                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
                <script>
                        function edit(data){
                            $('#id').val(data['id'])
                            $('#title').val(data['title'])
                            $('#description').val(data['description'])
                            $('#year').val(data['year'])
                            $('#pages').val(data['pages'])
                            $('#isbn').val(data['isbn'])
                            $('#editorial').val(data['editorial'])
                            $('#edition').val(data['edition'])
                            $('#autor').val(data['autor'])
                        }
              </script>
</x-app-layout>
