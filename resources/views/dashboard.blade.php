@extends('layouts.app')

@section('content')

{{-- ========================================
     DASHBOARD
======================================== --}}
<div class="container py-4">

    {{-- Título da página --}}
    <div class="mb-4">

        <h2 class="fw-bold">
            Dashboard
        </h2>

    </div>

    {{-- Card principal --}}
    <div class="card shadow-sm border-0">

        <div class="card-body">

            {{-- Mensagem de usuário logado --}}
            <p class="mb-0">
                You're logged in!
            </p>

        </div>

    </div>

</div>

@endsection