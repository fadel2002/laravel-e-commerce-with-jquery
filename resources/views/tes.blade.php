@extends('layouts.master')

@section('content')
<div>
    <div id="navbar"><span>Red Stapler - Geolocation API</span></div>
    <div id="wrapper">
        <button id="location-button">Get User Location</button>
        <div id="map"></div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('js/map.js')}}"></script>
@endpush