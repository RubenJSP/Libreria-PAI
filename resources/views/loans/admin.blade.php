<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Loans') }}
                </h2>
            </div>
            <div class="col-md-4 col-12 text-right">
                <button class="btn btn-primary py-1" data-toggle="modal" data-target="#addBookModal"><i class="fas fa-plus-circle"></i> Add Loan</button>
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
                                <div class="text-right mr-4 mt-2">
                                    <button type="button" class="close" aria-label="Close" onclick="hideDetails()">
                                        <span aria-hidden="true" class="position-absolute"><i class="fas fa-times-circle"></i></span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-img-top p-2" id="cardimgDetails"> 
                            </div>
                            <div class="card-body py-1 px-2">
                                <h4 class="card-title mb-0 font-weight-bold"><p id="titleDetails" class="mb-1"></p></h4>
                                <h6 class="card-title mb-0 font-weight-bold">Loan date: <span id="loanDateDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Return date: <span id="returnDateDetails" class="font-weight-normal float-right"></span></h6>
                                <div class="border-t border-gray-100"></div>
                                <h6 class="card-title mb-0 font-weight-bold">Name user loan: <span id="nameUser" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Email user loan: <span id="mailUser" class="font-weight-normal float-right"></span></h6>
                            </div>
                            {{--<div class="card-body py-1 px-2">
                                <h4 class="card-title mb-0 font-weight-bold"><p id="titleDetails" class="mb-1"></p></h4>
                                <h5 class="card-title mb-0 font-weight-bold">Autor: <span id="autorDetails" class="font-weight-normal float-right"></span></h5>
                                <h6 class="card-title mb-0 font-weight-bold">Year: <span id="yearDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Category: <span id="categoryDetails" class="font-weight-normal float-right"></span></h6>
                                <p class="mb-0 font-weight-bold text-justify">Description: <span class="card-text font-weight-normal" id="descriptionDetails" class="font-weight-normal float-right"></span></p>
                                <h6 class="card-title mb-0 font-weight-bold">Pages: <span id="pagesDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Editorial: <span id="editorialDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">Edition: <span id="editionDetails" class="font-weight-normal float-right"></span></h6>
                                <h6 class="card-title mb-0 font-weight-bold">ISBN: <span id="isbnDetails" class="font-weight-normal float-right"></span></h6>
                            </div>--}}
                            <div class="card-footer bg-transparent py-2">
                            </div>   
                        </div>
        			</div>
                    
        			<div class="col p-3">
                        {{--$loans--}}
        				<table class="table table-striped table-hover table-sm">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Title</th>
									<th scope="col">Loan date</th>
                                    <th scope="col">Return date</th>
									<th scope="col">State</th>
									<th scope="col">Actions</th>
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
                                                    <p class="text-warning"><i class="fas fa-circle"></i> Borrowed</p>
                                                @endif
                                            </td>
											<td>
												<button onclick="showDetails({{$loan}})" type="button" class="btn btn-sm btn-info">
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

        function showDetails(loan){

            console.log(loan);

        	$('#detailsCard').show(1000);

            if($('#imgDetails')!=null){
                $('#imgDetails').remove();
            }
            $('#titleDetails').text(loan.books.title);
            $('#autorDetails').text(loan.books.autor);
            $('#loanDateDetails').text(loan.loan_date);
            if (loan.state == 0)
                $('#returnDateDetails').text(loan.return_date);
            else
                $('#returnDateDetails').text(loan.return_date + "**");
            $('#nameUser').text(loan.users.name);
            $('#mailUser').text(loan.users.email);
            /*$('#descriptionDetails').text(book.description);
            $('#pagesDetails').text(book.pages);
            $('#editorialDetails').text(book.editorial);
            $('#editionDetails').text(book.edition);
            $('#isbnDetails').text(book.isbn);*/
            var img = $('<img />', { 
                id: 'imgDetails',
                src: 'img/books/'+loan.books.cover,
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