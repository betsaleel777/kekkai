@extends('layout')
@section('content')
<div class="ui card">
    <div class="content">
        <div class="header">{{$enseignant->nomination}}</div>
    </div>
    <div class="content">
        <h4 class="ui sub header">{{$enseignant->grade}}</h4>
        <div class="ui small feed">
            <div class="event">
                <div class="content">
                    <div class="summary">
                        <strong>Statut:</strong>{{$enseignant->statut}}
                    </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary">
                        <strong>Telephone:</strong> {{$enseignant->phone}}
                    </div>
                </div>
            </div>
            <div class="event">
                <div class="content">
                    <div class="summary">
                        <strong>Email:</strong> {{$enseignant->email}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="extra content">
        <button class="ui button">voir repartition</button>
    </div>
</div>
@endsection
