@extends('superadmin.layouts.template')

@section('content')
<h3>Configuration</h3>

<form method="POST" action="{{ route('paiement.UpdateConfiguration') }}">
    @csrf
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif
    <div class="form-group">
        <label for="">API Key </label>
        <input type="text" name="api_key"  value="{{ $paiementInfo ? $paiementInfo->api_key: '' }}">
        @error('api_key')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Site ID</label>
        <input type="text" name="site_id"  value="{{ $paiementInfo ? $paiementInfo->site_id : '' }}">
        @error('site_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="">Secret Key</label>
        <input type="text" name="secret_key"  value="{{ $paiementInfo ? $paiementInfo->secret_key : '' }}">
        @error('secret_key')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">{{ $paiementInfo ? 'Mettre à jour' : 'Enregistrer' }}</button>
    </div>
    
</form>
@endsection