<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('students.store') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block">Name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Name"
                                />
                            </div>
                            <div>
                                <label for="email" class="block">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Email"
                                />
                            </div>
                            <div>
                                <label for="date_of_birth" class="block">Date of Birth</label>
                                <input
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    type="date"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Date of Birth"
                                />
                            </div>
                            
                        </div>

                        <label for="gender" class="mt-3 block">Gender</label>
                        <input
                            id="male"
                            value="male"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                        />
                        <label for="male">Male</label>

                        <input
                            id="female"
                            value="female"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                        />
                        <label for="female">Female</label>

                        <input
                            id="others"
                            value="others"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                        />
                        <label for="others">Others</label>

                        <input
                          type="submit"
                          value="Insert"
                          class="focus:outline-none mt-5 bg-purple-500 px-4 py-2 text-white font-bold w-full"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
