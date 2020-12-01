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
            <div class="row row-cols-1 row-cols-md-4 no-gutters p-2">
                @if(isset($books) && count($books)>0)
                    @foreach ($books as $book)
                        <div class="col mb-4 d-flex p-2">
                            <div class="shadow card mx-auto" style="width: 16rem;">
                                <button><img src="{{asset('img/books/'.$book->cover)}}" class="card-img-top p-2" alt="..."></button>
                                <div class="card-body py-1 px-2">
                                    <h5 class="card-title break-text"><b>{{$book->title}}</b></h5>
                                    <h6 class="my-1">{{$book->autor}}</h6>
                                    <p class="card-text mb-0 text-justify">{{Str::limit($book->description, 100, '...')}}</p>
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
                @endif
            </div>
            @if(isset($books) && count($books)>0)
                {{$books->links()}}
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
                <div class="card col mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4 mt-3" id="cardimgDetails">
                            {{--<img src="..." id="" class="card-img" alt="...">--}}
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title"><p id="titleDetails"></p></h4>
                                <h6 class="card-title">Year: <span id="yearDetails"></span></h6>
                                <h5 class="card-title">Autor: <span id="autorDetails"></span></h5>
                                <h6 class="card-title">Category: <span id="categoryDetails"></span></h6>
                                <p>Description: <span class="card-text" id="descriptionDetails"></span></p>
                                <h6 class="card-title">Pages: <span id="pagesDetails"></span></h6>
                                <h6 class="card-title">Editorial: <span id="editorialDetails"></span></h6>
                                <h6 class="card-title">Edition: <span id="editionDetails"></span></h6>
                                <h6 class="card-title">ISBN: <span id="isbnDetails"></span></h6>
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