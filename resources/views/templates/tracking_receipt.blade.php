@extends('layouts.app')
@section('title', 'Recibo de tracking' )
@section('content')
<div class="row" id="people">
  <tracking-receipt-component></tracking-receipt-component>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/people.js') }}"></script>
@endpush