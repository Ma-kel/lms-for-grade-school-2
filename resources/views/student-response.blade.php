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
                            <h3 class="m-0 font-weight-bold text-primary fw-bold capitalize">{{ $user->name }} ({{ $subject->subject_name }})</h3>
                        </div>
                            
                        <div class="card-body relative">
                            <div class="container">
                                <div class="accordion">
                                    <!-- first grading -->
                                    <div class="accordion-item">
                                        <div class="accordion-titel">
                                            <strong>First Grading<span><i class="fa-solid fa-angle-down"></i></span></strong>
                                        </div>
                                        <div class="accordion-contant">
                                            <!-- start -->
                                                <ul class="d-flex align-item-center gap-4 align-items-center p-0 tab mt-2">
                                                    <li data-value=".quizzes" class="fw-bold selected"> Quizzes </li>
                                                    <li data-value=".exams" class="fw-bold"> Exams </li>
                                                    <li data-value=".exercises" class="fw-bold"> Exercises </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="quizzes">
                                                    
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_finish_quizzes as $first_grading_finish_quiz)
                                                                                <tr>
                                                                                    <td>{{ $first_grading_finish_quiz->quiz_name }} </td>
                                                                                    @forelse ($first_grading_finish_quiz->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_unfinish_quizzes as $first_grading_unfinish_quiz)
                                                                                <tr>
                                                                                    <td> {{ $first_grading_unfinish_quiz->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exams">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_finish_exams as $first_grading_finish_exam)
                                                                                <tr>
                                                                                    <td>{{ $first_grading_finish_exam->quiz_name }} </td>
                                                                                    @forelse ($first_grading_finish_exam->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_unfinish_exams as $first_grading_unfinish_exam)
                                                                                <tr>
                                                                                    <td> {{ $first_grading_unfinish_exam->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exercises">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exercises </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_finish_exercises as $first_grading_finish_exercise)
                                                                                <tr>
                                                                                    <td>{{ $first_grading_finish_exercise->quiz_name }} </td>
                                                                                    @forelse ($first_grading_finish_exercise->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Exercises </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($first_grading_unfinish_exercises as $first_grading_unfinish_exercise)
                                                                                <tr>
                                                                                    <td> {{ $first_grading_unfinish_exercise->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    <!-- /first grading -->
            
                                    <!-- second grading -->
                                    <div class="accordion-item">
                                        <div class="accordion-titel">
                                            <strong>Second Grading<span><i class="fa-solid fa-angle-down"></i></span></strong>
                                        </div>
                                        <div class="accordion-contant">
                                            <!-- start -->
                                                <ul class="d-flex align-item-center gap-4 align-items-center p-0 tab mt-2">
                                                    <li data-value=".quizzes" class="fw-bold selected"> Quizzes </li>
                                                    <li data-value=".exams" class="fw-bold"> Exams </li>
                                                    <li data-value=".exercises" class="fw-bold"> Exercises </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="quizzes">
                                                    
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_finish_quizzes as $second_grading_finish_quiz)
                                                                                <tr>
                                                                                    <td>{{ $second_grading_finish_quiz->quiz_name }} </td>
                                                                                    @forelse ($second_grading_finish_quiz->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_unfinish_quizzes as $second_grading_unfinish_quiz)
                                                                                <tr>
                                                                                    <td> {{ $second_grading_unfinish_quiz->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exams">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_finish_exams as $second_grading_finish_exam)
                                                                                <tr>
                                                                                    <td>{{ $second_grading_finish_exam->quiz_name }} </td>
                                                                                    @forelse ($second_grading_finish_exam->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_unfinish_exams as $second_grading_unfinish_exam)
                                                                                <tr>
                                                                                    <td> {{ $second_grading_unfinish_exam->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exercises">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exercises </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_finish_exercises as $second_grading_finish_exercise)
                                                                                <tr>
                                                                                    <td>{{ $second_grading_finish_exercise->quiz_name }} </td>
                                                                                    @forelse ($second_grading_finish_exercise->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Exercises </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($second_grading_unfinish_exercises as $second_grading_unfinish_exercise)
                                                                                <tr>
                                                                                    <td> {{ $second_grading_unfinish_exercise->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    <!-- /second grading -->

                                    <!-- third grading -->
                                    <div class="accordion-item">
                                        <div class="accordion-titel">
                                            <strong>Third Grading<span><i class="fa-solid fa-angle-down"></i></span></strong>
                                        </div>
                                        <div class="accordion-contant">
                                            <!-- start -->
                                                <ul class="d-flex align-item-center gap-4 align-items-center p-0 tab mt-2">
                                                    <li data-value=".quizzes" class="fw-bold selected"> Quizzes </li>
                                                    <li data-value=".exams" class="fw-bold"> Exams </li>
                                                    <li data-value=".exercises" class="fw-bold"> Exercises </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="quizzes">
                                                    
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_finish_quizzes as $third_grading_finish_quiz)
                                                                                <tr>
                                                                                    <td>{{ $third_grading_finish_quiz->quiz_name }} </td>
                                                                                    @forelse ($third_grading_finish_quiz->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_unfinish_quizzes as $third_grading_unfinish_quiz)
                                                                                <tr>
                                                                                    <td> {{ $third_grading_unfinish_quiz->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exams">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_finish_exams as $third_grading_finish_exam)
                                                                                <tr>
                                                                                    <td>{{ $third_grading_finish_exam->quiz_name }} </td>
                                                                                    @forelse ($third_grading_finish_exam->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_unfinish_exams as $third_grading_unfinish_exam)
                                                                                <tr>
                                                                                    <td> {{ $third_grading_unfinish_exam->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exercises">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exercises </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_finish_exercises as $third_grading_finish_exercise)
                                                                                <tr>
                                                                                    <td>{{ $third_grading_finish_exercise->quiz_name }} </td>
                                                                                    @forelse ($third_grading_finish_exercise->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Exercises </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($third_grading_unfinish_exercises as $third_grading_unfinish_exercise)
                                                                                <tr>
                                                                                    <td> {{ $third_grading_unfinish_exercise->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    <!-- /third grading -->

                                    <!-- third grading -->
                                    <div class="accordion-item">
                                        <div class="accordion-titel">
                                            <strong>Fourth Grading<span><i class="fa-solid fa-angle-down"></i></span></strong>
                                        </div>
                                        <div class="accordion-contant">
                                            <!-- start -->
                                                <ul class="d-flex align-item-center gap-4 align-items-center p-0 tab mt-2">
                                                    <li data-value=".quizzes" class="fw-bold selected"> Quizzes </li>
                                                    <li data-value=".exams" class="fw-bold"> Exams </li>
                                                    <li data-value=".exercises" class="fw-bold"> Exercises </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="quizzes">
                                                    
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_finish_quizzes as $fourth_grading_finish_quiz)
                                                                                <tr>
                                                                                    <td>{{ $fourth_grading_finish_quiz->quiz_name }} </td>
                                                                                    @forelse ($fourth_grading_finish_quiz->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Quizzes </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Quiz </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_unfinish_quizzes as $fourth_grading_unfinish_quiz)
                                                                                <tr>
                                                                                    <td> {{ $fourth_grading_unfinish_quiz->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exams">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_finish_exams as $fourth_grading_finish_exam)
                                                                                <tr>
                                                                                    <td>{{ $fourth_grading_finish_exam->quiz_name }} </td>
                                                                                    @forelse ($fourth_grading_finish_exam->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exams </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exams </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_unfinish_exams as $fourth_grading_unfinish_exam)
                                                                                <tr>
                                                                                    <td> {{ $fourth_grading_unfinish_exam->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="exercises">
                                                        
                                                        <div class="row gap-4 pt-4">
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-success"> Finish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Exercises </th>
                                                                                <th>Score</th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_finish_exercises as $fourth_grading_finish_exercise)
                                                                                <tr>
                                                                                    <td>{{ $fourth_grading_finish_exercise->quiz_name }} </td>
                                                                                    @forelse ($fourth_grading_finish_exercise->results as $result)
                                                                                        <td>{{ $result->score }}</td>
                                                                                    @empty
                                                                                        <td> n/a </td>
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td>NO DATA</td>
                                                                                    <td></td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                            <div class="col">
                                                                <!-- table -->
                                                                <p class="fw-bold text-danger"> Unfinish Exercises </p>
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th> Exercises </th>
                                                                            </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody class="account-list">
                                                                            @forelse($fourth_grading_unfinish_exercises as $fourth_grading_unfinish_exercise)
                                                                                <tr>
                                                                                    <td> {{ $fourth_grading_unfinish_exercise->quiz_name }} </td>
                                                                                </tr>
                                                                            @empty 
                                                                                <tr>
                                                                                    <td> NO DATA </td>
                                                                                </tr>                                                                            
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- end-table -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    <!-- /third grading -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /table -->
                </div>
            </div>
        </div>
    </div>
    
</div>
@section('scripts')
<script>
    $(document).ready(function(){
        $(".accordion-titel").click(function(){
            $(this).parent(".accordion-item").find(".accordion-contant").slideToggle();
            $(this).parent(".accordion-item").prevAll(".accordion-item").find(".accordion-contant").slideUp();
            $(this).parent(".accordion-item").nextAll(".accordion-item").find(".accordion-contant").slideUp();
        });
        
        // tab
        $(".tab li").click(function() { 
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.tab-content > div').hide();
            $($(this).data("value")).fadeIn();
        });
    });    
</script>
@endsection
</x-app-layout>
