@extends('layouts.app')


@section('content-header')
<h1>
    Import Shema From X M L
    <small>app.diagrams.net </small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-truck"></i> Tableau de bord</a></li>
    <li class=""><a href="{{ route('import_shema_from_xmls.import_shema_from_xml.index') }}">Import Shema From X M Ls</a>
    </li>
</ol>
@endsection


@section('content')

@component('components.box-form-create')
    @slot('headerLeft')
        {{ !empty($title) ? $title : 'Import Shema From X M L' }}
    @endslot

    @slot('actions')
        <a href="{{ route('import_shema_from_xmls.import_shema_from_xml.index') }}" class="btn btn-primary" title="Afficher tous les Import Shema From X M L">
            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
        </a>
        <a href="{{ route('import_shema_from_xmls.import_shema_from_xml.create') }}" class="btn btn-success" title="Ajouter Import Shema From X M L">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </a>
    @endslot

    @slot('route')
        {{ route('import_shema_from_xmls.import_shema_from_xml.store') }}
    @endslot

    @include('import_shema_from_x_m_ls.form', ['importShemaFromXML' => null,])

@endcomponent

@endsection
