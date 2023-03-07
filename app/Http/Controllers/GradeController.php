<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Grade;
use App\Models\Result;
use App\Models\Average;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;


class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::user()->hasRole('teacher')) { 
            $grade = User::findOrFail(Auth::id());
            $grade_level  = $grade->grade;
            $students = User::whereRoleIs('student')->where('grade', $grade_level)->with('average')->get();
            return view('grade', ['students'=>$students] );
        } 
        else { 
            $id = Auth::id();
            $user = User::findOrFail($id);
            $grade_level = $user->grade;
            $subjects = Subject::where('grade_level_id', $grade_level)
            ->with([
                'grade' => function ($q) use ($id) { 
                    $q->where('user_id', $id);
                }
            ])->get();
            $general_average = Average::where('user_id', $id)->first();
            return view('grade-view-student', [
                'subjects'=>$subjects, 
                'user'=>$user, 
                'general_average'=>$general_average,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $grade_level = $user->grade;
    
        $subjects = Subject::where('grade_level_id', $grade_level)
                ->with([
                    'grade' => function ($q) use ($id) { 
                        $q->where('user_id', $id);
                    }
                ])->get();
                
        $subject_count = $subjects->count();        
        
        $averages = [];
        foreach ($subjects as $subject) 
        {
            $averages[] = $subject->grade[0]->average; 
        }
        
        if(in_array('n/a', $averages))
        {
            $general_average = 'n/a';
        }
        else
        { 
            $averages_sum = array_sum($averages); 
            $general_average = round($averages_sum / $subject_count, 2);
            $average_existance = Average::where('user_id', $id)->first();
            $average_existance_count = Average::where('user_id', $id)->count();
            
            if ($average_existance_count == 0) 
            {
                $average = new Average;
                $average->general_average = $general_average;
                $average->user()->associate($id);
                $average->save();
            }
            
            if($average_existance)
            {
                if ($average_existance->general_average != $general_average) 
                { 
                    $average = Average::where('user_id', $id)->first(); 
                    $average->general_average = $general_average;
                    $average->save();
                }
            }
            
        }
                
        return view('grade-view', [
            'user'=>$user,
            'subjects'=>$subjects,
            'general_average'=>$general_average,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $student_id)
    {
        $grade = Grade::where('subject_id', $id)->where('user_id', $student_id)->get();
        
        if ($grade) {
            return response()->json([ 
                'status'=>200, 
                'grade'=>$grade,
            ]);
        }
        else { 
            return response()->json([ 
                'status'=>404, 
                'grade'=>$grade, 
                'id'=>$id,
                'message'=>'Grade Not Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $grade = Grade::find($id);
            $grade->first_grading = $request->input('first_grading');             
            $grade->second_grading = $request->input('second_grading');             
            $grade->third_grading = $request->input('third_grading');             
            $grade->fourt_grading = $request->input('fourt_grading');             
            $grade->average = $request->input('average');             
            $grade->save();
            
            return response()->json([ 
                'status'=>200, 
                'message'=>'Grade Updated Successfully',
            ]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function studentResponse($id , $subject_id)
    {
        $user = User::findOrFail($id);
        $subject = Subject::findOrFail($subject_id);
        // first grading
        // quizzes
        $first_grading_finish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '1')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $first_grading_unfinish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '1')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exams
        $first_grading_finish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '1')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $first_grading_unfinish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '1')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exercises
        $first_grading_finish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '1')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $first_grading_unfinish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '1')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();


        // second grading
        // quizzes
        $second_grading_finish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '2')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $second_grading_unfinish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '2')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exams
        $second_grading_finish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '2')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $second_grading_unfinish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '2')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exercises
        $second_grading_finish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '2')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $second_grading_unfinish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '2')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();

        // third grading
        // quizzes
        $third_grading_finish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '3')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $third_grading_unfinish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '3')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exams
        $third_grading_finish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '3')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $third_grading_unfinish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '3')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exercises
        $third_grading_finish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '3')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $third_grading_unfinish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '3')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
                
        // fourth grading
        // quizzes
        $fourth_grading_finish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '4')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $fourth_grading_unfinish_quizzes = Quiz::where('subject_id', $subject_id)
        ->where('category', 'quiz')
        ->where('grading', '4')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exams
        $fourth_grading_finish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '4')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $fourth_grading_unfinish_exams = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exams')
        ->where('grading', '4')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        // exercises
        $fourth_grading_finish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '4')
        ->whereHas(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
        
        $fourth_grading_unfinish_exercises = Quiz::where('subject_id', $subject_id)
        ->where('category', 'exercise')
        ->where('grading', '4')
        ->whereDoesntHave(
            'results', function ($q) use ($id) { 
                $q->where('user_id', $id);
            }
        )->get();
            
        
        return view('student-response', [ 
            'user'=>$user,
            'subject'=>$subject,
        
            // first grading quizzes
            'first_grading_finish_quizzes'=>$first_grading_finish_quizzes,
            'first_grading_unfinish_quizzes'=>$first_grading_unfinish_quizzes,
            // first grading exams
            'first_grading_finish_exams'=>$first_grading_finish_exams,
            'first_grading_unfinish_exams'=>$first_grading_unfinish_exams,
            // first grading exercises
            'first_grading_finish_exercises'=>$first_grading_finish_exercises,
            'first_grading_unfinish_exercises'=>$first_grading_unfinish_exercises,
            
            
            // second grading quizzes
            'second_grading_finish_quizzes'=>$second_grading_finish_quizzes,
            'second_grading_unfinish_quizzes'=>$second_grading_unfinish_quizzes,
            // second grading exams
            'second_grading_finish_exams'=>$second_grading_finish_exams,
            'second_grading_unfinish_exams'=>$second_grading_unfinish_exams,
            // second grading exercises
            'second_grading_finish_exercises'=>$second_grading_finish_exercises,
            'second_grading_unfinish_exercises'=>$second_grading_unfinish_exercises,

            // third grading quizzes
            'third_grading_finish_quizzes'=>$third_grading_finish_quizzes,
            'third_grading_unfinish_quizzes'=>$third_grading_unfinish_quizzes,
            // third grading exams
            'third_grading_finish_exams'=>$third_grading_finish_exams,
            'third_grading_unfinish_exams'=>$third_grading_unfinish_exams,
            // third grading exercises
            'third_grading_finish_exercises'=>$third_grading_finish_exercises,
            'third_grading_unfinish_exercises'=>$third_grading_unfinish_exercises,
            
            // fourth grading quizzes
            'fourth_grading_finish_quizzes'=>$fourth_grading_finish_quizzes,
            'fourth_grading_unfinish_quizzes'=>$fourth_grading_unfinish_quizzes,
            // fourth grading exams
            'fourth_grading_finish_exams'=>$fourth_grading_finish_exams,
            'fourth_grading_unfinish_exams'=>$fourth_grading_unfinish_exams,
            // fourth grading exercises
            'fourth_grading_finish_exercises'=>$fourth_grading_finish_exercises,
            'fourth_grading_unfinish_exercises'=>$fourth_grading_unfinish_exercises,
            
        ]);
    }
}
