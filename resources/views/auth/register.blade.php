@extends('layouts.app')

@section('content')

{{-- ========================================
     REGISTER PAGE (BOOTSTRAP)
======================================== --}}
<div class="container py-5">

    {{-- Centraliza o card --}}
    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            {{-- Card do registro --}}
            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    {{-- Título --}}
                    <h3 class="text-center mb-4">
                        Criar conta
                    </h3>

                    {{-- FORMULÁRIO --}}
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- NOME --}}
                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Nome
                            </label>

                            <input 
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="form-control"
                            >

                            @error('name')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input 
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="form-control"
                            >

                            @error('email')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- SENHA --}}
                        <div class="mb-3">

                            <label for="password" class="form-label">
                                Senha
                            </label>

                            <input 
                                id="password"
                                type="password"
                                name="password"
                                required
                                class="form-control"
                            >

                            @error('password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- CONFIRMAR SENHA --}}
                        <div class="mb-3">

                            <label for="password_confirmation" class="form-label">
                                Confirmar senha
                            </label>

                            <input 
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                class="form-control"
                            >

                            @error('password_confirmation')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- AÇÕES --}}
                        <div class="d-flex justify-content-between align-items-center mt-4">

                            {{-- Link login --}}
                            <a href="{{ route('login') }}" class="small text-decoration-none">
                                Já tenho conta
                            </a>

                            {{-- Botão registrar --}}
                            <button type="submit" class="btn btn-dark">
                                Criar conta
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection