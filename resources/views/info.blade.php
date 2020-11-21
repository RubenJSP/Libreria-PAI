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
                                    @endif
                                   
                                </td>
                             </tr>
                         @endforeach
                     @endif
                    </tbody>
                  </table>
            </div>
</x-app-layout>
