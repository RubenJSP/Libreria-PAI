<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{url('categories')}}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Descript</label>
                      <textarea class="form-control" id="des" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
            </div>
        </div>
    </div>
</x-app-layout>
