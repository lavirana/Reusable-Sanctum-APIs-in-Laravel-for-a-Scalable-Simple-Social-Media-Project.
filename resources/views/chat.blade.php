@extends('pages.layout')
@section('title', 'Messages')
@section('content')

@livewire('chat-component', ['user_id' => $id])

@endsection