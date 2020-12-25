@extends('layouts.app')
@section('title','Teams');
@section('nav-title','Assignments')
@include('layouts.SideNavigation')
@section('list-item')
    @if(auth()->id() == $id->manager_id)
        <li><a href="{{ route('teams.assignments.new', $id) }}"> <i class="fas fa-plus"></i> Create new Assignment</a>
        </li>
    @endif
@stop
@section('content')
    <section class="Assignments mt-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Team</th>
                        <th scope="col">End Date</th>
                        @if(auth()->id() != $id->manager_id)
                            <th scope="col">Grades</th>
                        @endif
                        <th scope="col">Assignment Status</th>
                        @if(auth()->id() == $id->manager_id)
                            <th scope="col">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=0)
                    @foreach($assignments as $assignment)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>
                                <a href="{{ route('teams.assignments.show', [$assignment->team->id, $assignment->id]) }}">{{ $assignment->name }}</a>
                            </td>
                            <td>{{ $assignment->team->name }}</td>
                            <td>{{ $assignment->ending_date->diffForHumans() }}</td>

                            @if(auth()->id() != $id->manager_id)
                                <td>
                                    @if(isset($filesArray[$assignment->id]))
                                        {{ ! is_null($gradesArray[$assignment->id]) ? $gradesArray[$assignment->id] : "Not Graded Yet" }}
                                    @else
                                        {{ "You Are Not Uploaded Any File"  }}
                                    @endif
                                </td>
                            @endif

                            <td>
                                @if($assignment->ending_date < \Carbon\Carbon::now()->toDateTimeString())
                                    <span
                                        class="text-danger">Ending {{ $assignment->ending_date->diffForHumans() }}</span>
                                @else
                                    <span
                                        class="text-success">Available to {{ $assignment->ending_date->diffForHumans() }}</span>
                                @endif
                            </td>
                            <td>
                                @if(auth()->id() == $id->manager_id)
                                    <form action="{{ route('teams.assignments.delete', [$id->id , $assignment->id]) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </section>
@stop
