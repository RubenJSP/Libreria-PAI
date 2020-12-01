<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Books > Details') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
    	<div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
        	<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row no-gutters">
        			<div id="detailsCard" class="col-md-4 col-12 p-3">
        				<div class="shadow card mx-auto">
                            <div class="card-img-top p-2" id="cardimgDetails">
                                 <img src="{{asset('img/books/'.$book[0]->cover)}}" class="card-img my-auto"/>
                            </div>
                            <div class="card-body py-1 px-2">
                                <h4 class="card-title mb-0 font-weight-bold"><p id="titleDetails" class="mb-1">{{$book[0]->title}}</p></h4>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Autor: <span id="autorDetails" class="font-weight-normal float-right">{{$book[0]->autor}}</span></h6>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Year: <span id="yearDetails" class="font-weight-normal float-right">{{$book[0]->year}}</span></h6>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Category: <span id="categoryDetails" class="font-weight-normal float-right">{{$book[0]->category->name}}</span></h6>
                                <hr class="my-2">
                                <p class="mb-0 font-weight-bold text-justify">Description: <span class="card-text font-weight-normal" id="descriptionDetails" class="font-weight-normal float-right">{{$book[0]->description}}</span></p>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Pages: <span id="pagesDetails" class="font-weight-normal float-right">{{$book[0]->pages}}</span></h6>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Editorial: <span id="editorialDetails" class="font-weight-normal float-right">{{$book[0]->editorial}}</span></h6>
                                <hr class="my-2">
                                <h6 class="card-title mb-0 font-weight-bold">Edition: <span id="editionDetails" class="font-weight-normal float-right">{{$book[0]->edition}}</span></h6>
                                <hr class="my-2">
                                <h6 class="card-title mb-2 font-weight-bold">ISBN: <span id="isbnDetails" class="font-weight-normal float-right">{{$book[0]->isbn}}</span></h6>
                            </div>
                        </div>
        			</div>
                    
        			<div class="col p-3">
        				<table class="table table-responsive-md table-striped table-hover table-sm shadow">
							<thead>
								<tr>
									<th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
									<th scope="col">Loan date</th>
									<th scope="col">Return date</th>
                                    <th scope="col">Status</th>
								</tr>
							</thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                    @if(@isset($loans) && count($loans)>0)
                                        {{$loans->links()}}
                                    @endif
                                    </td>
                                </tr>
                            </tfoot>
							<tbody>
								@if(@isset($loans) && count($loans)>0)
                    				@foreach ($loans as $loan)
										<tr>
											<th>{{$loan->id}}</th>
                                            <td>{{$loan->users->name}}</td>
                                            <td>{{$loan->users->email}}</td>
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
    </script>
</x-slot>

</x-app-layout>