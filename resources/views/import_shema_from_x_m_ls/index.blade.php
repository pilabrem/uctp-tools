@extends('layouts.app')

@section('content-header')
<h1>
    Import Shema From XML
    <small>app.diagrams.net </small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-truck"></i> Tableau de bord</a></li>
    <li class="active"><a href="{{ route('import_shema_from_xmls.import_shema_from_xml.index') }}">Import Shema From
            XML</a></li>
</ol>
@endsection

@section('content')

@component('components.box-index')
@slot('left')
<h4 class="mt-5 mb-5">Import Shema From XML</h4>
@endslot

@slot('right')
<a href="{{ route('import_shema_from_xmls.import_shema_from_xml.create') }}" class="btn btn-success"
    title="Ajouter Import Shema From X M L">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
</a>
@endslot

@endcomponent

@endsection
