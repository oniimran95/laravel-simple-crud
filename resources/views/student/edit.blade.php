<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('students.index') }}" class="py-3 text-xl text-blue-500"><< Go back to home page</a>
                    <form action="{{ route('students.update', $student->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block">Name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Name"
                                    value="{{ $student->name }}"
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
                                    value="{{ $student->email }}"
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
                                    value="{{ date('Y-m-d', strtotime($student->date_of_birth)) }}"
                                />
                            </div>

                            <div>
                                <div class="grid grid-cols-2">
                                    <div>
                                        <label for="image" class="block">Image</label>
                                        <input
                                            id="image"
                                            name="image"
                                            type="file"
                                            class="py-2"
                                        />
                                    </div>
                                    <div>
                                        <img src="{{ asset($student->image) }}" alt="">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>

                        <label for="gender" class="mt-3 block">Gender</label>
                        <input
                            id="male"
                            value="male"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                            @if($student->gender === 'male') checked @endif
                        />
                        <label for="male">Male</label>

                        <input
                            id="female"
                            value="female"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                            @if($student->gender === 'female') checked @endif
                        />
                        <label for="female">Female</label>

                        <input
                            id="others"
                            value="others"
                            name="gender"
                            type="radio"
                            class="appearance-none checked:bg-blue-500"
                            @if($student->gender === 'others') checked @endif
                        />
                        <label for="others">Others</label>

                        <input
                          type="submit"
                          value="Update"
                          class="focus:outline-none mt-5 bg-purple-500 px-4 py-2 text-white font-bold w-full cursor-pointer"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
