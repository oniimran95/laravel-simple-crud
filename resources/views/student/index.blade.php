<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('success'))
            <!-- green-->
            <div class="flex justify-between py-4 px-8 my-3 bg-[#98f5e1]  text-[#236c5b]">
                <p class="font-sans">{{ $message }}</p>
                <button class="font-bold">&#10005;</button>
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a
                        class="float-right px-3 py-1 bg-black text-white rounded-md mb-3 hover:bg-sky-700"
                        href="{{ route('students.create') }}"
                    >
                        Add Student
                    </a>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">Image</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Gender</th>
                                <th scope="col" class="px-6 py-3">Date of Birth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($targets as $target)
                            <tr class="hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4 w-16">
                                    <img src="{{ asset($target->image) }}" alt="">
                                </td>
                                <td class="px-6 py-4">{{ $target->name }}</td>
                                <td class="px-6 py-4">{{ $target->email }}</td>
                                <td class="px-6 py-4 capitalize">{{ $target->gender }}</td>
                                <td class="px-6 py-4 capitalize">{{ date('d/m/Y', strtotime($target->date_of_birth)) }}</td>
                                <td>
                                    <a href="{{ route('students.edit', $target->id) }}">Edit</a> |
                                    <form action="{{ route('students.destroy', $target->id) }}" method="post" class="inline">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="cursor-pointer">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
