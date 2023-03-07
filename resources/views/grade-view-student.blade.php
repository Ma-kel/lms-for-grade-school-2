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
                            <h3 class="m-0 font-weight-bold text-primary fw-bold" id="student-id" data-id="{{ $user->id }}">{{ $user->name }}</h3>
                        </div>
                            
                        <div id="success_message"> </div>
                        <div class="card-body relative">
                            
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    
                                
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>1st</th>
                                            <th>2nd</th>
                                            <th>3rd</th>
                                            <th>4th</th>
                                            <th>Final Rating</th>
                                            @if(Auth::user()->hasRole('teacher'))
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="account-list">
                                        @foreach($subjects as $subject)
                                        <tr>
                                            <td class="uppercase">{{ $subject->subject_name }}</td>
                                            
                                            @foreach ($subject->grade as $grade)
                                                <td> {{ $grade->first_grading }} </td>
                                                <td> {{ $grade->second_grading }} </td>
                                                <td> {{ $grade->third_grading }} </td>
                                                <td> {{ $grade->fourt_grading }} </td>
                                                <td> {{ $grade->average }} </td>
                                            @endforeach
                                        
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="uppercase fw-bold">General Average</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td class="fw-bold uppercase"> {{ $general_average->general_average }} </td>
                                            <td> </td>
                                        </tr>
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
