@extends('errors::zero-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Demasiadas solicitudes'))
