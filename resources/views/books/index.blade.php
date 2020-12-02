<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-8 col-12">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    {{ __('Books') }}
                </h2>
            </div>
        </div>
    </x-slot>

<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-3">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if(isset($books) && count($books)>0)
                <div class="row row-cols-1 row-cols-lg-5 row-cols-md-4 row-cols-sm-2 no-gutters p-2">
                    @foreach ($books as $book)
                        <div class="col mb-2 d-flex p-2">
                            <div class="shadow card mx-auto" style="width: 16rem;">
                                <div class="col d-flex justify-content-center bg-light">
                                    <img src="{{asset('img/books/'.$book->cover)}}" class="" alt="..." style="height:250px">
                                </div>
                                <hr class="mt-0 mb-1">
                                <div class="card-body py-1 px-2">
                                    <h5 class="card-title break-text"><b>{{$book->title}}</b></h5>
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <h6 class="my-1">{{$book->autor}}</h6>
                                        </div>
                                        <div class="col">
                                            <h6 class="my-1 text-right">{{$book->year}}</h6>
                                        </div>
                                        
                                    </div>
                                    <p class="card-text mb-0 text-justify">{{Str::limit($book->description, 95, '...')}}</p>
                                </div>
                                <div class="card-footer bg-transparent py-2">
                                    <button class="btn btn-block border-primary float-right text-primary mb-2" data-toggle="modal" data-target="#detailsModal" onclick="showDetails({{$book}},{{$book->category}})">More info</button>
                                    @if($book->status == 0)
                                        <form action="{{url('loan')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$book->id}}">
                                            <button type="submit" class="btn btn-block btn-primary">Get</button>
                                        </form>
                                    @else
                                      <button type="submit" disabled class="btn btn-block btn-disabled border-dark">Not available</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-3 pb-3">
                    {{$books->links()}}
                </div>
            @else
                <div class="row no-gutters d-flex justify-content-center py-3">
                    <h1 class="text-black-50">No loan records</h1>
                </div>
            @endif
        </div>
    </div>
</div>


<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card col mb-3 px-0">
                    <div class="row no-gutters">
                        <div class="col-md-4 mt-0" id="cardimgDetails">
                            
                        </div>
                        <div class="col-md-8">
                            <div class="card-body pb-1">
                                <h4 class="card-title"><p id="titleDetails" class="font-weight-bold mb-0"></p></h4>
                                <hr class="mt-0 mb-2">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="card-title font-weight-bold">Author <span class="font-weight-normal" id="autorDetails"></span></h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <h5 class="card-title font-weight-bold">Year <span class="font-weight-normal" id="yearDetails"></span></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h6 class="card-title font-weight-bold">Category <span class="font-weight-normal" id="categoryDetails"></span></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="card-title font-weight-bold">Pages <span class="font-weight-normal" id="pagesDetails"></span></h6>
                                    </div>
                                </div>
                                
                                <p class="font-weight-bold">Description: <span class="card-text font-weight-normal" id="descriptionDetails"></span></p>
                               
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h6 class="card-title font-weight-bold">Editorial <span class="font-weight-normal" id="editorialDetails"></span></h6>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <h6 class="card-title font-weight-bold">Edition <span class="font-weight-normal" id="editionDetails"></span></h6>
                                    </div>
                                </div>
                                <h6 class="card-title font-weight-bold">ISBN <span class="font-weight-normal" id="isbnDetails"></span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="{{url('loan')}}" method="POST" id="detailsGet">
                    @csrf
                    <input type="hidden" name="id" id="idDetails">
                    <button type="submit" class="btn btn-block btn-primary">Get</button>
                </form>
                <button type='submit' style="display: none" id="btnNotAvaibleDetails" disabled class='btn btn-disabled border-dark'>Not available</button>
            </div>
        </div>
    </div>
</div>


<x-slot name="scripts">
    <script type="text/javascript">
        function showDetails(book,category){
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