<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Users') }}
                </h2>
            </div>
            <div class="col-md-4 col-12 text-right">
                <button class="btn btn-primary py-1" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus-circle"></i> Add User</button>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row no-gutters">
                    
                    <div class="col p-3">
                        <table class="table table-responsive-md table-striped table-hover table-sm shadow">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="5">
                                    @if(@isset($users) && count($users)>0)
                                        {{$users->links()}}
                                    @endif
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if(@isset($users) && count($users)>0)
                                    @foreach ($users as $user)
                                        <tr id="User{{$user->id}}">
                                            <th>{{$user->id}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->role_id==1)
                                                    <p>Administrator</p>
                                                @else
                                                    <p>Cliente</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url('/users/details/'.$user->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-info-circle"></i> Details
                                                </a>
                                                <button onclick="editUser({{$user}})" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editUserModal">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button onclick="deleteRecord('User','{{url('users')}}',{{$user->id}})" type="button" class="btn btn-sm btn-danger">
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

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('users') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="Robert James" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="user@domain.com" aria-label="Email" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" aria-label="Password" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="role_id">Options</label>
                                </div>
                                <select class="custom-select" name="role_id">
                                    <option value="1">Administrator</option>
                                    <option value="2">Client</option>
                                </select>
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

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="addBook" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit new User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('users') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Robert James" aria-label="Name" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control" placeholder="user@domain.com" aria-label="Email" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="arole_id">Options</label>
                                </div>
                                <select class="custom-select" name="role_id" id="role_id">
                                    <option value="1">Administrator</option>
                                    <option value="2">Client</option>
                                </select>
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
        function editUser(user){
            $('#id').val(user.id);
            $('#editUserModal #name').val(user.name);
            $('#editUserModal #email').val(user.email);
            $('#editUserModal #role_id').val(user.role_id);
        }
    </script>
</x-slot>

</x-app-layout>