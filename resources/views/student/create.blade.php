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
                    <a href="{{ route('students.index') }}" class="py-3 text-xl text-blue-500"><< Go back to home page</a>
                    <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block">Name</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Name"
                                />
                                @error('name')
                                    <span class="text-red-700">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Email"
                                />
                                @error('email')
                                    <span class="text-red-700">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="date_of_birth" class="block">Date of Birth</label>
                                <input
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    type="date"
                                    value="{{ old('date_of_birth') }}"
                                    class="border border-gray-500 px-4 py-2 focus:outline-none focus:border-purple-500 w-full"
                                    placeholder="Date of Birth"
                                />
                                @error('date_of_birth')
                                    <span class="text-red-700">{{$message}}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="image" class="block">Image</label>
                                <input
                                    id="image"
                                    name="image"
                                    type="file"
                                    class="py-2"
                                />
                                @error('image')
                                    <span class="text-red-700 block">{{$message}}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="mt-3 block">Gender</label>
                                <input
                                    id="male"
                                    value="male"
                                    name="gender"
                                    type="radio"
                                    class="appearance-none checked:bg-blue-500"
                                    @if( old('gender') === 'male') checked @endif
                                />
                                <label for="male">Male</label>

                                <input
                                    id="female"
                                    value="female"
                                    name="gender"
                                    type="radio"
                                    class="appearance-none checked:bg-blue-500"
                                    @if( old('gender') === 'female') checked @endif
                                />
                                <label for="female">Female</label>

                                <input
                                    id="others"
                                    value="others"
                                    name="gender"
                                    type="radio"
                                    class="appearance-none checked:bg-blue-500"
                                    @if( old('gender') === 'others') checked @endif
                                />
                                <label for="others">Others</label>
                            </div>

                            <div>
                                <label for="t_class_id" class="block">Class</label>
                                <select name="t_class_id" id="t_class_id" class="w-full">
                                    <option value="">--Select Class--</option>
                                    @foreach($initialData['classes'] as $id => $name)
                                        <option value="{{ $id }}" @if( old('t_class_id') == $id) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('t_class_id')
                                    <span class="text-red-700 block">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="py-2" for="reg_no">Reg No.</label>
                                <input type="text" name="reg_no" id="reg_no" class="w-full" />
                                @error('reg_no')
                                    <span class="text-red-700 block">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="py-2" for="roll_no">Roll No.</label>
                                <input type="text" name="roll_no" id="roll_no" class="w-full" />
                                @error('roll_no')
                                    <span class="text-red-700 block">{{$message}}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="result" class="block">Result:</label>
                                <select name="result" id="result" class="w-full">
                                    <option value="">--Select Result--</option>
                                    @foreach($initialData['results'] as $result)
                                        <option value="{{ $result }}" @if( old('result') == $result) selected @endif>{{ $result }}</option>
                                    @endforeach
                                </select>
                                @error('result')
                                    <span class="text-red-700 block">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <input
                          type="submit"
                          value="Insert"
                          class="focus:outline-none mt-5 bg-purple-500 px-4 py-2 text-white font-bold w-full cursor-pointer"
                        />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
