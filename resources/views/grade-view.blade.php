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
                            <h3 class="m-0 font-weight-bold text-primary fw-bold capitalize" id="student-id" data-id="{{ $user->id }}">{{ $user->name }}</h3>
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
                                        
                                            <td>
                                                @if(Auth::user()->hasRole('teacher'))
                                                    <button class="btn btn-primary edit-grade" value="{{ $subject->id }}"> Edit </button>
                                                    <a href="{{ route('student-response.index', [$user->id , $subject->id]) }}" class="btn btn-success"> Show </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="uppercase fw-bold">General Average</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td class="fw-bold uppercase"> {{ $general_average }} </td>
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

<!-- edit modal -->
<div class="modal fade" id="gradeEditModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Update Grade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <!-- input fields -->
                
                <ul id="edit_errlist"></ul>
                                                
                <!-- subjecy id -->
                <input type="hidden" id="grade-id">
                
                <!-- first -->
                <div>
                    <x-label for="first_grading" :value="__('1st Grading')" />
                    <x-input id="first_grading" class="block mt-1 w-full" type="text" name="first_grading"  autofocus />
                </div>
                
                <!-- second -->
                <div class="pt-4">
                    <x-label for="second_grading" :value="__('2nd Grading')" />
                    <x-input id="second_grading" class="block mt-1 w-full" type="text" name="second_grading" autofocus />
                </div>
                
                <!-- third -->
                <div class="pt-4">
                    <x-label for="third_grading" :value="__('3rd Grading')" />
                    <x-input id="third_grading" class="block mt-1 w-full" type="text" name="third_grading" autofocus />
                </div>
                
                <!-- fourt -->
                <div class="pt-4">
                    <x-label for="fourt_grading" :value="__('4th Grading')" />
                    <x-input id="fourt_grading" class="block mt-1 w-full" type="text" name="fourt_grading" autofocus />
                </div>
                
                <!-- average -->
                <div class="pt-4">
                    <x-label for="average" :value="__('Average')" />
                    <x-input id="average" class="block mt-1 w-full" type="text" name="average" autofocus />
                </div>
    
                <!-- end- input fields -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-grade">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- end- edit modal -->


@section('scripts')
<script>
      
$(document).ready(function () {

    // // edit 
    $(document).on('click', '.edit-grade', function (e) {
        e.preventDefault();
        
        var grade_id = $(this).val();
        var student_id = $('#student-id').data("id");
        
        var url = "{{ route('grade.edit', [':id' , ':student_id']) }}";
        
        url = url.replace(':id', grade_id);
        url = url.replace(':student_id', student_id);
        
        $('#gradeEditModal').modal('show');
        
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                if (response.status == 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                } else { 
                    $('#first_grading').val(response.grade[0].first_grading);
                    $('#second_grading').val(response.grade[0].second_grading);
                    $('#third_grading').val(response.grade[0].third_grading);
                    $('#fourt_grading').val(response.grade[0].fourt_grading);
                    $('#average').val(response.grade[0].average);
                    $('#grade-id').val(response.grade[0].id);
                }
            }
        });
    });
    
    // // update 
    $(document).on('click', '.update-grade', function (e) {
        e.preventDefault();
        
        var grade_id = $('#grade-id').val();
        var url = "{{ route('grade.update', ':id') }}"
        url = url.replace(':id' , grade_id); 
        
        var data = { 
            'first_grading': $('#first_grading').val(),
            'second_grading': $('#second_grading').val(),
            'third_grading': $('#third_grading').val(),
            'fourt_grading': $('#fourt_grading').val(),
            'average': $('#average').val(),
        }
        
        console.log(data);
                
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "PUT",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                
                if(response.status == 404) { 
                
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                    
                }
                else { 
                
                    $('#edit_errlist').html("");
                    $('#edit_errlist').removeClass("alert alert-danger");
                    $('#gradeEditModal').modal('hide');
                    $('#gradeEditModal').find('input').val("");
                    Swal.fire(
                        'Good job!',
                        response.message,
                        'success'
                    );
                    location.reload();
                    
                }
                
            }
        });
    });
});
    
</script>

@endsection
</x-app-layout>
