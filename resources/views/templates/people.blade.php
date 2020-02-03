@extends('layouts.app')
@section('title', 'Usuarios' )
@section('content')
<div class="row" id="people">
  <people-component></people-component>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/people.js') }}"></script>
@endpush