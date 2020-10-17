@if(session()->has('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-600 p-4 mt-4 my-5 ml-5 mr-5" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session()->has('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-600 p-4 mt-4 my-5 ml-5 mr-5" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif
