<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Loans') }}
                </h2>
            </div>
        </div>
    </x-slot>

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if(@isset($loans) && count($loans)>0)
                <div class="row row-cols-1 row-cols-lg-5 row-cols-md-4 row-cols-sm-2 no-gutters p-2">
                    @foreach ($loans as $loan)
                        <div class="col mb-2 d-flex p-2">
                            <div class="shadow card mx-auto" style="width: 16rem;">
                                <div class="col d-flex justify-content-center bg-light">
                                    <img src="{{asset('img/books/'.$loan->books->cover)}}" class="" alt="..." style="height:250px">
                                </div>
                                <hr class="mt-0 mb-1">
                                <div class="card-body py-1 px-2">
                                	@if($loan->state == 0)
                                   		<h6 class="text-success text-right  my-0">
                                        	<i class="fas fa-circle"></i> Returned
                                        </h6>
                                    @elseif($loan->state == 1)
                                        @if(isset($loan->on_time) && $loan->on_time == 0)
                                            <h6 class="text-danger text-right  my-0">
                                               <i class="fas fa-circle"></i> Borrowed
                                            </h6>
                                        @else
                                            <h6 class="text-warning text-right  my-0">
                                                <i class="fas fa-circle"></i> Borrowed
                                            </h6>
                                        @endif
                                    @endif  
                                    <h5 class="card-title break-text"><b>{{$loan->books->title}}</b></h5>
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <h6 class="font-weight-bold">Loan date:</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-right">{{$loan->loan_date}}</h6>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <h6 class="font-weight-bold">@if($loan->state == 1) Return date:@else Returned: @endif</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="text-right" title="Tentative return date">
                                                {{$loan->return_date}}@if($loan->state == 1)**@endif

                                            </h6>
                                            {{--@if(isset($loan->on_time) && $loan->on_time == 0)   
                                               SI EL LIBRO SE ENTREGÓ TARDE
                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent py-2">
                                    @if($loan->state == 1)
                                        <form action="{{url('loan')}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{$loan->id}}">
                                            <button type="submit" class="btn btn-block btn-primary">Back</button>
                                        </form>
                                    @else
                                    	<button type="submit" disabled class="btn btn-block btn-disabled border-dark">Back</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-3 pb-3">
                    {{$loans->links()}}
                </div>
            @else
                <div class="row no-gutters d-flex justify-content-center py-3">
                    <h1 class="text-black-50">There are no books here</h1>
                </div>
            @endif
        </div>
    </div>
</div>

</x-app-layout>