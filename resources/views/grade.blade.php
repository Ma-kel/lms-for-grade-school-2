<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello {{ Auth::user()->name }} !
        </h2>
    </x-slot>

<div class="account">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <!-- table -->                                
                    <div class="mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h3 class="m-0 font-weight-bold text-primary fw-bold">Grades</h3>
                        </div>
                            
                        <div id="success_message"> </div>
                        <div class="card-body relative">
                            
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    
                                
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Average</th>
                                            @if(Auth::user()->hasRole('teacher'))
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="account-list">
                                        @foreach($students as $student)
                                            <tr>
                                                <td style="width: 70%"> {{ $student->name }}</td>
                                                @forelse($student->average as $average)
                                                    <td>{{ $average->general_average }}</td>
                                                @empty 
                                                    <td> n/a </td>
                                                @endforelse
                                                
                                                <td>
                                                    @if(Auth::user()->hasRole('teacher'))
                                                        <a href="{{ route('grade.show',  $student->id ) }}" class="btn btn-primary"> Show </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /table -->
                </div>
            </div>
        </div>
    </div>
    
</div>

</x-app-layout>
