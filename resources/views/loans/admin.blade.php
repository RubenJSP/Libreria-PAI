<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Loans') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-3">
    	<div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
        	<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="text-right mx-7 mt-2" id="closeDetails" style="display: none">
                        <button type="button" class="close" aria-label="Close" onclick="hideDetails()">
                            <span aria-hidden="true" class="position-absolute"><i class="fas fa-times-circle"></i></span>
                        </button>
                    </div>

        		<div class="row no-gutters shadow rounded-lg p-2 mx-3 mt-3" id="rowCards" style="display: none">

                    <div class="col-md-8">
                        <div id="detailsCard" class="card shadow-sm">
                            <div class="row no-gutters">
                                <div class="col-md-4" id="cardimgDetails">
                                    <img id="imgDetails" src="..." class="card-img" alt="...">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title mb-1 font-weight-bold"><p id="titleDetails" class="mb-1"></p></h4>
                                        <hr>
                                        <h5 class="card-title mb-1 font-weight-bold">Autor: <span id="autorDetails" class="font-weight-normal float-right"></span></h5>
                                        <h6 class="card-title mb-1 font-weight-bold">Year: <span id="yearDetails" class="font-weight-normal float-right"></span></h6>
                                        <h6 class="card-title mb-1 font-weight-bold">Category: <span id="categoryDetails" class="font-weight-normal float-right"></span></h6>
                                        <p class="mb-1 font-weight-bold text-justify">Description: <span class="card-text font-weight-normal" id="descriptionDetails" class="font-weight-normal float-right"></span></p>
                                        <h6 class="card-title mb-1 font-weight-bold">Pages: <span id="pagesDetails" class="font-weight-normal float-right"></span></h6>
                                        <h6 class="card-title mb-1 font-weight-bold">Editorial: <span id="editorialDetails" class="font-weight-normal float-right"></span></h6>
                                        <h6 class="card-title mb-1 font-weight-bold">Edition: <span id="editionDetails" class="font-weight-normal float-right"></span></h6>
                                        <h6 class="card-title mb-1 font-weight-bold">ISBN: <span id="isbnDetails" class="font-weight-normal float-right"></span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col pl-3 pr-1">
                        <div class="row no-gutters">
                            <div id="detailsCard2" class="col shadow-sm card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4" id="cardimgDetails">
                                        <img id="imgUserDetails" src="{{asset('img/users/userIcon.jpg')}}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0 font-weight-bold"><p id="nameUser" class="mb-1"></p></h4>
                                            <hr>
                                            <h6 class="card-title mb-0 font-weight-bold" id="mailUser"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div id="detailsCard3" class="col shadow-sm  card mb-3">
                                <blockquote class="blockquote mb-1 card-body">
                                    <h4 class="card-title mb-1 font-weight-bold"><p id="titleDetails" class="mb-1">Loan Details</p></h4>
                                    <hr>
                                    <h6 class="card-title mb-1 font-weight-bold">Loan date: <span id="loanDateDetails" class="font-weight-normal float-right"></span></h6>
                                    <h6 class="card-title mb-1 font-weight-bold">Loan return: <span id="returnDateDetails" class="font-weight-normal float-right"></span></h6>
                                    <h6 class="card-title mb-1 font-weight-bold">Status: <span id="colorStatus" class="font-weight-normal float-right text-success"><i class="fas fa-circle"></i><span id="statusDetails"></span></span></h6>
                                </blockquote>
                            </div>
                        </div>
                    </div>

        		</div>


                <div class="row no-gutters">
                   <div class="col p-3">
                        {{--$loans--}}
                        <table class="table shadow table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title book</th>
                                    <th scope="col">Name user</th>
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
                                            <td>{{$loan->users->name}}</td>
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
            $('#rowCards').hide();
            $('#closeDetails').hide();
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
    	}

        function showDetails(loan){

            console.log(loan);

            $('#rowCards').show(1000);
            $('#closeDetails').show();

        	/*$('#detailsCard').show(1000);
            $('#detailsCard2').show(1000);
            $('#detailsCard3').show(1000);*/

            if($('#imgDetails')!=null){
                $('#imgDetails').remove();
            }
            $('#titleDetails').text(loan.books.title);
            $('#autorDetails').text(loan.books.autor);
            $('#yearDetails').text(loan.books.year);
            $('#categoryDetails').text(loan.books.category.name);

            $('#detailsCard3 #loanDateDetails').text(loan.loan_date);

            
            $('#detailsCard3 #colorStatus').removeClass("text-success");
            $('#detailsCard3 #colorStatus').removeClass("text-warning");

            if (loan.state == 0){
                $('#detailsCard3 #returnDateDetails').text(loan.return_date);
                $('#colorStatus').addClass("text-success");
                $('#detailsCard3 #statusDetails').text(" Returned");
            }
            else{
                $('#detailsCard3 #returnDateDetails').text(loan.return_date + "**");
                $('#colorStatus').addClass("text-warning");
                $('#detailsCard3 #statusDetails').text(" Borrowed");
            }

            $('#detailsCard2 #nameUser').text(loan.users.name);
            $('#detailsCard2 #mailUser').text(loan.users.email);
            $('#descriptionDetails').text(loan.books.description);
            $('#pagesDetails').text(loan.books.pages);
            $('#editorialDetails').text(loan.books.editorial);
            $('#editionDetails').text(loan.books.edition);
            $('#isbnDetails').text(loan.books.isbn);
            var img = $('<img />', { 
                id: 'imgDetails',
                src: 'img/books/'+loan.books.cover,
                class: 'card-img my-auto'
            });
            img.appendTo($('#cardimgDetails'));

            if (loan.books.status==0){
                $('#detailsGet').show();
                $('#idDetails').val(book.id);
            }
            else{
                $('#detailsGet').hide();
                $('#idDetails').val("");
                $('#btnNotAvaibleDetails').show();  
            }


            /*var posicion = $("#rowCards").offset().top;
            $("body").animate({
                scrollTop: posicion
            }, 2000);*/

            var target_offset = $('#rowCards').offset();
            var target_top = target_offset.top;
            $('html,body').animate({scrollTop:target_top},"slow");
        }
    </script>
</x-slot>

</x-app-layout>