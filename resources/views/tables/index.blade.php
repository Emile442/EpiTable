<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tables
        </h2>
    </x-slot>

    <div>
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3 xl:col-span-2 md:col-span-3 sm:col-span-3 overflow-x-auto">
                    <div class="inline-block min-w-full bg-white shadow-md rounded rounded-lg pt-2 my-2 overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    maxPlaces
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-white text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tables as $table)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $table->id }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $table->name }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $table->maxPlaces }} places</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" href="{{ route('tables.edit', $table) }}">
                                            Edit
                                        </a>
                                        <a class="ml-1 bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" href="{{ route('tables.destroy', $table) }}" data-method="delete" data-confirm="Are you sure you want to delete this table  ?">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--                        <div--}}
                        {{--                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">--}}
                        {{--                                <span class="text-xs xs:text-sm text-gray-900">--}}
                        {{--                                    Showing 1 to 4 of 50 Entries--}}
                        {{--                                </span>--}}
                        {{--                            <div class="inline-flex mt-2 xs:mt-0">--}}
                        {{--                                <button--}}
                        {{--                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">--}}
                        {{--                                    Prev--}}
                        {{--                                </button>--}}
                        {{--                                <button--}}
                        {{--                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">--}}
                        {{--                                    Next--}}
                        {{--                                </button>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                    <div class="col-span-3 sm:col-span-3 md:col-span-3 xl:col-span-1">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                        @include('tables._form', ['table' => new \App\Models\Table()])
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>

