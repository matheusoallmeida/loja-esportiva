@extends('layouts.app')

@section('content')

{{-- ========================================
     LOGIN PAGE (BOOTSTRAP)
======================================== --}}
<div class="container py-5">

    {{-- Centraliza o formulário --}}
    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            {{-- Card do login --}}
            <div class="card shadow-sm border-0">

                <div class="card-body p-4">

                    {{-- Título --}}
                    <h3 class="text-center mb-4">
                        Login
                    </h3>

                    {{-- Status da sessão (ex: login com sucesso/logout) --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- FORMULÁRIO --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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
                                autofocus
                                class="form-control"
                            >

                            {{-- Erro email --}}
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

                            {{-- Erro senha --}}
                            @error('password')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- LEMBRAR-ME --}}
                        <div class="form-check mb-3">

                            <input 
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember_me"
                            >

                            <label class="form-check-label" for="remember_me">
                                Lembrar-me
                            </label>

                        </div>

                        {{-- LINKS + BOTÃO --}}
                        <div class="d-flex justify-content-between align-items-center">

                            {{-- Esqueci senha --}}
                            @if (Route::has('password.request'))
                                <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                    Esqueci minha senha
                                </a>
                            @endif

                            {{-- Botão login --}}
                            <button type="submit" class="btn btn-dark">
                                Entrar
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection