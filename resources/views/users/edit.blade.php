<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edition of {{ $user->name }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-600 p-4 mt-4 my-5 ml-5 mr-5" role="alert">
                    <p>If you edit the field <strong>email</strong> a confirmation will be send</p>
                </div>

                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    <input type="hidden" name="_method" value="put"/>

                    <div class="flex flex-wrap -mx-3 mb-6 mt-4">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-jet-label for="name" value="{{ __('Firstname') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                            <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname', $user->lastname)" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                    </div>

                    <div class="mt-4">
                        <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="school">
                            School / Cursus
                        </label>
                        <div class="relative">
                            <select name="school" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                                <option value="0" {{ old('school', $user->school) == '0' ? 'selected': '' }}>Epitech IT</option>
                                <option value="1" {{ old('school', $user->school) == '1' ? 'selected': '' }}>Epitech Digital</option>
                                <option value="2" {{ old('school', $user->school) == '2' ? 'selected': '' }}>MSc</option>
                                <option value="3" {{ old('school', $user->school) == '3' ? 'selected': '' }}>WAC</option>
                                <option value="4" {{ old('school', $user->school) == '4' ? 'selected': '' }}>Autres</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block tracking-wide font-medium text-sm text-gray-700 mb-2" for="role">
                            Role
                        </label>
                        <div class="relative">
                            <select name="role" class="block appearance-none w-full border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="school">
                                <option value="USER" {{ old('role', $user->role) == 'USER' ? 'selected': '' }}>User</option>
                                <option value="ADMIN" {{ old('role', $user->role) == 'ADMIN' ? 'selected': '' }}>Admin</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-jet-button>
                            {{ __('Update') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
