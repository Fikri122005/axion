<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Autentikasi') - {{ config('app.name', 'Axion Vet') }}</title>

    <!-- Theme Init (prevents flash of incorrect theme on load) -->
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;
        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }

        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {}

        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>

    <!-- Google Fonts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      crossorigin="anonymous"
    />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />

    <!-- AdminLTE 4 CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}" />

    <style>
      :root {
        --auth-primary-gradient: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
      }

      body.auth-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: var(--bs-tertiary-bg);
        background-image: 
          radial-gradient(circle at 10% 20%, rgba(13, 110, 253, 0.05) 0%, transparent 40%),
          radial-gradient(circle at 90% 80%, rgba(13, 202, 240, 0.05) 0%, transparent 40%);
        padding: 1.5rem 1rem;
      }

      .auth-container {
        width: 100%;
        max-width: 440px;
      }

      .auth-card {
        border-radius: 1rem;
        border: 1px solid var(--bs-border-color-translucent);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        backdrop-filter: blur(10px);
        background-color: var(--bs-body-bg);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
      }

      .auth-header {
        padding: 2rem 2rem 1.25rem;
        text-align: center;
        border-bottom: 1px solid var(--bs-border-color-translucent);
        background: linear-gradient(180deg, rgba(13, 110, 253, 0.03) 0%, transparent 100%);
      }

      .auth-brand-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--auth-primary-gradient);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 6px 16px rgba(13, 110, 253, 0.25);
      }

      .auth-body {
        padding: 1.75rem 2rem 2rem;
      }

      .auth-footer {
        padding: 1rem 2rem 1.5rem;
        text-align: center;
        font-size: 0.875rem;
        border-top: 1px solid var(--bs-border-color-translucent);
        background-color: var(--bs-tertiary-bg);
      }

      .form-control:focus, .form-check-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
      }

      .input-group-text {
        background-color: var(--bs-tertiary-bg);
        border-color: var(--bs-border-color);
        color: var(--bs-secondary-color);
      }

      .password-toggle-btn {
        cursor: pointer;
        transition: color 0.15s ease-in-out;
      }

      .password-toggle-btn:hover {
        color: var(--bs-primary);
      }

      .theme-toggle-bar {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
      }

      .demo-acc-badge {
        cursor: pointer;
        transition: all 0.15s ease-in-out;
      }

      .demo-acc-badge:hover {
        transform: translateY(-1px);
        filter: brightness(0.95);
      }
    </style>

    @stack('styles')
</head>
<body class="auth-page">
    <!-- Top Theme & Home Bar -->
    <div class="theme-toggle-bar d-flex align-items-center gap-2">
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1 rounded-pill px-3 shadow-sm">
            <i class="bi bi-house-door"></i>
            <span class="d-none d-sm-inline">Beranda</span>
        </a>

        <!-- Dark / Light Mode Toggle Button -->
        <button
            type="button"
            class="btn btn-sm btn-outline-secondary rounded-pill px-3 shadow-sm d-flex align-items-center gap-2"
            id="themeSwitcherBtn"
            title="Ganti Mode Gelap/Terang"
            onclick="toggleThemeMode()"
        >
            <i class="bi bi-sun-fill" id="themeIcon"></i>
            <span class="d-none d-sm-inline" id="themeText">Tema</span>
        </button>
    </div>

    <!-- Main Content Container -->
    <div class="auth-container">
        @yield('content')

        <!-- Bottom Copyright -->
        <div class="text-center mt-3 text-secondary small">
            &copy; {{ date('Y') }} <strong>Axion Vet</strong>. Sistem Pakar Diagnosa Penyakit Hewan.
        </div>
    </div>

    <!-- Bootstrap 5 & AdminLTE JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

    <script>
      // Theme Switcher Logic
      function updateThemeIcon(theme) {
        const icon = document.getElementById('themeIcon');
        const text = document.getElementById('themeText');
        if (!icon) return;

        if (theme === 'dark') {
          icon.className = 'bi bi-moon-stars-fill text-warning';
          if (text) text.textContent = 'Gelap';
        } else {
          icon.className = 'bi bi-sun-fill text-warning';
          if (text) text.textContent = 'Terang';
        }
      }

      function toggleThemeMode() {
        const root = document.documentElement;
        const currentTheme = root.getAttribute('data-bs-theme') === 'dark' ? 'dark' : 'light';
        const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        root.setAttribute('data-bs-theme', nextTheme);
        root.style.colorScheme = nextTheme;
        localStorage.setItem('lte-theme', nextTheme);
        updateThemeIcon(nextTheme);
      }

      // Initialize icon on page load
      document.addEventListener('DOMContentLoaded', () => {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
        updateThemeIcon(currentTheme);

        // Password Visibility Toggles
        document.querySelectorAll('.password-toggle-btn').forEach(btn => {
          btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (!input) return;

            const icon = this.querySelector('i');
            if (input.type === 'password') {
              input.type = 'text';
              icon.classList.remove('bi-eye');
              icon.classList.add('bi-eye-slash');
            } else {
              input.type = 'password';
              icon.classList.remove('bi-eye-slash');
              icon.classList.add('bi-eye');
            }
          });
        });
      });
    </script>

    @stack('scripts')
</body>
</html>
