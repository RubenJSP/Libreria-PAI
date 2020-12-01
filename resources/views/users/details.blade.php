<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('User > Details') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row no-gutters">
                    <div id="detailsCard" class="col-md-3 col-12 p-3">
                        <div class="shadow card mx-auto">
                            <div class="card-img-top p-2" id="cardimgDetails">
                                <img id="imgUserDetails" src="{{asset('img/users/userIcon.jpg')}}" class="card-img" alt="...">
                            </div>
                            <div class="card-body py-1 px-2">
                                <h4 class="card-title mb-0 font-weight-bold"><p id="nameUser" class="mb-1">{{$user->name}}</p></h4>
                                <hr>
                                <h6 class="card-title mb-2 font-weight-bold" id="mailUser">{{$user->email}}</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col p-3">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Loan date</th>
                                    <th scope="col">Return date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(@isset($loans) && count($loans)>0)
                                    @foreach ($loans as $loan)
                                        <tr>
                                            <th>{{$loan->id}}</th>
                                            <td>{{$loan->books->title}}</td>
                                            <td>{{$loan->loan_date}}</td>
                                            <td>
                                                @if($loan->state==0)
                                                    {{$loan->return_date}}
                                                @else
                                                    {{$loan->return_date}}**
                                                @endif
                                            </td>
                                            <td>
                                                @if($loan->state==0)
                                                    <p class="text-success"><i class="fas fa-circle"></i> Returned</p> 
                                                @else
                                                    <p class="text-warning"><i class="fas fa-circle"></i> Borrowed </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" rowspan="3" class="text-center"><h1>No loan records</h1></td>
                                    </tr>
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
    	}

        function showDetails(loan){
        }
    </script>
</x-slot>

</x-app-layout>