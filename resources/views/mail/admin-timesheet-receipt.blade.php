@extends('layouts.mail')

@section('titlePT1', 'Operative has')
@section('titlePT2', 'Submitted a Timesheet')

@section('content')
    <p>Hi,</p>

    <p>An Operative has submitted a timesheet to the Pursuit TMR application. The timesheet is attached or you can view the documents by clicking on the following link:</p>
    <p><a href="{{route('timesheets.index')}}">View Timesheets</a></p>
    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection