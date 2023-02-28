@extends('layouts.admin')

@section('content')
<div class="container">
    @include('admin.projects.partials.editCreate', [
        'method' => 'POST',
        'routeName' => 'admin.projects.store'
        ])
</div>
@endsection